@extends('layouts.cart.layout')

@section('content')
<div class="container mt-4">
    <h2>Количка за пазаруване</h2>
    <div id="cart-items" class="mb-3">
        {{-- Cart items will be dynamically inserted here via JavaScript --}}
    </div>

    <!-- Order Summary -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Информация за поръчката</h4>
            <hr>
            <p>Всички продукти: <span id="subtotal-price">299,00 лв.</span></p>
            <p>Общо с данъци: <span id="total-price">327,00 лв.</span></p>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/checkout') }}" class="btn btn-primary">Продължи напред</a>
            </div>
        </div>
    </div>
</div>
@endsection
