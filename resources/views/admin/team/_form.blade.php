<div class="row g-4">
    <div class="col-lg-8">
        <div class="card card-soft p-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="order_column" class="form-control" value="{{ old('order_column', $member->order_column ?? 1) }}" min="0" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Poste FR</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role EN</label>
                    <input type="text" name="role_en" class="form-control" value="{{ old('role_en', $member->role_en) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">LinkedIn</label>
                    <input type="text" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $member->linkedin_url) }}" placeholder="linkedin.com/in/nom ou https://linkedin.com/in/nom">
                </div>

                <div class="col-12">
                    <label class="form-label">Bio FR</label>
                    <textarea name="bio" class="form-control" rows="5">{{ old('bio', $member->bio) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Bio EN</label>
                    <textarea name="bio_en" class="form-control" rows="5">{{ old('bio_en', $member->bio_en) }}</textarea>
                    <div class="form-text">Laisser vide pour reutiliser temporairement le contenu FR cote site.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-soft p-4 d-grid gap-3">
            <div>
                <label class="form-label">Photo</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            @if($member->image_path)
                <img src="{{ asset($member->image_path) }}" alt="Apercu" class="img-fluid rounded-4 border">
            @endif
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $member->is_active ?? true))>
                <label class="form-check-label" for="is_active">Visible sur le site</label>
            </div>
        </div>
    </div>
</div>
