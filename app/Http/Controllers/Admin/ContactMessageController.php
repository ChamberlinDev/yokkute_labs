<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    private const STATUSES = ['new', 'in_progress', 'done', 'archived'];
    private const SORTABLE = ['created_at', 'nom', 'email', 'besoin', 'status'];

    public function index(Request $request): View
    {
        $filters = $this->extractFilters($request);
        $query = $this->buildFilteredQuery($filters);

        return view('admin.contact-messages.index', [
            'messages' => $query->paginate(20)->withQueryString(),
            'filters' => $filters,
            'statuses' => self::STATUSES,
            'sortableColumns' => self::SORTABLE,
        ]);
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $filters = $this->extractFilters($request);
        $query = $this->buildFilteredQuery($filters);
        $filename = 'messages_contact_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($query): void {
            $handle = fopen('php://output', 'wb');

            fputcsv($handle, ['Date', 'Prenom', 'Nom', 'Email', 'WhatsApp', 'Entreprise', 'Besoin', 'Statut', 'Message']);

            foreach ($query->cursor() as $message) {
                fputcsv($handle, [
                    optional($message->created_at)->format('Y-m-d H:i:s'),
                    $message->prenom,
                    $message->nom,
                    $message->email,
                    $message->whatsapp,
                    $message->entreprise,
                    $message->besoin,
                    $message->status,
                    $message->message,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if (!$message->read_at) {
            $message->forceFill(['read_at' => now(), 'status' => $message->status === 'new' ? 'in_progress' : $message->status])->save();
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,in_progress,done,archived'],
        ]);

        $message->update($data + ['read_at' => $message->read_at ?? now()]);

        return back()->with('success', 'Statut du message mis a jour.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message supprime.');
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
        $query = ContactMessage::query();

        if (($filters['q'] ?? '') !== '') {
            $search = $filters['q'];
            $query->where(function ($builder) use ($search): void {
                $like = '%' . $search . '%';
                $builder
                    ->where('prenom', 'like', $like)
                    ->orWhere('nom', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('whatsapp', 'like', $like)
                    ->orWhere('entreprise', 'like', $like)
                    ->orWhere('besoin', 'like', $like)
                    ->orWhere('message', 'like', $like);
            });
        }

        if (in_array((string) ($filters['status'] ?? ''), self::STATUSES, true)) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy($filters['sort'] ?? 'created_at', $filters['dir'] ?? 'desc');
    }
}