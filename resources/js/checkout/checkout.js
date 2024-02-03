import { parsePrice } from '../utils/utils';

window.renderOrderSummary = function() {
    // Retrieve and parse the cart data from localStorage
    const storedCart = localStorage.getItem('cart');
    const cart = storedCart ? JSON.parse(storedCart) : { items: [], total: 0 };

    const orderItemsContainer = document.getElementById('order-items');
    orderItemsContainer.innerHTML = '';

    // Check if there are items in the cart
    if (cart.items.length > 0) {
        let subtotal = 0;

        cart.items.forEach((item) => {
            const priceNumber = parsePrice(item.price);
            subtotal += priceNumber;

            const itemElement = document.createElement('div');
            itemElement.className = 'order-item';
            itemElement.innerHTML = `
                <div class="row mb-3">
                    <div class="col">
                        <img src="${item.image}" alt="${item.name}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                    </div>
                    <div class="col">
                        <span>${item.name}</span>
                    </div>
                    <div class="col text-end">
                        <span>${priceNumber.toFixed(2)} лв.</span>
                    </div>
                </div>
            `;
            orderItemsContainer.appendChild(itemElement);
        });

        // Subtotal row
        const subtotalRow = document.createElement('div');
        subtotalRow.className = 'row';
        subtotalRow.innerHTML = `
            <div class="col">
                <strong>Общо</strong>
            </div>
            <div class="col text-end">
                <strong>${subtotal.toFixed(2)} лв.</strong>
            </div>
        `;
        orderItemsContainer.appendChild(subtotalRow);

        // Delivery row - hardcoded for now
        const deliveryCost = 7.49;
        const deliveryRow = document.createElement('div');
        deliveryRow.className = 'row';
        deliveryRow.innerHTML = `
            <div class="col">
                Доставка
            </div>
            <div class="col text-end">
                ${deliveryCost.toFixed(2)} лв.
            </div>
        `;
        orderItemsContainer.appendChild(deliveryRow);

        // Total row
        const total = subtotal + deliveryCost;
        const totalRow = document.createElement('div');
        totalRow.className = 'row';
        totalRow.innerHTML = `
            <div class="col">
                <strong>Общо</strong>
            </div>
            <div class="col text-end">
                <strong>${total.toFixed(2)} лв.</strong>
            </div>
        `;
        orderItemsContainer.appendChild(totalRow);

    } else {
        orderItemsContainer.innerHTML = '<p>Вашата кошница е празна.</p>';
    }
};


document.addEventListener('DOMContentLoaded', function() {
    window.renderOrderSummary();
});

//Checkout Buttons
window.toggleBillingAddress = function toggleBillingAddress(show) {
    const billingAddressDiv = document.getElementById('differentBillingAddress');
    billingAddressDiv.style.display = show ? 'block' : 'none';
}

//Payments
    document.addEventListener('DOMContentLoaded', function () {
    const paymentButtons = document.querySelectorAll('.payment-option-btn');
    const paymentInput = document.getElementById('selectedPaymentMethod');

        paymentButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                paymentButtons.forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
                paymentInput.value = this.getAttribute('data-value');
            });
        });
    });

window.setupDeliveryMethodChange = function() {
    const deliveryMethods = document.querySelectorAll('input[type=radio][name=deliveryMethod]');
    const deliveryOptionsSelect = document.getElementById('deliveryOptions');
    const addressFieldsDiv = document.getElementById('addressFields');

    deliveryMethods.forEach(function(method) {
        method.addEventListener('change', function() {
            const selectedMethod = this.value;

            if (selectedMethod === 'speedyOffice') {

                addressFieldsDiv.style.display = 'none';
                // TODO: Fetch and append Speedy offices here
                // fetchSpeedyOffices(); // You will define this function
            } else if (selectedMethod === 'ekontOffice') {

                addressFieldsDiv.style.display = 'none';
                fetchEcontOffices();
            } else if (selectedMethod === 'addressDelivery') {
                deliveryOptionsSelect.style.display = 'none';
                addressFieldsDiv.style.display = 'block';
            }
        });
    });
};

// Econt offices fetch function
function fetchEcontOffices() {
    fetch('/api/fetchOffices')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('deliveryOptions');

            // Destroy any existing Select2 instance
            if ($.fn.select2 && $(select).data('select2')) {
                $(select).select2('destroy');
            }

            // Clear the select options
            select.innerHTML = '';

            // Populate the select options with the fetched data
            data.offices.filter(office => office.address.city.country.code2 === 'BG')
                .forEach(office => {
                    const option = document.createElement('option');
                    option.value = office.id;
                    option.text = `${office.name} ${office.address.fullAddress}`;
                    select.appendChild(option);
                });

            // Initialize Select2 with Bootstrap 5 theme and placeholder
            $(select).select2({
                theme: "bootstrap-5",
                placeholder: 'Изберете доставка'
            });

            // Re-apply the change event listener
            select.onchange = function() {
                document.getElementById('selectedOfficeId').value = this.value;
            };
        })
        .catch(error => console.error('Problem fetching Econt offices:', error));
}

// Event listener setup call
    document.addEventListener('DOMContentLoaded', function() {
        window.setupDeliveryMethodChange();
    });


//Payments radio buttons
document.addEventListener('DOMContentLoaded', function() {
    var paymentOnDeliveryCheckbox = document.getElementById('paymentOnDelivery');
    var cardPaymentCheckbox = document.getElementById('cardPayment');
    var paymentOnDeliveryInfo = document.getElementById('paymentOnDeliveryInfo');
    var cardPaymentForm = document.getElementById('cardPaymentForm');

    paymentOnDeliveryCheckbox.addEventListener('change', function() {
        if (this.checked) {
            paymentOnDeliveryInfo.style.display = 'block';
            cardPaymentCheckbox.checked = false;
            cardPaymentForm.style.display = 'none';
        } else {
            paymentOnDeliveryInfo.style.display = 'none';
        }
    });

    cardPaymentCheckbox.addEventListener('change', function() {
        if (this.checked) {
            cardPaymentForm.style.display = 'block';
            paymentOnDeliveryCheckbox.checked = false;
            paymentOnDeliveryInfo.style.display = 'none';
        } else {
            cardPaymentForm.style.display = 'none';
        }
    });
});


//Stripe elements

// Create a Stripe client.
var stripe = Stripe('pk_test_your_publishable_key_here');

// Create an instance of Elements.
var elements = stripe.elements();

// Define custom style for the Elements
var style = {
    base: {
        iconColor: '#666EE8',
        color: '#31325F',
        lineHeight: '40px',
        fontWeight: 300,
        fontFamily: 'Helvetica Neue',
        fontSize: '15px',

        '::placeholder': {
            color: '#CFD7E0',
        },
    },
};

// Create individual Elements
var cardNumber = elements.create('cardNumber', { style: style });
cardNumber.mount('#card-number-element');

var cardExpiry = elements.create('cardExpiry', { style: style });
cardExpiry.mount('#card-expiry-element');

var cardCvc = elements.create('cardCvc', { style: style });
cardCvc.mount('#card-cvc-element');

