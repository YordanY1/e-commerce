@extends('layouts.products.layout')

@section('content')
<div class="container my-4">
    <div class="filter-section d-flex flex-wrap justify-content-between">
        <!-- Category Filters for Desktop -->
        <div class="category-filter-section">
            <h4>Филтър по категории:</h4>
            <ul class="category-list">
                @foreach ($categories as $category)
                <li>
                    <input type="checkbox" id="desktop-category-{{ $category->id }}" class="desktop-category-input" data-category="{{ $category->id }}">
                    <label for="desktop-category-{{ $category->id }}">{{ $category->name }}</label>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Price Filters for Desktop -->
        <div class="price-filter-section">
            <h4>Филтриране по цена</h4>
            <ul class="price-range-list">
                <li>
                    <input type="checkbox" id="desktop-price-range-1" name="price-range" class="desktop-price-range-input">
                    <label for="desktop-price-range-1">0 лв. - 50 лв.</label>
                </li>
                <li>
                    <input type="checkbox" id="desktop-price-range-2" name="price-range" class="desktop-price-range-input">
                    <label for="desktop-price-range-2">50 лв. - 100 лв.</label>
                </li>
                <li>
                    <input type="checkbox" id="desktop-price-range-3" name="price-range" class="desktop-price-range-input">
                    <label for="desktop-price-range-3">100 лв. - 200 лв.</label>
                </li>
                <li>
                    <input type="checkbox" id="desktop-price-range-4" name="price-range" class="desktop-price-range-input">
                    <label for="desktop-price-range-4">200+ лв.</label>
                </li>
            </ul>
        </div>

        <!-- Sorting and Pagination for Desktop -->
        <div class="sorting-pagination-section">
            <div class="sorting-section">
                <label for="desktop-sorting">Подреди:</label>
                <select id="desktop-sorting">
                    <option value="popular">Най-популярни</option>
                    <option value="expensive">Най-скъпи</option>
                    <option value="low-price">Ниска цена</option>
                </select>
            </div>
            <div class="pagination-section">
                <label for="desktop-pagination">Продукти на страница:</label>
                <select id="desktop-pagination">
                    <option value="all">Всички</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>

        </div>

        <!-- Buttons for Mobile Filters & Sorting -->
        <div class="mobile-filter-sort-buttons">
            <button class="mobile-filter-button" data-bs-toggle="modal" data-bs-target="#filterModal">Филтрирай</button>
            <button class="mobile-sort-button" data-bs-toggle="modal" data-bs-target="#sortModal">Подреди</button>
        </div>
    </div>

    <!-- Product List Section -->
    <div id="fh5co-product">
        <div class="container">
            @include('products.partials.product_list', ['products' => $products])
        </div>
    </div>
</div>

{{-- Include modals for filters and sorting --}}
@include('components.filter-modal')
@include('components.sort-modal')

    {{-- Include cart modal --}}
    @include('components.products.cart-modal')
@endsection
