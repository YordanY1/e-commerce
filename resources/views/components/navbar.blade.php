<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom-color">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('svg/jeronimo-logo-color.svg') }}" style="width: 100px" alt="Logo">
        </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Начало</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Категории
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- Add an option for all categories -->
                    <li><a class="dropdown-item" href="{{ url('/products') }}">Всички категории</a></li>

                 <!-- List all individual categories -->
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{ url('/products?category=' . $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">За нас</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact') }}">Контакти</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge bg-primary" id="cart-badge">0</span>
                </a>
            </li>
        </ul>
      </div>
    </div>
</nav>
