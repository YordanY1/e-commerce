<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/products') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact') }}">Contacts</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="cart.html">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge bg-primary">0</span>
                </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
