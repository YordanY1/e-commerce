{{--
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>
        <div class="cart-items">
            @foreach (session('cart', []) as $item)
                <div class="cart-item">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    <div>
                        <h5>{{ $item['name'] }}</h5>
                        <p>${{ $item['price'] }}</p>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <a href="{{ route('cart.remove', $item['id']) }}">Remove</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total">
            <h4>Total: ${{ session('total', 0) }}</h4>
        </div>

        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
    </div>
@endsection --}}
