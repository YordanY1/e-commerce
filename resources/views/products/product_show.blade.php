@extends('layouts.products.layout')

@section('title', 'Product Details')

@section('content')
<div id="fh5co-product">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 animate-box">
                <!-- Bootstrap Carousel -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        @foreach($product->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Add carousel controls if there are multiple images -->
                    @if($product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>

                <!-- Bootstrap Stepper (Dynamic) -->
                @if($product->images->count() > 1)
                  <!-- Bootstrap Stepper (Display regardless of image count) -->
                    <div class="d-flex justify-content-center mt-4" id="carouselStepper">
                        <ul class="dot-stepper">
                            @foreach($product->images as $key => $image)
                                <li onclick="moveCarousel({{ $key }})" class="{{ $key == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row justify-content-center animate-box">
                    <div class="col-md-8 text-center fh5co-heading">
                        <h2>{{ $product->name }}</h2> <!-- Display product name dynamically -->
                        <p>
                            <a href="#" class="btn btn-primary btn-lg" id="add-to-cart">Добави в количката</a>
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
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-details" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container py-5">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="tab-content active" data-tab-content="1">
                                            <div class="bg-light p-4 shadow-sm rounded">
                                                    <h2 class="fw-bold mt-2">{{ $product->name }}</h2>
                                                    <span class="price text-primary">Цена: ${{ $product->price->price }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
