@extends('layouts.products.layout')

@section('title', 'Products')

@section('content')
    {{-- Category Filters --}}
    <div class="container my-4">
        <div class="filter-section d-flex flex-wrap justify-content-between">
            <!-- Category Filters -->
            <div class="category-filter-section">
                <h4>Филтър по категории:</h4>
                <ul class="category-list">
                    <li>
                        <input type="checkbox" id="category-all" class="category-input" data-category="all">
                        <label for="category-all">Всички</label>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <input type="checkbox" id="category-{{ $category->id }}" class="category-input" data-category="{{ $category->id }}">
                            <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>


            <!-- Price Filters -->
            <div class="price-filter-section">
                <h4>Филтриране по цена</h4>
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

    <div id="fh5co-product">
        <div class="container">

            @include('products.partials.product_list', ['products' => $products])
        </div>
        <x-products.cart-modal/>
    </div>
@endsection
