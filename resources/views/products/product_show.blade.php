@extends('layouts.main')

@section('title', 'Product Details')

@section('content')
<div id="fh5co-product">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 animate-box">
                <!-- Bootstrap Carousel -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/product-single-1.jpg') }}" class="d-block w-100" alt="Product Image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/product-single-2.jpg') }}" class="d-block w-100" alt="Product Image 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/product-single-3.jpg') }}" class="d-block w-100" alt="Product Image 3">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap Stepper -->
                <div class="d-flex justify-content-center mt-4" id="carouselStepper">
                    <ul class="dot-stepper">
                        <li onclick="moveCarousel(0)"></li>
                        <li onclick="moveCarousel(1)"></li>
                        <li onclick="moveCarousel(2)"></li>
                        <!-- Add more dots as needed -->
                    </ul>
                </div>
                <!-- Product Details Section -->
                <!-- ... -->
            </div>
        </div>
    </div>
</div>

@endsection
