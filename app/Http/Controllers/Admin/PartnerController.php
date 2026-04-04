<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Support\PublicUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        return view('admin.partners.index', [
            'partners' => Partner::query()->orderBy('order_column')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.partners.create', ['partner' => new Partner()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $partner = new Partner();
        $this->fillAndSave($request, $partner);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire ajouté avec succès.');
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $this->fillAndSave($request, $partner);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        PublicUploads::delete($partner->logo_path);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire supprimé.');
    }

    private function fillAndSave(Request $request, Partner $partner): void
    {
        $request->merge([
            'website_url' => $this->normalizeOptionalUrl($request->input('website_url')),
        ]);

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'website_url'  => ['nullable', 'url', 'max:255'],
            'order_column' => ['required', 'integer', 'min:0'],
            'is_active'    => ['nullable', 'boolean'],
            'logo'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:5120'],
        ], [
            'name.required' => 'Le nom du partenaire est obligatoire.',
            'name.max' => 'Le nom du partenaire ne doit pas dépasser 255 caractères.',
            'website_url.url' => 'Le lien du site web doit être une URL valide.',
            'website_url.max' => 'Le lien du site web ne doit pas dépasser 255 caractères.',
            'order_column.required' => "L'ordre d'affichage est obligatoire.",
            'order_column.integer' => "L'ordre d'affichage doit être un nombre entier.",
            'order_column.min' => "L'ordre d'affichage doit être supérieur ou égal à 0.",
            'logo.image' => 'Le fichier logo doit être une image valide.',
            'logo.mimes' => 'Le logo doit être au format jpg, jpeg, png, webp, gif ou svg.',
            'logo.max' => 'Le logo ne doit pas dépasser 5 Mo.',
        ]);

        if ($request->hasFile('logo')) {
            PublicUploads::delete($partner->logo_path);
            $partner->logo_path = PublicUploads::store($request->file('logo'), 'partners');
        }

        $partner->fill([
            'name'         => $validated['name'],
            'website_url'  => $validated['website_url'] ?? null,
            'order_column' => $validated['order_column'],
            'is_active'    => $request->boolean('is_active'),
        ]);

        $partner->save();
    }

    private function normalizeOptionalUrl(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (!preg_match('~^https?://~i', $value)) {
            $value = 'https://' . ltrim($value, '/');
        }

        return $value;
    }
}
