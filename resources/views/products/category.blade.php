<!-- resources/views/products/category.blade.php -->
@extends('layouts.products.layout')

@section('content')
<div class="container my-4">
    <h1>{{ $category->name }}</h1>
    <div class="row">
        @foreach ($subcategories as $subCategory)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subCategory->name }}</h5>
                        <p class="card-text">{{ $subCategory->description }}</p>
                        <a href="{{ url('/products?category=' . $subCategory->slug) }}" class="btn btn-primary">View Products</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
