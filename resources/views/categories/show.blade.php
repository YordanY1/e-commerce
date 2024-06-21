@extends('layouts.products.layout')

@section('content')
<div class="container my-4">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h4>Подкатегории:</h4>
    <ul>
        @foreach ($category->children as $subCategory)
            <li><a href="{{ url('/products?category=' . $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
