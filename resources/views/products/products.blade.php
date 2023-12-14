{{-- @extends('layouts.main')

@section('title', 'Products')

@section('content')
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 mx-auto text-center fh5co-heading">
                    <span>Our Exclusive Products</span>
                    <h2>Unique Selections</h2>
                    <p>Explore our range of products, each with its own unique design and style.</p>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url('{{ $product->image_url }}');">

                            </div>
                            <div class="desc">
                                <h3><a href="{{ url('/product') }}">{{ $product->name }}</a></h3>
                                <span class="price">${{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.main')

@section('title', 'Products')

@section('content')
    {{-- Category Filters --}}
    <div class="container my-4">
        <div class="filter-section d-flex flex-wrap justify-content-between">
            <!-- Category Filters -->
            <div class="category-filter-section">
                <h4>Filter by Category:</h4>
                <ul class="category-list">
                    <li>
                        <input type="checkbox" id="category-all" class="category-input" data-category="all">
                        <label for="category-all">All</label>
                    </li>
                    <li>
                        <input type="checkbox" id="category-furniture" class="category-input" data-category="furniture">
                        <label for="category-furniture">Furniture</label>
                    </li>
                    <li>
                        <input type="checkbox" id="category-electronics" class="category-input" data-category="electronics">
                        <label for="category-electronics">Electronics</label>
                    </li>
                    <li>
                        <input type="checkbox" id="category-clothing" class="category-input" data-category="clothing">
                        <label for="category-clothing">Clothing</label>
                    </li>
                    <!-- Add more categories as needed -->
                </ul>
            </div>

            <!-- Price Filters -->
            <div class="price-filter-section">
                <h4>Filter by Price:</h4>
                <ul class="price-range-list">
                    <li>
                        <input type="radio" id="price-range-1" name="price-range" class="price-range-input">
                        <label for="price-range-1">$0 - $50</label>
                    </li>
                    <li>
                        <input type="radio" id="price-range-2" name="price-range" class="price-range-input">
                        <label for="price-range-2">$50 - $100</label>
                    </li>
                    <li>
                        <input type="radio" id="price-range-3" name="price-range" class="price-range-input">
                        <label for="price-range-3">$100 - $200</label>
                    </li>
                    <li>
                        <input type="radio" id="price-range-4" name="price-range" class="price-range-input">
                        <label for="price-range-4">$200+</label>
                    </li>
                    <!-- Add more price ranges as needed -->
                </ul>
            </div>

             <!-- Sorting and Pagination -->
        <div class="sorting-pagination-section">
            <div class="sorting-section">
                <label for="sorting">Подреди:</label>
                <select id="sorting">
                    <option value="popular">Най-популярни</option>
                    <option value="expensive">Най-скъпи</option>
                    <option value="low-price">Ниска цена</option>
                </select>
            </div>
            <div class="pagination-section">
                <label for="pagination">Продукти на страница:</label>
                <select id="pagination">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <!-- More options as needed -->
                </select>
            </div>
        </div>

        <div class="mobile-filter-sort-buttons">
            <button class="mobile-filter-button" data-bs-toggle="modal" data-bs-target="#filterModal">Филтрирай</button>
            <button class="mobile-sort-button" data-bs-toggle="modal" data-bs-target="#sortModal">Подреди</button>
        </div>

        {{-- Filter Modal with its content --}}
        <x-filter-modal>
        {{-- Include category-filter-section and price-filter-section here --}}
        </x-filter-modal>

        {{-- Sort Modal with its content --}}
        <x-sort-modal>
        {{-- Include sorting-pagination-section here --}}
        </x-sort-modal>


    </div>

    {{-- Products Grid --}}
    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                {{-- Section Header --}}
                <div class="col-md-8 mx-auto text-center fh5co-heading">
                    <span>Our Exclusive Products</span>
                    <h2>Unique Selections</h2>
                    <p>Explore our range of products, each with its own unique design and style.</p>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="row">
                {{-- Hardcoded Products for Demonstration --}}
                <div class="col-md-4 text-center animate-box" data-category="furniture">
                    <div class="product">
                        <div class="product-grid" style="background-image:url('/images/product-1.jpg');">
                            <div class="inner">
                                <p>
                                    <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Wooden Chair</a></h3>
                            <span class="price">$150</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box" data-category="electronics">
                    <div class="product">
                        <div class="product-grid" style="background-image:url('/images/product-2.jpg');">
                            <div class="inner">
                                <p>
                                    <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Smartphone</a></h3>
                            <span class="price">$500</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box" data-category="clothing">
                    <div class="product">
                        <div class="product-grid" style="background-image:url('/images/product-3.jpg');">
                            <div class="inner">
                                <p>
                                    <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Leather Jacket</a></h3>
                            <span class="price">$250</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box" data-category="clothing">
                    <div class="product">
                        <div class="product-grid" style="background-image:url('/images/product-3.jpg');">
                            <div class="inner">
                                <p>
                                   <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Leather Jacket</a></h3>
                            <span class="price">$250</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box" data-category="clothing">
                    <div class="product">
                          <div class="product-grid" style="background-image:url('/images/product-3.jpg');">
                            <div class="inner">
                                <p>
                                   <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Leather Jacket</a></h3>
                            <span class="price">$250</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center animate-box" data-category="clothing">
                    <div class="product">
                          <div class="product-grid" style="background-image:url('/images/product-3.jpg');">
                            <div class="inner">
                                <p>
                                   <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="{{ url('/product') }}" class="icon"><i class="fas fa-eye"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{ url('/product') }}">Leather Jacket</a></h3>
                            <span class="price">$250</span>
                        </div>
                    </div>
                </div>
                <x-products.cart-modal/>
            </div>
        </div>
    </div>
@endsection
