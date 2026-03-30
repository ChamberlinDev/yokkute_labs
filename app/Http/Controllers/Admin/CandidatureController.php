<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class CandidatureController extends Controller
{
    private const STATUSES = ['new', 'reviewed', 'shortlisted', 'rejected', 'archived'];
    private const SORTABLE = ['created_at', 'nom', 'domaine', 'experience', 'status'];
    private const CV_DISKS = ['local', 'public'];

    public function index(Request $request): View
    {
        $filters = $this->extractFilters($request);
        $query = $this->buildFilteredQuery($filters);

        return view('admin.candidatures.index', [
            'candidatures' => $query->paginate(20)->withQueryString(),
            'filters' => $filters,
            'statuses' => self::STATUSES,
            'sortableColumns' => self::SORTABLE,
        ]);
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $filters = $this->extractFilters($request);
        $query = $this->buildFilteredQuery($filters);
        $filename = 'candidatures_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($query): void {
            $handle = fopen('php://output', 'wb');

            fputcsv($handle, ['Date', 'Prenom', 'Nom', 'Email', 'Telephone', 'Domaine', 'Experience', 'Statut', 'Portfolio']);

            foreach ($query->cursor() as $candidature) {
                fputcsv($handle, [
                    optional($candidature->created_at)->format('Y-m-d H:i:s'),
                    $candidature->prenom,
                    $candidature->nom,
                    $candidature->email,
                    $candidature->telephone,
                    $candidature->domaine,
                    $candidature->experience,
                    $candidature->status,
                    $candidature->portfolio,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function show(Candidature $candidature): View
    {
        if (!$candidature->reviewed_at) {
            $candidature->forceFill([
                'reviewed_at' => now(),
                'status' => $candidature->status === 'new' ? 'reviewed' : $candidature->status,
            ])->save();
        }

        return view('admin.candidatures.show', compact('candidature'));
    }

    public function update(Request $request, Candidature $candidature): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,reviewed,shortlisted,rejected,archived'],
        ]);

        $candidature->update($data + ['reviewed_at' => $candidature->reviewed_at ?? now()]);

        return back()->with('success', 'Statut de la candidature mis a jour.');
    }

    public function downloadCv(Candidature $candidature): StreamedResponse|RedirectResponse
    {
        $storage = $this->resolveCvStorage($candidature->cv_path);

        if ($storage === null) {
            return back()->with('success', 'Le CV est introuvable pour cette candidature.');
        }

        $extension = pathinfo($candidature->cv_path, PATHINFO_EXTENSION) ?: 'pdf';
        $downloadName = sprintf('%s_%s_cv.%s',
            str_replace(' ', '_', strtolower($candidature->prenom)),
            str_replace(' ', '_', strtolower($candidature->nom)),
            $extension
        );

        return $storage->download($candidature->cv_path, $downloadName);
    }

    public function destroy(Candidature $candidature): RedirectResponse
    {
        if ($candidature->cv_path) {
            foreach (self::CV_DISKS as $disk) {
                Storage::disk($disk)->delete($candidature->cv_path);
            }
        }

        $candidature->delete();

        return redirect()->route('admin.candidatures.index')->with('success', 'Candidature supprimee.');
    }

    private function extractFilters(Request $request): array
    {
        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $sort = (string) $request->query('sort', 'created_at');
        $dir = strtolower((string) $request->query('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, self::SORTABLE, true)) {
            $sort = 'created_at';
        }

        return [
            'q' => $search,
            'status' => $status,
            'sort' => $sort,
            'dir' => $dir,
        ];
    }

    private function buildFilteredQuery(array $filters): Builder
    {
        $query = Candidature::query();

        if (($filters['q'] ?? '') !== '') {
            $search = $filters['q'];
            $query->where(function ($builder) use ($search): void {
                $like = '%' . $search . '%';
                $builder
                    ->where('prenom', 'like', $like)
                    ->orWhere('nom', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('telephone', 'like', $like)
                    ->orWhere('domaine', 'like', $like)
                    ->orWhere('experience', 'like', $like);
            });
        }

        if (in_array((string) ($filters['status'] ?? ''), self::STATUSES, true)) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy($filters['sort'] ?? 'created_at', $filters['dir'] ?? 'desc');
    }

    private function resolveCvStorage(?string $path): ?\Illuminate\Contracts\Filesystem\Filesystem
    {
        if (!$path) {
            return null;
        }

        foreach (self::CV_DISKS as $disk) {
            $storage = Storage::disk($disk);

            if ($storage->exists($path)) {
                return $storage;
            }
        }

        return null;
    }
}