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

    <!-- Accordion for Checkout Options -->
    <form action="{{ url('/submit-checkout') }}" method="post" class="checkout-form">
        @csrf <!-- CSRF token for security -->

        <div class="accordion" id="checkoutAccordion">

            <!-- Customer Information and Shipping Address -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Адрес за доставка
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <!-- Customer Information Form -->
                        <h3>Информация за клиента</h3>
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

                        <h3>Адрес за доставка</h3>
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
                    </div>
                </div>
            </div>

            <!-- Delivery Options (Еконт/Спиди) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Избери офис (Еконт/Спиди)
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <div class="form-group">
                            <label><input type="radio" name="shipping_option" value="ekont_office" required> Лично взимане от офис на Еконт</label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="shipping_option" value="ekont_address"> Доставка до Адрес (Еконт)</label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="shipping_option" value="speedy_office"> Лично взимане от офис на Спиди</label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="shipping_option" value="speedy_address"> Доставка до Адрес (Спиди)</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pickup from Store -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Лично взимане от магазина
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <label><input type="radio" name="shipping_option" value="store_pickup"> Лично взимане от магазина</label>
                    </div>
                </div>
            </div>

            <!-- Billing Address -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Адрес за фактуриране
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <div class="billing-address-option">
                            <label>
                                <input type="radio" name="billing_address_option" value="same_as_shipping" checked onclick="toggleBillingAddress(false)">
                                Същият като адреса на доставка
                            </label>
                        </div>
                        <div class="billing-address-option">
                            <label>
                                <input type="radio" name="billing_address_option" value="different_address" onclick="toggleBillingAddress(true)">
                                Друг адрес
                            </label>
                        </div>

                        <div id="differentBillingAddress" style="display: none;">
                            <!-- Billing Address Form Fields -->
                            <h3>Друг адрес за фактуриране</h3>
                            <div class="form-group">
                                <label for="billingStreetAddress">Улица:</label>
                                <input type="text" id="billingStreetAddress" name="billing_street_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="billingCity">Град:</label>
                                <input type="text" id="billingCity" name="billing_city" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="billingState">Област:</label>
                                <input type="text" id="billingState" name="billing_state" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="billingPostalCode">Пощенски код:</label>
                                <input type="text" id="billingPostalCode" name="billing_postal_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="billingCountry">Държава:</label>
                                <input type="text" id="billingCountry" name="billing_country" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Информация за плащане
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <div class="payment-options">
                            <button type="button" class="btn payment-option-btn" data-value="mastercard">
                                <i class="fab fa-cc-mastercard"></i> MasterCard
                            </button>
                            <button type="button" class="btn payment-option-btn" data-value="visa">
                                <i class="fab fa-cc-visa"></i> Visa
                            </button>
                            <button type="button" class="btn payment-option-btn" data-value="cash_on_delivery">
                                <i class="fas fa-money-bill-wave"></i> Наложен платеж
                            </button>

                            <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="">
                        </div>

                    </div>
                </div>
            </div>
             <!-- Order Review Section -->
                {{-- <div class="order-review">
                    <h2>Преглед на поръчката</h2>
                    <div class="order-items">
                        @foreach($orderItems as $item)
                        <div class="order-item">
                            <span>{{ $item->name }}</span>
                            <span>{{ $item->quantity }} x {{ $item->price }} лв.</span>
                            <span>Общо: {{ $item->quantity * $item->price }} лв.</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="order-totals">
                        <div class="subtotal">
                            <span>Всички продукти:</span>
                            <span id="subtotal-price">{{ $subtotal }} лв.</span>
                        </div>
                        <div class="shipping">
                            <span>Доставка:</span>
                            <span id="shipping-price">{{ $shippingCost }} лв.</span>
                        </div>
                        <div class="taxes">
                            <span>Данъци:</span>
                            <span id="taxes-price">{{ $taxes }} лв.</span>
                        </div>
                        <div class="total">
                            <span>Общо с данъци:</span>
                            <span id="total-price">{{ $totalPrice }} лв.</span>
                        </div>
                    </div>
                </div> --}}
                      <!-- Space between Terms Agreement and Checkout Button -->
                      <div class="checkout-button-spacing"></div>
                   <!-- Privacy Policy and Terms of Service Agreement -->
                <div class="terms-agreement">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="termsAgreement" name="terms_agreement" required>
                        <label class="form-check-label" for="termsAgreement">
                            Съгласен съм с <a href="{{ url('/privacy-policy') }}">Политиката за поверителност</a> и <a href="{{ url('/terms-of-service') }}">Условията за ползване</a>.
                        </label>
                    </div>
                </div>

                <!-- Space between Terms Agreement and Checkout Button -->
                <div class="checkout-button-spacing"></div>
        </div>
        <!-- Checkout Button -->
        <div class="checkout-submit-button">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Финализирай поръчката</button>
        </div>
    </form>
</div>
@endsection
