@extends('layouts.cart.layout')

@section('content')
<div class="container mt-4">
    <h2>Количка за пазаруване</h2>

    <!-- Cart Items -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Продукти в количката</h4>
            <hr>

            <div id="cart-items">
                {{-- Cart items will be dynamically inserted here via JavaScript --}}
            </div>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Информация за поръчката</h4>
            <hr>

            <p>Всички продукти: <span id="subtotal-price"></span></p>
            <p>Общо с ДСС: <span id="total-price"></span></p>

            <div class="d-flex justify-content-end">
                <a href="{{ url('/checkout') }}" class="btn btn-primary">Продължи напред</a>
            </div>
        </div>
    </div>
</div>
@endsection
