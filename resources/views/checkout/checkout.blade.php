@extends('layouts.checkout.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Завършване на плащането</h1>

    <form id="payment-form" method="post">
        @csrf
        <!-- Customer Information -->
        <div class="row g-3">
            <div class="col-12"><h3>Информация за клиента</h3></div>
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

        <!-- Payment Method Selection -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="payment_method" class="form-label">Начин на плащане*</label>
                <select id="payment_method" class="form-control">
                    <option value="" disabled selected>Изберете начин на плащане</option>
                    <option value="card">Плащане с карта на самия продук, без доставка</option>
                    <option value="cod">Плащане при доставка с наложен платеж на цялата сума</option>
                </select>
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
                cardElement = elements.create('card');
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

        paymentMethodDropdown.change(function() {
            if (this.value === 'card') {
                $('#payment_info').show();
                initializeStripeElements();
                submitButton.show();
                finalizeButton.hide();
                form.attr('action', '{{ route("checkout.process") }}');
                if ($('#payment_intent_id').length === 0) {
                    form.append('<input type="hidden" id="payment_intent_id" name="payment_intent_id" value="{{ $paymentIntentId }}">');
                }
            } else {
                $('#payment_info').hide();
                destroyStripeElements();
                submitButton.hide();
                finalizeButton.show();
                form.attr('action', '{{ route("checkout.cod") }}');
                $('#payment_intent_id').remove();
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
                        form.off('submit').submit();
                    }
                });
            } else {
                form.off('submit').submit();
            }
        });
    });
</script>

@endpush

