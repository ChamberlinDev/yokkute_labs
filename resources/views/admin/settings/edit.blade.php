@extends('admin.layouts.app')

@section('title', 'Reglages')
@section('page-title', 'Reglages du site')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="d-grid gap-4">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card card-soft p-4">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Nom du site</label><input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Baseline</label><input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"></div>
                    <div class="col-12"><label class="form-label">Texte footer</label><textarea name="footer_text" class="form-control" rows="3">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea></div>
                    <div class="col-12"><hr class="my-2"></div>
                    <div class="col-12"><p class="text-muted mb-0 fw-semibold">Contenu page d'accueil</p></div>
                    <div class="col-md-6"><label class="form-label">Meta title accueil</label><input type="text" name="home_meta_title" class="form-control" value="{{ old('home_meta_title', $settings['home_meta_title'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Badge hero</label><input type="text" name="home_badge_text" class="form-control" value="{{ old('home_badge_text', $settings['home_badge_text'] ?? '') }}" required></div>
                    <div class="col-12"><label class="form-label">Titre hero (3 lignes possibles)</label><textarea name="home_hero_title" class="form-control" rows="3" required>{{ old('home_hero_title', $settings['home_hero_title'] ?? '') }}</textarea></div>
                    <div class="col-12"><label class="form-label">Sous-titre hero</label><textarea name="home_hero_sub" class="form-control" rows="3" required>{{ old('home_hero_sub', $settings['home_hero_sub'] ?? '') }}</textarea></div>
                    <div class="col-md-6"><label class="form-label">Label CTA principal</label><input type="text" name="home_primary_cta_label" class="form-control" value="{{ old('home_primary_cta_label', $settings['home_primary_cta_label'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">URL CTA principal</label><input type="text" name="home_primary_cta_url" class="form-control" value="{{ old('home_primary_cta_url', $settings['home_primary_cta_url'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Label CTA secondaire</label><input type="text" name="home_secondary_cta_label" class="form-control" value="{{ old('home_secondary_cta_label', $settings['home_secondary_cta_label'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">URL CTA secondaire</label><input type="text" name="home_secondary_cta_url" class="form-control" value="{{ old('home_secondary_cta_url', $settings['home_secondary_cta_url'] ?? '') }}" required></div>
                    <div class="col-12"><hr class="my-2"></div>
                    <div class="col-12"><p class="text-muted mb-0 fw-semibold">Coordonnees et reseaux</p></div>
                    <div class="col-md-6"><label class="form-label">Email contact</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Email RH</label><input type="email" name="rh_email" class="form-control" value="{{ old('rh_email', $settings['rh_email'] ?? '') }}" required></div>
                    <div class="col-12"><hr class="my-2"></div>
                    <div class="col-12"><p class="text-muted mb-0 fw-semibold">Gestion des mails (back-office)</p></div>
                    <div class="col-12">
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" role="switch" id="mail_notifications_enabled" name="mail_notifications_enabled" value="1" @checked(old('mail_notifications_enabled', $settings['mail_notifications_enabled'] ?? '1') === '1')>
                            <label class="form-check-label" for="mail_notifications_enabled">Activer les notifications email automatiques</label>
                        </div>
                    </div>
                    <div class="col-md-6"><label class="form-label">Email notification contact (optionnel)</label><input type="email" name="contact_notification_email" class="form-control" value="{{ old('contact_notification_email', $settings['contact_notification_email'] ?? '') }}" placeholder="Par defaut: Email contact"></div>
                    <div class="col-md-6"><label class="form-label">Email notification RH (optionnel)</label><input type="email" name="rh_notification_email" class="form-control" value="{{ old('rh_notification_email', $settings['rh_notification_email'] ?? '') }}" placeholder="Par defaut: Email RH"></div>
                    <div class="col-md-6"><label class="form-label">Telephone</label><input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Telephone href</label><input type="text" name="contact_phone_href" class="form-control" value="{{ old('contact_phone_href', $settings['contact_phone_href'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Numero WhatsApp</label><input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Adresse</label><input type="text" name="contact_address" class="form-control" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">LinkedIn</label><input type="text" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"></div>
                    <div class="col-md-6"><label class="form-label">Facebook</label><input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"></div>
                    <div class="col-md-6"><label class="form-label">Instagram</label><input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"></div>
                    <div class="col-md-6"><label class="form-label">Twitter/X</label><input type="text" name="twitter_url" class="form-control" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-soft p-4 d-grid gap-3">
                <div>
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                @if(!empty($settings['logo_path']))
                    <img src="{{ asset($settings['logo_path']) }}" alt="Logo" class="img-fluid rounded-4 border p-3 bg-white">
                @endif
                <button type="submit" class="btn btn-success">Enregistrer les reglages</button>
            </div>
        </div>
    </div>
</form>
@endsection