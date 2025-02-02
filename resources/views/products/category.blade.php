@extends('layouts.caterogies.layout')

@section('content')
<div class="container my-4">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    @if ($category->children->isNotEmpty())
        <div class="row">
            <!-- Card for "All" categories -->
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="Всички категории">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Всички</h5>
                        <p class="card-text">Виж всички продукти от тази категория</p>
                        <a href="{{ url('/products?category=' . $category->slug) }}" class="btn btn-primary">Виж всички продукти</a>
                    </div>
                </div>
            </div>

            <!-- Card for the selected category -->
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">Виж всички продукти от тази категория</p>
                        <a href="{{ url('/products?category=' . $category->slug) }}" class="btn btn-primary">Виж всички продукти</a>
                    </div>
                </div>
            </div>

            <!-- Loop through subcategories -->
            @foreach ($category->children as $subCategory)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if ($subCategory->image)
                            <img src="{{ asset('storage/' . $subCategory->image) }}" class="card-img-top" alt="{{ $subCategory->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $subCategory->name }}</h5>
                            <p class="card-text">Виж всички продукти от тази подкатегория</p>
                            <a href="{{ url('/products?category=' . $subCategory->slug) }}" class="btn btn-primary">Виж всички продукти</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No subcategories found.</p>
    @endif
</div>
@endsection
