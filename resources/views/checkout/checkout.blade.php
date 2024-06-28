@extends('layouts.checkout.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Завършване на плащането</h1>

    <form id="payment-form" method="post">
        @csrf
        <!-- Customer Information -->
        <div class="row g-3">
            <div class="col-12"><h3>Вашите данни</h3></div>
            <div class="col-md-6">
                <label for="email" class="form-label">Имейл*</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="first_name" class="form-label">Име*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Фамилия*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Телефонен номер*</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="city" class="form-label">Град/Село*</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="postcode" class="form-label">Пощенски код*</label>
                    <input type="text" id="postcode" name="postcode" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="street" class="form-label">Улица*</label>
                    <input type="text" id="street" name="street" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Invoice Request Checkbox -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="invoiceRequest" name="invoiceRequest">
                    <label class="form-check-label" for="invoiceRequest">Желая фактура</label>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div id="invoiceDetails" class="row g-3" style="display: none;">
            <div class="col-md-6">
                <label for="companyName" class="form-label">Име на фирмата</label>
                <input type="text" id="companyName" name="companyName" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="companyID" class="form-label">ЕИК/Булстат</label>
                <input type="text" id="companyID" name="companyID" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="companyAddress" class="form-label">Адрес на фирмата</label>
                <input type="text" id="companyAddress" name="companyAddress" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="companyTaxNumber" class="form-label">ДДС Номер</label>
                <input type="text" id="companyTaxNumber" name="companyTaxNumber" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="companyMol" class="form-label">МОЛ</label>
                <input type="text" id="companyMol" name="companyMol" class="form-control">
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-12">
            <div class="card cart-summary-card">
                <div class="card-header">
                    <h3>Обобщение на поръчката</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush" id="cart-items">
                        <!-- Cart items will be populated here by JavaScript -->
                    </ul>
                    <div class="mt-4 left-align">
                        <strong>Общо: <span id="grand-total"></span></strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method Selection -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="payment_method" class="form-label"><h3 class="mb-3 mt-3">Начин на плащане</h3></label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="" disabled selected>Изберете начин на плащане</option>
                    <option value="card">Плащане с карта</option>
                    <option value="cod">Плащане при доставка с наложен платеж</option>
                </select>
                <!-- Hidden message about card payments -->
                <div id="card-payment-message" class="text-danger mt-2" style="display: none; color: red;">
                    ВАЖНО: При заплащане с карта, Вие заплащате само стойността на поръчката без разходите за доставка. Разходите за доставка ще бъдат начислени допълнително и ще трябва да ги заплатите на куриера при получаване на пратката.
                </div>
                <!-- Hidden message about COD payments -->
                <div id="cod-payment-message" class="text-danger mt-2" style="display: none; color: red;">
                    ВАЖНО: При заплащане при доставка с наложен платеж, Вие заплащате както стойността на поръчката, така и разходите за доставка директно на куриера при получаване на пратката.
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div id="payment_info" class="row g-3" style="display: none;">
            <div class="col-12"><h3>Въведете вашата карта</h3></div>
            <div class="col-12">
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>
        </div>

        <div class="text-left mt-4">
            <p>Вашите лични данни ще бъдат използвани за обработка на Вашата поръчка. <a href="{{ route('terms.index') }}">Защита на лични данни.</a></p>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="termsAgreement" required>
                <label class="form-check-label" for="termsAgreement">
                    Прочетох и се съгласявам с <a href="{{ route('terms.index') }}">правилата и условията на сайта</a>*
                </label>
            </div>
        </div>

        <button id="submit-button" class="btn btn-primary mt-4" type="submit" style="display: none;">Финализирай поръчката</button>
        <button id="finalize-button" class="btn btn-primary mt-4" type="submit" style="display: none;">Финализирай поръчката</button>

    </form>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        const stripe = Stripe('{{ $stripeKey }}');
        let elements;
        let cardElement;

        const form = $('#payment-form');
        const submitButton = $('#submit-button');
        const finalizeButton = $('#finalize-button');
        const cardErrors = $('#card-errors');
        const paymentMethodDropdown = $('#payment_method');

        function initializeStripeElements() {
            if (!elements) {
                elements = stripe.elements();
                cardElement = elements.create('card', {
                    style: {
                        base: {
                            iconColor: '#666EE8',
                            color: '#31325F',
                            fontWeight: '300',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSize: '18px',
                            '::placeholder': {
                                color: '#CFD7E0',
                            },
                        },
                    },
                    hidePostalCode: true  // This option hides the postal code field
                });
                cardElement.mount('#card-element');
            }
        }

        function destroyStripeElements() {
            if (cardElement) {
                cardElement.unmount();
                cardElement = null;
                elements = null;
            }
        }

        // Toggle Invoice Details
        $('#invoiceRequest').change(function() {
            if ($(this).is(':checked')) {
                $('#invoiceDetails').show();
            } else {
                $('#invoiceDetails').hide();
            }
        });

        paymentMethodDropdown.change(function() {
            if (this.value === 'card') {
                $('#payment_info').show();
                $('#card-payment-message').show();
                $('#cod-payment-message').hide();
                initializeStripeElements();
                submitButton.show();
                finalizeButton.hide();
                form.attr('action', '{{ route("checkout.process") }}');
                if ($('#payment_intent_id').length === 0) {
                    form.append('<input type="hidden" id="payment_intent_id" name="payment_intent_id" value="{{ $paymentIntentId }}">');
                }
            } else if (this.value === 'cod') {
                $('#payment_info').hide();
                $('#card-payment-message').hide();
                $('#cod-payment-message').show();
                destroyStripeElements();
                submitButton.hide();
                finalizeButton.show();
                form.attr('action', '{{ route("checkout.cod") }}');
                $('#payment_intent_id').remove();
            } else {
                $('#card-payment-message').hide();
                $('#cod-payment-message').hide();
                $('#payment_info').hide();
                submitButton.hide();
                finalizeButton.hide();
            }
        }).trigger('change');

        form.on('submit', function(event) {
            event.preventDefault();
            const paymentMethod = paymentMethodDropdown.val();

            if (paymentMethod === 'card') {
                submitButton.prop('disabled', true);
                cardErrors.text('');
                stripe.confirmCardPayment('{{ $clientSecret }}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            email: $('#email').val(),
                            name: $('#first_name').val() + ' ' + $('#last_name').val(),
                            phone: $('#phone').val(),
                        },
                    }
                }).then(function(result) {
                    if (result.error) {
                        cardErrors.text(result.error.message);
                        submitButton.prop('disabled', false);
                    } else if (result.paymentIntent.status === 'succeeded') {
                        form.append('<input type="hidden" name="payment_method" value="card">'); // Ensure hidden input
                        form.off('submit').submit(); // Submit form after adding hidden input
                    }
                });
            } else {
                form.append('<input type="hidden" name="payment_method" value="cod">'); // Add hidden input for cod
                form.off('submit').submit();
            }
        });

        function loadCart() {
            let cart = JSON.parse(localStorage.getItem('cart'));
            if (!cart) return;
            let itemsHtml = '';
            let subtotal = 0;
            $.each(cart.products, function(index, product) {
                let price = parseFloat(product.price); // Преобразуване на цената до число
                if (isNaN(price)) {
                    console.error(`Invalid price for product: ${product.name}`);
                    return; // Прескачане на продукта, ако цената не е валидна
                }
                let totalProductPrice = price * product.quantity; // Обща цена за количеството
                subtotal += totalProductPrice; // Натрупване на междинна сума за всички продукти
                itemsHtml += `<li class="list-group-item cart-item">
                    <img src="${product.image}" alt="${product.name}" class="img-fluid product-image" style="width: 150px; height: auto;">
                    <div class="product-details">
                        <h5 class="product-name mb-1">${product.name}</h5>
                        <span class="product-price badge bg-primary rounded-pill fs-6">${product.quantity} x ${price.toFixed(2)}лв.</span>
                    </div>
                </li>`;
            });

            $('#cart-items').html(itemsHtml);
            $('#grand-total').text(`${subtotal.toFixed(2)} лв.`); // Обновяване на общата сума
        }

        loadCart();
    });
</script>
@endpush
