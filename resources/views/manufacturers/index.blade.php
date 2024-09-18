@extends('layouts.manufacturers.layout')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-4">Производители</h1>
    <div class="row">
        @foreach ($manufacturers as $manufacturer)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($manufacturer->image)
                        <img src="{{ asset($manufacturer->image) }}" class="card-img-top" alt="{{ $manufacturer->name }}">
                    @else
                        <img src="{{ asset('images/default-manufacturer.png') }}" class="card-img-top" alt="{{ $manufacturer->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $manufacturer->name }}</h5>
                        <a href="{{ route('manufacturers.show', $manufacturer->slug) }}" class="btn btn-primary">Виж продукти</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
