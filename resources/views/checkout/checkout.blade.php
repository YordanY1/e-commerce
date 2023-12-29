@extends('layouts.checkout.layout')

@section('content')
    <div class="container">
        <h1>Завършване на поръчката</h1>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Детайли на поръчката</h2>
            <div id="order-items">
                {{-- Dynamically inserted order items will go here --}}
            </div>
            <div class="edit-cart">
                <a href="{{ url('/cart') }}" class="btn btn-link">Редактирай поръчката</a>
            </div>
        </div>

        <!-- Customer Information Form -->
        <form action="{{ url('/submit-checkout') }}" method="post">
            @csrf <!-- CSRF token for security -->

            <h2>Информация за клиента</h2>
            <div class="form-group">
                <label for="customerName">Име:</label>
                <input type="text" id="customerName" name="customer_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="customerEmail">Email:</label>
                <input type="email" id="customerEmail" name="customer_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="customerPhone">Телефонен номер:</label>
                <input type="text" id="customerPhone" name="customer_phone" class="form-control">
            </div>

            <h2>Адрес за доставка</h2>
            <div class="form-group">
                <label for="streetAddress">Улица:</label>
                <input type="text" id="streetAddress" name="street_address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">Град:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">Област:</label>
                <input type="text" id="state" name="state" class="form-control">
            </div>
            <div class="form-group">
                <label for="postalCode">Пощенски код:</label>
                <input type="text" id="postalCode" name="postal_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="country">Държава:</label>
                <input type="text" id="country" name="country" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Изпрати поръчката</button>
        </form>
    </div>
@endsection
