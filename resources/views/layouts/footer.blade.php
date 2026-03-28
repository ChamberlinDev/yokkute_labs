<link href="{{ asset('css/footer.css') }}" rel="stylesheet">

<footer class="footer-yokkute bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">

            <!-- Logo / Description -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Yokkuté Labs</h5>
                <p class="small">
                    Nous développons des solutions web modernes pour accompagner
                    les entreprises dans leur transformation digitale.
                </p>
            </div>

            <!-- Liens rapides -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Liens rapides</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('about') }}" class="text-decoration-none text-light">À propos</a></li>
                    <li><a href="{{ route('services') }}" class="text-decoration-none text-light">Services</a></li>
                    <li><a href="{{ route('contact') }}" class="text-decoration-none text-light">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Contact</h6>
                <p class="small mb-1">📍 Dakar, Sénégal</p>
                <p class="small mb-1">📧 contact@yokkute.com</p>
                <p class="small">📞 +221 77 000 00 00</p>
            </div>

        </div>

        <!-- Séparateur -->
        <hr class="border-light">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">

            <!-- Copyright -->
            <span class="small">
                © {{ date('Y') }} Yokkuté Labs — Tous droits réservés
            </span>

            <!-- Réseaux sociaux -->
            <div class="footer-icons mt-3 mt-md-0">
                <a href="#" class="text-light me-3 fs-5"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="text-light me-3 fs-5"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3 fs-5"><i class="bi bi-github"></i></a>
                <a href="#" class="text-light fs-5"><i class="bi bi-whatsapp"></i></a>
            </div>

        </div>
    </div>
</footer>