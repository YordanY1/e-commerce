@extends('layouts.products.layout')

@section('content')
<div class="container my-4">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    @if ($category->children->isNotEmpty())
        <h4>Подкатегории:</h4>
        <div class="row">
            @foreach ($category->children as $subCategory)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if ($subCategory->image)
                            <img src="{{ Storage::url($subCategory->image) }}" class="card-img-top" alt="{{ $subCategory->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $subCategory->name }}</h5>
                            <p class="card-text">{{ $subCategory->description }}</p>
                            <a href="{{ url('/products?category=' . $subCategory->slug) }}" class="btn btn-primary">Виж продуктите</a>
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
