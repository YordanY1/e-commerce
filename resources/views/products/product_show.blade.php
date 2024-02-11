@extends('layouts.products.layout')

@section('title', 'Продукти')

@section('content')
<div id="fh5co-product">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 animate-box">
                <!-- Bootstrap Carousel -->
                <div id="productImage" style="width: 100%; overflow: hidden; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-radius: 10px;">
                    <!-- Display the first image of the product -->
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" alt="{{ $product->name }}">
                    @else

                        <img src="{{ asset('storage/default-placeholder.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" alt="Default Image">
                    @endif
                </div>

                <div class="row justify-content-center animate-box">
                    <div class="col-md-8 text-center fh5co-heading">
                        <h2>{{ $product->name }}</h2>
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
                                                    <span class="price text-primary d-inline-block p-2 bg-light fs-4 rounded">Цена: {{ $product->price->price }} лв.</span>
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
