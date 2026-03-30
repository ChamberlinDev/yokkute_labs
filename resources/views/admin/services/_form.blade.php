<div class="row g-4">
    <div class="col-lg-8">
        <div class="card card-soft p-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="order_column" class="form-control" value="{{ old('order_column', $service->order_column ?? 1) }}" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Badge</label>
                    <input type="text" name="badge" class="form-control" value="{{ old('badge', $service->badge) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Couleur badge</label>
                    <select name="badge_variant" class="form-select" required>
                        @foreach(['green' => 'Vert', 'blue' => 'Bleu', 'gray' => 'Gris'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('badge_variant', $service->badge_variant ?? 'green') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Icone Bootstrap</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? 'bi-star') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Couleur accent</label>
                    <input type="text" name="accent_color" class="form-control" value="{{ old('accent_color', $service->accent_color ?? '#1a7a4a') }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Audience cible</label>
                    <input type="text" name="audience" class="form-control" value="{{ old('audience', $service->audience) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Livrables</label>
                    <textarea name="deliverables" class="form-control" rows="5" placeholder="Un livrable par ligne">{{ old('deliverables', implode(PHP_EOL, $service->deliverables ?? [])) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-soft p-4 d-grid gap-3">
            <div>
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            @if($service->image_path)
                <img src="{{ asset($service->image_path) }}" alt="Apercu" class="img-fluid rounded-4 border">
            @endif
            <div>
                <label class="form-label">Texte bouton</label>
                <input type="text" name="cta_label" class="form-control" value="{{ old('cta_label', $service->cta_label) }}">
            </div>
            <div>
                <label class="form-label">Lien bouton</label>
                <input type="text" name="cta_url" class="form-control" value="{{ old('cta_url', $service->cta_url) }}">
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="is_published" value="0">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" @checked(old('is_published', $service->is_published ?? true))>
                <label class="form-check-label" for="is_published">Publie sur le site</label>
            </div>
        </div>
    </div>
</div>
