@extends('layouts.home.layout')

@section('title', 'Home')

@section('content')

        <div class="full-bg-image" style="background-image: url('/images/img_bg_1.jpg');">
            <div class="container">
                <div class="welcome-text" data-aos="fade-in" data-aos-duration="1000">
                    <h2>Добре дошли в нашия магазин!</h2>
                    <h6>Разгледайте нашите разнообразни продукти</h6>
                </div>
            </div>
        </div>


        <div id="fh5co-services" class="fh5co-bg-section">
            <div class="container">
                <div class="row">
                    <!-- Service Item 1 -->
                    <div class="col-lg-4 col-md-6 text-center service-item"
                         data-aos="fade-up"
                         data-aos-duration="1000"
                         data-aos-delay="500">
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3>Кредитни карти</h3>
                        <p>Предлагаме плащане с кредитни карти.</p>
                    </div>

                    <!-- Service Item 2 -->
                    <div class="col-lg-4 col-md-6 text-center service-item"
                         data-aos="fade-up"
                         data-aos-duration="1000"
                         data-aos-delay="1000">
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h3>Изгодни цени</h3>
                        <p>Предлагаме доста изгодни и добри цени</p>
                    </div>

                    <!-- Service Item 3 -->
                    <div class="col-lg-4 col-md-6 text-center service-item"
                         data-aos="fade-up"
                         data-aos-duration="1000"
                         data-aos-delay="1500">
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>Бърза доставка</h3>
                        <p>Изпращаме доставки до всички краища на България</p>
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
                        <span>Част от нашите</span>
                        <h2>Продукти</h2>
                    </div>
                </div>

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="product">
                                @foreach ($product->images as $image)
                                    <div class="product-grid" style="background-image:url('{{ asset('storage/' . $image->path) }}');">
                                    @endforeach
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon add-to-cart btn btn-primary square-icon">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                            <a href="{{ url('/product', $product->id) }}" class="icon btn btn-primary square-icon">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3><a href="{{ url('/product', $product->id) }}">{{ $product->name }}</a></h3>
                                    <span class="price">${{ $product->price->price ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <x-products.cart-modal/>
                </div>
            </div>
        </div>
@endsection
