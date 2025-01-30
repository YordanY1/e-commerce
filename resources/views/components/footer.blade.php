<footer id="fh5co-footer" class="bg-light footer-custom-color">
    <div class="container">
        <div class="row">
            <!-- Logo Column -->
            <div class="col-12 col-sm-2 d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-sm-0">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('svg/jeronimo-logo-color.svg') }}" style="width: 100px;" alt="Logo">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="col-12 col-sm-8 d-flex justify-content-center mb-3 mb-sm-0">
                <ul class="nav flex-column flex-sm-row">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">За нас</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Контакти</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('terms.index') }}">Общи условия</a>
                    </li>
                </ul>
            </div>

            <!-- Social Icons -->
            <div class="col-12 col-sm-2 d-flex align-items-center justify-content-center justify-content-sm-end mb-3 mb-sm-0">
                <ul class="nav flex-column flex-sm-row">
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright Notice -->
        <div class="row">
            <div class="col-12 text-center mt-3">
               <p class="text-muted">Всички права са спазени ©{{ now()->year }} Джеронимо</p>
            </div>
        </div>
    </div>
</footer>
