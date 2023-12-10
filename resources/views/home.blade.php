@extends('layouts.main')

@section('title', 'Home')

@section('content')

        <div class="full-bg-image">
            <div class="container">
                <div class="welcome-text">
                    <h1>Welcome to Our Shop</h1>
                    <p>Discover a world of unique and beautiful items</p>
                </div>
            </div>
        </div>

        <div id="fh5co-services" class="fh5co-bg-section">
            <div class="container">
                <div class="row">
                    <!-- Service Item 1 -->
                    <div class="col-lg-4 col-md-6 text-center service-item">
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3>Credit Card</h3>
                        <p>Far far away, behind the word mountains...</p>
                        <a href="#" class="btn btn-custom btn-outline">Learn More</a>
                    </div>

                    <!-- Service Item 2 -->
                    <div class="col-lg-4 col-md-6 text-center service-item">
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h3>Save Money</h3>
                        <p>Far far away, behind the word mountains...</p>
                        <a href="#" class="btn btn-custom btn-outline">Learn More</a>
                    </div>

                    <!-- Service Item 3 -->
                    <div class="col-lg-4 col-md-6 text-center service-item">
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>Free Delivery</h3>
                        <p>Far far away, behind the word mountains...</p>
                        <a href="#" class="btn btn-custom btn-outline">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

          <!-- Products Section -->
          <div id="fh5co-product">
            <div class="container">
                <!-- Section Header -->
                <div class="row animate-box">
                    <div class="col-md-8 mx-auto text-center fh5co-heading">
                        <span>Cool Stuff</span>
                        <h2>Products</h2>
                        <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row">
                    <!-- Product 1 -->
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                    </p>
                                </div>

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                    </p>
                                </div>

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                    </p>
                                </div>

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                    </p>
                                </div>

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="single.html" class="icon"><i class="fas fa-eye"></i></a>
                                    </p>
                                </div>

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <!-- Add more products as needed -->
                </div>
            </div>
        </div>
@endsection
