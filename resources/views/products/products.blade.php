@extends('layouts.products.layout')

@section('content')
<div class="container my-4">
    <div class="filter-section d-flex flex-wrap justify-content-between align-items-start">
        <!-- Category Filters for Desktop -->
        <div class="category-filter-section mb-3">
            <h4>Филтър по категории:</h4>
            <ul class="category-list list-unstyled">
                @foreach ($categories as $category)
                    @if (is_null($category->parent_id))
                        <li class="form-check">
                            <input type="checkbox" id="desktop-category-{{ $category->id }}" class="form-check-input desktop-category-input" data-category="{{ $category->id }}">
                            <label for="desktop-category-{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Manufacturer Filters for Desktop -->
        <div class="manufacturer-filter-section mb-3">
            <h4>Филтър по производители:</h4>
            <ul class="manufacturer-list list-unstyled">
                @foreach ($manufacturers as $manufacturer)
                    <li class="form-check">
                        <input type="checkbox" id="desktop-manufacturer-{{ $manufacturer->id }}" class="form-check-input desktop-manufacturer-input" data-manufacturer="{{ $manufacturer->id }}">
                        <label for="desktop-manufacturer-{{ $manufacturer->id }}" class="form-check-label">{{ $manufacturer->name }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Price Filters for Desktop -->
        <div class="price-filter-section mb-3">
            <h4>Филтриране по цена</h4>
            <ul class="price-range-list list-unstyled">
                <li class="form-check">
                    <input type="checkbox" id="desktop-price-range-1" name="price-range" class="form-check-input desktop-price-range-input" data-price-range="0-50">
                    <label for="desktop-price-range-1" class="form-check-label">0 лв. - 50 лв.</label>
                </li>
                <li class="form-check">
                    <input type="checkbox" id="desktop-price-range-2" name="price-range" class="form-check-input desktop-price-range-input" data-price-range="50-100">
                    <label for="desktop-price-range-2" class="form-check-label">50 лв. - 100 лв.</label>
                </li>
                <li class="form-check">
                    <input type="checkbox" id="desktop-price-range-3" name="price-range" class="form-check-input desktop-price-range-input" data-price-range="100-200">
                    <label for="desktop-price-range-3" class="form-check-label">100 лв. - 200 лв.</label>
                </li>
                <li class="form-check">
                    <input type="checkbox" id="desktop-price-range-4" name="price-range" class="form-check-input desktop-price-range-input" data-price-range="200+">
                    <label for="desktop-price-range-4" class="form-check-label">200+ лв.</label>
                </li>
            </ul>
        </div>

        <!-- Sorting and Pagination for Desktop -->
        <div class="sorting-pagination-section mb-3">
            <div class="sorting-section mb-2">
                <label for="desktop-sorting" class="form-label">Подреди:</label>
                <select id="desktop-sorting" class="form-select">
                    <option value="popular">Най-популярни</option>
                    <option value="expensive">Най-скъпи</option>
                    <option value="low-price">Ниска цена</option>
                </select>
            </div>
            <div class="pagination-section">
                <label for="desktop-pagination" class="form-label">Продукти на страница:</label>
                <select id="desktop-pagination" class="form-select">
                    <option value="all">Всички</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>

        <!-- Buttons for Mobile Filters & Sorting -->
        <div class="mobile-filter-sort-buttons mb-3">
            <button class="btn btn-primary mobile-filter-button" data-bs-toggle="modal" data-bs-target="#filterModal">Филтрирай</button>
            <button class="btn btn-secondary mobile-sort-button" data-bs-toggle="modal" data-bs-target="#sortModal">Подреди</button>
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
