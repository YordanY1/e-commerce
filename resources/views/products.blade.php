@extends('layouts.main')

@section('title', 'Products')

@section('content')
    {{-- Other sections like full-bg-image and fh5co-services --}}

    {{-- Modified Products Section --}}
    <div id="fh5co-product">
        <div class="container">
            {{-- Section Header --}}
            <div class="row animate-box">
                <div class="col-md-8 mx-auto text-center fh5co-heading">
                    <span>Our Exclusive Products</span>
                    <h2>Unique Selections</h2>
                    <p>Explore our range of products, each with its own unique design and style.</p>
                </div>
            </div>

            {{-- Products Grid --}}
            {{-- <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('{{ $product->image_url }}');">

                            </div>
                            <div class="desc">
                                <h3><a href="single.html">{{ $product->name }}</a></h3>
                                <span class="price">${{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>

    {{-- Other content --}}
@endsection
