@extends('layouts.checkout.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Checkout Completion</h1>

    <form id="payment-form" action="{{ route('checkout.process') }}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <h3>Customer Information</h3>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>

            <div class="col-12">
                <h3 class="mt-4">Shipping Information</h3>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="econt_office">Select Econt Office</label>
                        <select id="econt_office" name="econt_office" class="form-control select2">
                            <option value="">Select an office...</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <h3 class="mt-4">Payment Information</h3>
            </div>
            <div class="col-12">
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>
        </div>

        <button id="submit-button" class="btn btn-primary mt-4" type="submit">Pay</button>
    </form>
</div>

<!-- Include Stripe.js and Bootstrap 5 -->
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    // Initialization for Stripe
    var stripe = Stripe('{{ $stripeKey }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        document.getElementById('submit-button').disabled = true;

        stripe.confirmCardPayment('{{ $clientSecret }}', {
            payment_method: {
                card: cardElement,
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
                    form.submit();
                }
            }
        });
    });

    // Fetch and populate Econt offices
    $(document).ready(function() {
        $('#econt_office').select2();

        // Fetch and populate Econt offices
        fetchEcontOffices();

        function fetchEcontOffices() {
            $.ajax({
                url: '/api/econt/offices',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        var select = $('#econt_office');
                        select.empty().append('<option value="">Select an office...</option>');
                        data.data.forEach(function(office) {
                            select.append(new Option(office.name, office.id));
                        });
                    }
                },
                error: function(error) {
                    console.error('Error fetching Econt offices:', error);
                }
            });
        }
    });
</script>
@endsection
