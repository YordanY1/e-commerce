<!-- In your Navbar component view -->
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

                        <!-- List main categories and their subcategories -->
                        @foreach ($categories as $category)
                            @if($category->children->isEmpty())
                                <li><a class="dropdown-item" href="{{ url('/products?category=' . $category->slug) }}">{{ $category->name }}</a></li>
                            @else
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main-category" href="{{ route('category.show', $category->slug) }}" data-slug="{{ $category->slug }}">{{ $category->name }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($category->children as $subCategory)
                                            <li><a class="dropdown-item" href="{{ url('/products?category=' . $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/services') }}">Услуги</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/about') }}">За нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact') }}">Контакти</a>
                </li>

                <!-- Search Input Form -->
                <form class="example navbar-nav form-inline" action="{{ url('/products') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-input" name="search" placeholder="Търсене..." autocomplete="off" style="padding: 10px">
                        <div class="input-group-append">
                            <!-- Initially hidden, shown when there's text -->
                            <button class="btn btn-outline-secondary clear-search" type="button" id="clear-search" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                            <!-- Initially visible, hidden when there's text -->
                            <button class="btn btn-outline-secondary" type="button" id="search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div id="search-dropdown" class="dropdown-menu" style="width: 100%; display: none;"></div>
                    </div>
                </form>
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


<!-- Include Popper.js and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Custom Script for Handling Nested Dropdowns -->
<script>
    $(document).ready(function() {
        var storedQuery = localStorage.getItem('lastSearch');
        var debounceTimer;

        // Initially populate the input but don't trigger search
        if (storedQuery) {
            $('#search-input').val(storedQuery);
            toggleIcons(storedQuery.length > 0);
        }

        $('#search-input').on('input focus click', function(event) {
            var query = $(this).val();
            localStorage.setItem('lastSearch', query);
            toggleIcons(query.length > 0);

            if (event.type === 'input' || (event.type === 'focus' && query.length > 0)) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    triggerSearch(query);
                }, 300);
            }
        });

        $('#clear-search').click(function() {
            $('#search-input').val('');
            $('#search-dropdown').hide();
            toggleIcons(false);
            localStorage.removeItem('lastSearch');
            triggerSearch('');
        });

        function triggerSearch(query) {
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('ajax.search') }}",
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        $('#search-dropdown').html(response.html).show();
                    }
                });
            } else {
                $('#search-dropdown').hide();
            }
        }

        function toggleIcons(hasText) {
            $('#clear-search').toggle(hasText); // Show clear icon if text is present
            $('#search-btn').toggle(!hasText); // Show search icon if text is not present
        }

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search-input').length && !$(e.target).closest('#search-btn').length && !$(e.target).closest('#clear-search').length) {
                $('#search-dropdown').hide();
            }
        });

        $('#search-input').on('blur', function() {
            setTimeout(function() {
                $('#search-dropdown').hide();
            }, 300);
        });

        // Handle nested dropdowns
        $('.dropdown-submenu').hover(function(e) {
            if ($(window).width() >= 992) { // Apply hover behavior only on desktop
                $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
            }
        }, function(e) {
            if ($(window).width() >= 992) { // Apply hover behavior only on desktop
                $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
            }
        });

        // Handle click behavior for mobile devices
        $('.main-category').click(function(e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>
