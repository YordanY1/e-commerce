@extends('layouts.products.layout')
@section('content')
<div id="fh5co-product">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 animate-box">
                <!-- Bootstrap Carousel -->
                <div id="productImage" style="width: 100%; max-width: 300px; height: auto; overflow: hidden; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-radius: 10px; margin: 0 auto;">
                    <!-- Display the first image of the product -->
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}" style="width: 100%; height: auto; object-fit: contain; border-radius: 10px;" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('storage/default-placeholder.png') }}" style="width: 100%; height: auto; object-fit: contain; border-radius: 10px;" alt="Default Image">
                    @endif
                </div>

                <div class="row justify-content-center animate-box">
                    <div class="col-md-8 text-center fh5co-heading">
                        <h2>{{ $product->name }}</h2>
                        @if($product->manufacturer)
                            <h5 style="color: #777; display: inline;">Производител: <span style="color: #2196F3; display: inline;">{{ $product->manufacturer->name }}</span></h5>
                        @endif
                        <h5 style="color: #777">Код на продукта: {{ $product->code }}</h5>
                            @if ($product->quantity > 0)
                                <h6 style="color: #777; display: inline;">Наличност:</h6> <span style="color: green; display: inline;"> В наличност </span>
                            @else
                                <h6 style="color: #777; display: inline;">Наличност:</h6> <span style="color: red; display: inline;"> Не е в наличност </span>
                            @endif
                        <p>
                            <div class="inner">
                                <span class="price text-primary d-inline-block p-2 bg-light fs-4 rounded">Цена: {{ $product->price->price }} лв.</span>
                                <p>
                                    <a href="#" class="btn btn-primary btn-lg"
                                        onclick="scm_addToCart(this, event);" data-product-id="{{ $product->id }}">
                                            Добави в количката
                                    </a>
                                </p>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="tabs animate-box">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active custom-tab-link" id="home-tab" data-bs-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="true">
                                Детайли
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-tab-link" id="profile-tab" data-bs-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">
                                Спецификации
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-tab-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">
                                Отзиви
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-details" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container py-5">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="tab-content active" data-tab-content="1">
                                            <div class="bg-light p-4 shadow-sm rounded">
                                                    {{-- <h2 class="fw-bold mt-2">{{ $product->name }}</h2> --}}
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="h-100 p-4 border-start border-4 border-primary">
                                                            <h3 class="text-uppercase fw-bold">Ефективност на горивото</h3>
                                                            <p>Рационализирани решения за вашите ежедневни нужди от гориво. Изпитайте простота и надеждност с всяко посещение.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="h-100 p-4 border-start border-4 border-primary">
                                                            <h3 class="text-uppercase fw-bold">Чисто качество, по-малко шум</h3>
                                                            <p>Вярваме, че предлагаме само най-доброто. Висококачествено гориво с просто обслужване, което прави всяка миля от значение.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="specification" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="tab-content active" data-tab-content="2">
                                        <div class="bg-light p-4 shadow-sm rounded">
                                            <h3 class="fw-bold text-primary">Спецификации на продукта</h3>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <p class="text-muted">
                                                        {{ $product->attributes->description ?? 'No description available' }}
                                                    </p>
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="container py-5">
                                <div class="row justify-content-center">
                                       <!-- Display existing reviews -->
                                       <div class="reviews-section mt-5">
                                        <h4>Отзиви на клиенти</h4>
                                        @if($product->reviews->isNotEmpty())
                                            @foreach($product->reviews as $review)
                                                <div class="review-card mb-4">
                                                    <div class="review-user">
                                                        <strong>{{ $review->username ?: 'Anonymous' }}</strong> - <small>{{ $review->created_at->format('d M Y') }}</small>
                                                    </div>
                                                    <div class="review-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <span class="fa fa-star{{ $i <= $review->rating ? ' checked' : '' }}"></span>
                                                        @endfor
                                                    </div>
                                                    <div class="review-text">
                                                        <p>{{ $review->comment }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">Няма отзиви за този продукт.</p>
                                        @endif
                                    </div>

                                    <div class="col-lg-10 add-review">
                                        <h3 class="text-primary">Напишете отзив</h3>
                                            <form action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Вашето име:</label>
                                                    <input type="text" class="form-control" id="username" name="username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rating" class="form-label">Оценка:</label>
                                                    <div class="star-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <span class="fa fa-star" data-rating="{{ $i }}"></span>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="rating" id="rating" value="1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="review" class="form-label">Отзив:</label>
                                                    <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Изпрати отзив</button>
                                            </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-products.cart-modal/>
@endsection

@push('scripts')
<script>
    let addStars = document.querySelectorAll('.add-review .fa-star');
    let ratingInput = document.getElementById('rating');

    addStars.forEach((star, idx) => {
        star.addEventListener('click', () => {
            ratingInput.value = idx + 1;  // Set rating input value
            updateAddStars(idx);
        });

        star.addEventListener('mouseover', () => {
            updateAddStars(idx);
        });

        star.addEventListener('mouseout', () => {
            updateAddStars(ratingInput.value - 1);  // Reset stars based on selected rating
        });
    });

    function updateAddStars(index) {
        addStars.forEach((star, idx) => {
            if (idx <= index) {
                star.classList.add('checked');
            } else {
                star.classList.remove('checked');
            }
        });
    }

    let reviewForm = document.querySelector('form[action="{{ route('reviews.store') }}"]');
        reviewForm.addEventListener('submit', () => {
            Object.keys(localStorage).forEach(key => {
                if (key !== 'cookieConsent') {
                    localStorage.removeItem(key);
                }
            });
        });
</script>

@endpush
