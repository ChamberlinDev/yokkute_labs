<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\PublicUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('order_column')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create', ['service' => new Service()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $service = new Service();
        $this->fillAndSave($request, $service);

        return redirect()->route('admin.services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->fillAndSave($request, $service);

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        PublicUploads::delete($service->image_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service supprimé.');
    }

    private function fillAndSave(Request $request, Service $service): void
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:255'],
            'badge_en' => ['nullable', 'string', 'max:255'],
            'badge_variant' => ['required', 'in:green,blue,gray'],
            'icon' => ['required', 'string', 'max:100'],
            'accent_color' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string'],
            'description_en' => ['nullable', 'string'],
            'audience' => ['nullable', 'string'],
            'audience_en' => ['nullable', 'string'],
            'deliverables' => ['nullable', 'string'],
            'deliverables_en' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'cta_label_en' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'cta_url_en' => ['nullable', 'string', 'max:255'],
            'order_column' => ['required', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            PublicUploads::delete($service->image_path);
            $service->image_path = PublicUploads::store($request->file('image'), 'services');
        }

        $service->fill([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'] ?? null,
            'slug' => Str::slug($validated['title']),
            'badge' => $validated['badge'] ?? null,
            'badge_en' => $validated['badge_en'] ?? null,
            'badge_variant' => $validated['badge_variant'],
            'icon' => $validated['icon'],
            'accent_color' => $validated['accent_color'],
            'description' => $validated['description'],
            'description_en' => $validated['description_en'] ?? null,
            'audience' => $validated['audience'] ?? null,
            'audience_en' => $validated['audience_en'] ?? null,
            'deliverables' => collect(explode(PHP_EOL, (string) ($validated['deliverables'] ?? '')))
                ->map(fn (string $item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'deliverables_en' => collect(explode(PHP_EOL, (string) ($validated['deliverables_en'] ?? '')))
                ->map(fn (string $item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'cta_label' => $validated['cta_label'] ?? null,
            'cta_label_en' => $validated['cta_label_en'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'cta_url_en' => $validated['cta_url_en'] ?? null,
            'order_column' => $validated['order_column'],
            'is_published' => $request->boolean('is_published'),
        ]);

        $service->save();
    }
}
