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

        return redirect()->route('admin.services.index')->with('success', 'Service cree avec succes.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->fillAndSave($request, $service);

        return redirect()->route('admin.services.index')->with('success', 'Service mis a jour avec succes.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        PublicUploads::delete($service->image_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service supprime.');
    }

    private function fillAndSave(Request $request, Service $service): void
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:255'],
            'badge_variant' => ['required', 'in:green,blue,gray'],
            'icon' => ['required', 'string', 'max:100'],
            'accent_color' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string'],
            'audience' => ['nullable', 'string'],
            'deliverables' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'url', 'max:255'],
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
            'slug' => Str::slug($validated['title']),
            'badge' => $validated['badge'] ?? null,
            'badge_variant' => $validated['badge_variant'],
            'icon' => $validated['icon'],
            'accent_color' => $validated['accent_color'],
            'description' => $validated['description'],
            'audience' => $validated['audience'] ?? null,
            'deliverables' => collect(explode(PHP_EOL, (string) ($validated['deliverables'] ?? '')))
                ->map(fn (string $item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'cta_label' => $validated['cta_label'] ?? null,
            'cta_url' => $validated['cta_url'] ?? null,
            'order_column' => $validated['order_column'],
            'is_published' => $request->boolean('is_published'),
        ]);

        $service->save();
    }
}