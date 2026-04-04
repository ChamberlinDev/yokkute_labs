<div class="row g-4">
    <div class="col-lg-8">
        <div class="card card-soft p-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $partner->name) }}"
                           placeholder="ex: Atos, CPAI, GRowing Consulting…"
                           required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ordre d'affichage <span class="text-danger">*</span></label>
                    <input type="number" name="order_column" class="form-control"
                           value="{{ old('order_column', $partner->order_column ?? 1) }}"
                           min="0" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Site web</label>
                    <input type="text" name="website_url" class="form-control"
                           value="{{ old('website_url', $partner->website_url) }}"
                           placeholder="https://exemple.com">
                    <div class="form-text">Le logo sera cliquable si un lien est renseigné.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-soft p-4 d-grid gap-3">
            <div>
                <label class="form-label">Logo <span class="text-muted">(PNG, WEBP, SVG recommandé)</span></label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <div class="form-text">Max 5 Mo. Fond transparent recommandé.</div>
            </div>
            @if($partner->logo_path)
                <div style="background:#f5f7fa;border:1px solid #e4eae6;border-radius:10px;padding:1rem;text-align:center;">
                    <img src="{{ asset($partner->logo_path) }}"
                         alt="{{ $partner->name }}"
                         style="max-height:80px;max-width:100%;object-fit:contain;">
                </div>
            @endif
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                       @checked(old('is_active', $partner->is_active ?? true))>
                <label class="form-check-label" for="is_active">Visible sur le site</label>
            </div>
        </div>
    </div>
</div>
