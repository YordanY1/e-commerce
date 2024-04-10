@extends('layouts.checkout.layout')

@section('content')
<div class="container">
    <h1>Завършване на поръчката</h1>

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

                   <!-- Customer Details Form -->
                        <div class="row">
                            <!-- First Name Input -->
                            <div class="col-md-6 form-group">
                                <input type="text" id="customerFirstName" name="customer_first_name" class="form-control" placeholder="Име" required>
                            </div>

                            <!-- Last Name Input -->
                            <div class="col-md-6 form-group">
                                <input type="text" id="customerLastName" name="customer_last_name" class="form-control" placeholder="Фамилия" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email Input -->
                            <div class="col-md-12 form-group">
                                <input type="email" id="customerEmail" name="customer_email" class="form-control" placeholder="Имейл" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Phone Number Input -->
                            <div class="col-md-12 form-group">
                                <input type="text" id="customerPhone" name="customer_phone" class="form-control"  placeholder="Телефонен номер" required>
                            </div>
                        </div>

                        <!-- Delivery Options -->
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4 class="my-2">АДРЕС ЗА ДОСТАВКА</h4>
                                <p class="text-muted">(до офис на Спиди / Еконт или до Адрес)</p>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-4">Метод на доставка</h5>

                                <form id="deliveryForm">
                                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                                        <div>
                                            <input type="radio" class="form-check-input" id="speedyOffice" name="deliveryMethod" value="speedyOffice">
                                            <label for="speedyOffice" class="form-check-label">до офис Спиди</label>
                                        </div>
                                        <span class="fw-bold">4.99лв.</span>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                                        <div>
                                            <input type="radio" class="form-check-input" id="ekontOffice" name="deliveryMethod" value="ekontOffice">
                                            <label for="ekontOffice" class="form-check-label">до офис Еконт</label>
                                        </div>
                                        <span class="fw-bold">6.29лв.</span>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" class="form-check-input" id="addressDelivery" name="deliveryMethod" value="addressDelivery">
                                            <label for="addressDelivery" class="form-check-label">до Адрес</label>
                                        </div>
                                        <span class="fw-bold">7.49лв.</span>
                                    </div>

                                    <div class="mb-3">
                                        <select class="d-none" id="deliveryOptions">
                                            <!-- Options will be dynamically added here -->
                                        </select>
                                        <input type="hidden" id="selectedOfficeId" name="selected_office_id">
                                    </div>

                                    <div id="addressFields" style="display: none;">
                                        <!-- Row 1: City and Region -->
                                        <div class="row mb-3">
                                            <!-- City -->
                                            <div class="col-sm">
                                                <input type="text" class="form-control" id="city" placeholder="Град/Село" required>
                                            </div>

                                            <!-- Region -->
                                            <div class="col-sm">
                                                <input type="text" class="form-control" id="region" placeholder="Област" required>
                                            </div>
                                        </div>

                                        <!-- Row 2: District and Address -->
                                        <div class="row mb-3">
                                            <!-- District -->
                                            <div class="col-sm">
                                                <input type="text" class="form-control" id="district" placeholder="Квартал">
                                            </div>

                                            <!-- Address -->
                                            <div class="col-sm">
                                                <input type="text" class="form-control" id="address" placeholder="Адрес на доставка" required>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>

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


                <!-- Order Summary -->
                <div class="order-summary">
                    <h2>ВАШАТА ПОРЪЧКА </h2>
                    <div id="order-items">
                        {{-- Dynamically inserted order items will go here --}}
                    </div>
                    <div class="edit-cart">
                        <a href="{{ url('/cart') }}" class="btn btn-link">Редактирай поръчката</a>
                    </div>
                </div>

            <!-- Payment Information -->
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="my-2">Информация за плащане</h4>
                </div>
                <div class="card-body">
                    <!-- Payment on Delivery Option -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="paymentOnDelivery" name="paymentMethod" value="cash_on_delivery">
                        <label class="form-check-label" for="paymentOnDelivery">Плащане на куриер с Наложен Платеж</label>
                        <div id="paymentOnDeliveryInfo" style="display: none;">
                            <p class="text-muted">Дължимата сума се заплаща при получаване на поръчката.</p>
                        </div>
                    </div>

                    <!-- Payment with Card Option -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="cardPayment" name="paymentMethod" value="card">
                        <label class="form-check-label" for="cardPayment">Плащане с карта</label>
                        <div id="cardPaymentForm" style="display: none;">
                            <form id="stripePaymentForm" method="POST" action="/path-to-your-server-endpoint">
                                <!-- Card Number Element with Label -->
                                <div class="mb-3">
                                    <label for="card-number-element">Card Number *</label>
                                    <div id="card-number-element" class="form-control StripeElement StripeElement--empty"></div>
                                </div>

                                <!-- Expiry Date and CVC Elements on the same row -->
                                <div class="expiry-cvc-row">
                                    <div class="mb-3 expiry-element">
                                        <label for="card-expiry-element">Expiry Date *</label>
                                        <div id="card-expiry-element" class="form-control StripeElement StripeElement--empty"></div>
                                    </div>
                                    <div class="mb-3 cvc-element">
                                        <label for="card-cvc-element">Card Code (CVC) *</label>
                                        <div id="card-cvc-element" class="form-control StripeElement StripeElement--empty"></div>
                                    </div>
                                </div>

                                <div id="card-errors" role="alert"></div>
                            </form>
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

