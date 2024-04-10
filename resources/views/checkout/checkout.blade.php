@extends('layouts.checkout.layout')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <form id="payment-form" action="{{ route('checkout.process') }}" method="post">
        @csrf
        <input type="hidden" name="payment_intent_id" value="{{ $paymentIntentId }}">

        {{-- Additional user information fields --}}
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required class="form-control">
        </div>

        <div id="card-element"><!--Stripe.js injects the Card Element--></div>
        <div id="card-errors" role="alert"></div>
        <button id="submit-button" class="btn btn-primary mt-4">Pay</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ $stripeKey }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('submit-button').disabled = true;


        stripe.confirmCardPayment('{{ $clientSecret }}', {
            payment_method: {
                card: cardElement,
                // Include billing details if necessary for Stripe
                billing_details: {
                    email: document.getElementById('email').value,
                    name: document.getElementById('first_name').value + ' ' + document.getElementById('last_name').value,
                    phone: document.getElementById('phone').value,
                },
            }
        }).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('submit-button').disabled = false;
            } else {
                if (result.paymentIntent.status === 'succeeded') {
                    // Here, you could also pass customer details to your server via hidden inputs
                    form.submit();
                }
            }
        });
    });
</script>

@endsection
