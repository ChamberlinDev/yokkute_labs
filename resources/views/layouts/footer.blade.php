<link href="{{ $versionedAsset('css/footer.css') }}" rel="stylesheet">

<footer class="footer-yokkute text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 footer-main-row">
            <div class="col-md-4 mb-4 mb-md-0">
                <p class="footer-kicker mb-2">{{ $localizedSetting($siteSettings, 'site_tagline', 'site.settings.site_tagline') }}</p>
                <h5 class="footer-title mb-3">{{ $siteSettings['site_name'] ?? 'Yokkute Labs' }}</h5>
                <p class="footer-text mb-0">
                    {{ $localizedSetting($siteSettings, 'footer_text', 'site.settings.footer_text') }}
                </p>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="footer-heading mb-3">{{ __('site.footer.quick_links') }}</h6>
                <ul class="list-unstyled footer-links-list mb-0">
                    <li><a href="{{ route('about') }}" class="footer-link text-decoration-none text-light">{{ __('site.footer.about') }}</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link text-decoration-none text-light">{{ __('site.footer.services') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link text-decoration-none text-light">{{ __('site.footer.contact') }}</a></li>
                    <li><a href="{{ route('faq') }}" class="footer-link text-decoration-none text-light">{{ __('site.footer.faq') }}</a></li>
                    <li><a href="{{ route('rgpd') }}" class="footer-link text-decoration-none text-light">{{ __('site.footer.privacy') }}</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="footer-heading mb-3">{{ __('site.footer.contact_heading') }}</h6>
                <p class="footer-contact-item mb-2 d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                    <span>{{ $siteSettings['contact_address'] ?? 'Dakar, Senegal' }}</span>
                </p>
                <p class="footer-contact-item mb-2 d-flex align-items-center gap-2">
                    <i class="bi bi-envelope-at-fill" aria-hidden="true"></i>
                    <a href="mailto:{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}" class="footer-link text-decoration-none text-light">{{ $siteSettings['contact_email'] ?? 'solution@yokkutelabs.com' }}</a>
                </p>
                <p class="footer-contact-item mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                    <a href="tel:{{ $siteSettings['contact_phone_href'] ?? '+221771488937' }}" class="footer-link text-decoration-none text-light">{{ $siteSettings['contact_phone'] ?? '+221 771488937' }}</a>
                </p>
            </div>
        </div>

        <hr class="footer-separator">

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="footer-legal-links d-flex gap-3 mb-2 mb-md-0">
                <a href="{{ route('faq') }}" class="footer-link text-decoration-none text-light" style="opacity:.75; font-size:.85em;">{{ __('site.footer.faq') }}</a>
                <span style="opacity:.4;">|</span>
                <a href="{{ route('rgpd') }}" class="footer-link text-decoration-none text-light" style="opacity:.75; font-size:.85em;">{{ __('site.footer.privacy') }}</a>
            </div>

            <span class="footer-copyright">
                &copy; {{ date('Y') }} Yokkute Labs - {{ __('site.footer.copyright') }}
            </span>

            <div class="footer-icons mt-3 mt-md-0">
                <a href="{{ $siteSettings['linkedin_url'] ?? '#' }}" class="text-light me-2 fs-5" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                <a href="{{ $siteSettings['facebook_url'] ?? '#' }}" class="text-light me-2 fs-5" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="{{ $siteSettings['instagram_url'] ?? '#' }}" class="text-light me-2 fs-5" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="{{ $siteSettings['twitter_url'] ?? '#' }}" class="text-light me-2 fs-5" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://wa.me/{{ $siteSettings['whatsapp_number'] ?? '221771488937' }}" target="_blank" rel="noopener noreferrer" class="text-light fs-5" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</footer>
