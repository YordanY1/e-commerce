@extends('layouts.checkout.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Checkout Completion</h1>

    <form id="payment-form" action="{{ route('checkout.process') }}" method="post">
        <input type="hidden" name="payment_intent_id" value="{{ $paymentIntentId }}">
        @csrf
        <!-- Customer Information -->
        <div class="row g-3">
            <div class="col-12"><h3>Customer Information</h3></div>
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
        </div>

        <!-- Delivery Address and Method -->
        <div class="row g-3 mt-4">
            <div class="col-12"><h3>Delivery Address and Method</h3></div>
            <div class="col-md-12">
                <label for="delivery_method" class="form-label">Метод на доставка</label>
                <select id="delivery_method" name="delivery_method" class="form-control">
                    <option value="">Изберете метод</option>
                    <option value="speedy_office">До офис на Спиди</option>
                    <option value="econt_office">До офис на Еконт</option>
                    <option value="address">До адрес</option>
                </select>
            </div>
            <!-- Conditional Fields for 'до адрес' -->
            <div id="address_fields" style="display: none;" class="col-12">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="city" class="form-label">Град/Село*</label>
                        <input type="text" id="city" name="city" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="postcode" class="form-label">Postcode*</label>
                        <input type="text" id="postcode" name="postcode" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="street" class="form-label">Street*</label>
                        <input type="text" id="street" name="street" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label for="additional_info" class="form-label">Допълнителна информация (блок/вход)</label>
                        <input type="text" id="additional_info" name="additional_info" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="col-12"><h3 class="mt-4">Payment Information</h3></div>
        <div class="col-12">
            <div id="card-element" class="form-control"></div>
            <div id="card-errors" class="text-danger mt-2"></div>
        </div>

        <button id="submit-button" class="btn btn-primary mt-4" type="submit">Pay</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        var stripe = Stripe('{{ $stripeKey }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        $('#delivery_method').change(function() {
            var method = $(this).val();
            if (method === 'address') {
                $('#address_fields').show();
            } else {
                $('#address_fields').hide();
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('submit-button').disabled = true;

            // Extract street name and number
            var fullStreet = $('#street').val();
            var streetNumber = fullStreet.match(/\d+$/) ? fullStreet.match(/\d+$/)[0] : '';
            var streetName = fullStreet.replace(streetNumber, '').trim();

            // Ensure cartData is properly initialized
            var cartData = JSON.parse(localStorage.getItem('cart'));
            if (!cartData || !cartData.products) {
                cartData = { products: {}, total: 0 };
            }

            var description = '';
            var totalWeight = 0;
            var packCount = 0;

            Object.values(cartData.products).forEach(item => {
                description += item.description + "; ";
                totalWeight += parseInt(item.weight);
                packCount += parseInt(item.quantity);
            });

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
                } else if (result.paymentIntent.status === 'succeeded') {
                    form.submit();
                    // $.ajax({
                    //     url: '{{ route("econt.labels.create") }}',
                    //     type: 'POST',
                    //     data: {
                    //         _token: '{{ csrf_token() }}',
                    //         first_name: $('#first_name').val(),
                    //         last_name: $('#last_name').val(),
                    //         phone: $('#phone').val(),
                    //         email: $('#email').val(),
                    //         delivery_method: $('#delivery_method').val(),
                    //         city: $('#city').val(),
                    //         postcode: $('#postcode').val(),
                    //         street: streetName,
                    //         num: streetNumber,
                    //         // additional_info: $('#additional_info').val(),
                    //         // description: description,
                    //         // weight: totalWeight,
                    //         // packCount: packCount
                    //     },
                    //     success: function() {
                    //         window.location.href = '/success';
                    //     },
                    //     error: function(xhr, status, error) {
                    //         console.error('Failed to create Econt label:', error);
                    //     }
                    // });
                }
            });
        });
    });
</script>

@endpush

