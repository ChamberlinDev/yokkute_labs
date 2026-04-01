<div class="row g-4">
    <div class="col-lg-8">
        <div class="card card-soft p-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Titre FR</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="order_column" class="form-control" value="{{ old('order_column', $service->order_column ?? 1) }}" min="0" required>
                </div>

                <div class="col-md-8">
                    <label class="form-label">Title EN</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $service->title_en) }}">
                    <div class="form-text">Laisser vide pour conserver le fallback actuel côté site.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Badge FR</label>
                    <input type="text" name="badge" class="form-control" value="{{ old('badge', $service->badge) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Badge EN</label>
                    <input type="text" name="badge_en" class="form-control" value="{{ old('badge_en', $service->badge_en) }}">
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
                    <label class="form-label">Icône Bootstrap</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? 'bi-star') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Couleur d'accent</label>
                    <input type="text" name="accent_color" class="form-control" value="{{ old('accent_color', $service->accent_color ?? '#1a7a4a') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Audience cible FR</label>
                    <input type="text" name="audience" class="form-control" value="{{ old('audience', $service->audience) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Target audience EN</label>
                    <input type="text" name="audience_en" class="form-control" value="{{ old('audience_en', $service->audience_en) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Description FR</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Description EN</label>
                    <textarea name="description_en" class="form-control" rows="5">{{ old('description_en', $service->description_en) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Livrables FR</label>
                    <textarea name="deliverables" class="form-control" rows="5" placeholder="Un livrable par ligne">{{ old('deliverables', implode(PHP_EOL, $service->deliverables ?? [])) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Deliverables EN</label>
                    <textarea name="deliverables_en" class="form-control" rows="5" placeholder="One deliverable per line">{{ old('deliverables_en', implode(PHP_EOL, $service->deliverables_en ?? [])) }}</textarea>
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
                <img src="{{ asset($service->image_path) }}" alt="Aperçu" class="img-fluid rounded-4 border">
            @endif
            <div>
                <label class="form-label">Texte bouton FR</label>
                <input type="text" name="cta_label" class="form-control" value="{{ old('cta_label', $service->cta_label) }}">
            </div>
            <div>
                <label class="form-label">Button label EN</label>
                <input type="text" name="cta_label_en" class="form-control" value="{{ old('cta_label_en', $service->cta_label_en) }}">
            </div>
            <div>
                <label class="form-label">Lien bouton FR</label>
                <input type="text" name="cta_url" class="form-control" value="{{ old('cta_url', $service->cta_url) }}" placeholder="/contact ou https://...">
            </div>
            <div>
                <label class="form-label">Button URL EN</label>
                <input type="text" name="cta_url_en" class="form-control" value="{{ old('cta_url_en', $service->cta_url_en) }}" placeholder="/contact or https://...">
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="is_published" value="0">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" @checked(old('is_published', $service->is_published ?? true))>
                <label class="form-check-label" for="is_published">Publié sur le site</label>
            </div>
        </div>
    </div>
</div>
