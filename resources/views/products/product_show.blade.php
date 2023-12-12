@extends('layouts.main')

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

                <!-- Bootstrap Stepper -->
                <div class="d-flex justify-content-center mt-4" id="carouselStepper">
                    <ul class="dot-stepper">
                        <li onclick="moveCarousel(0)"></li>
                        <li onclick="moveCarousel(1)"></li>
                        <li onclick="moveCarousel(2)"></li>
                        <!-- Add more dots as needed -->
                    </ul>
                </div>
                <div class="row justify-content-center animate-box">
                    <div class="col-md-8 text-center fh5co-heading">
                        <h2>Hauteville Rocking Chair</h2>
                        <p>
                            <a href="#" class="btn btn-primary btn-lg" id="add-to-cart">Add to Cart</a>
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
                                Product Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-tab-link" id="profile-tab" data-bs-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">
                                Specification
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
                                                <span class="price text-primary">SRP: $350</span>
                                                <h2 class="fw-bold mt-2">Hauteville Rocking Chair</h2>
                                                <p class="text-muted">
                                                    Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.
                                                </p>
                                                <p class="text-muted">
                                                    Ullam dolorum iure dolore dicta fuga ipsa velit veritatis molestias totam fugiat soluta accusantium omnis quod similique placeat at. Dolorum ducimus libero fuga molestiae asperiores obcaecati corporis sint illo facilis.
                                                </p>
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="h-100 p-4 border-start border-4 border-primary">
                                                            <h3 class="text-uppercase fw-bold">Keep it simple</h3>
                                                            <p>Ullam dolorum iure dolore dicta fuga ipsa velit veritatis</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="h-100 p-4 border-start border-4 border-primary">
                                                            <h3 class="text-uppercase fw-bold">Less is more</h3>
                                                            <p>Ullam dolorum iure dolore dicta fuga ipsa velit veritatis</p>
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
                                            <h3 class="fw-bold text-primary">Product Specification</h3>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci dignissimos consectetur magni quas eius</li>
                                                <li class="list-group-item">adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi</li>
                                                <li class="list-group-item">Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                                <li class="list-group-item">Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                            </ul>
                                            <ul class="list-group list-group-flush mt-3">
                                                <li class="list-group-item">Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci dignissimos consectetur magni quas eius</li>
                                                <li class="list-group-item">adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi</li>
                                                <li class="list-group-item">Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                                <li class="list-group-item">Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.</li>
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
