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

// Call this function on page load or when the cart is updated
window.renderOrderSummary();


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



//Delivery options
window.setupDeliveryMethodChange = function() {
    var deliveryMethods = document.querySelectorAll('input[type=radio][name=deliveryMethod]');

    deliveryMethods.forEach(function(method) {
        method.addEventListener('change', function() {
            var selectedMethod = this.value;
            var deliveryOptions = document.getElementById('deliveryOptions');
            var addressFields = document.getElementById('addressFields');

            if (selectedMethod === 'speedyOffice') {
                deliveryOptions.style.display = 'block';
                addressFields.style.display = 'none';
                deliveryOptions.setAttribute('placeholder', 'Изберете офис на Спиди');
            } else if (selectedMethod === 'ekontOffice') {
                deliveryOptions.style.display = 'block';
                addressFields.style.display = 'none';
                deliveryOptions.setAttribute('placeholder', 'Изберете офис на Еконт');
            } else if (selectedMethod === 'addressDelivery') {
                deliveryOptions.style.display = 'none';
                addressFields.style.display = 'block';
            }
        });
    });
};


document.addEventListener('DOMContentLoaded', function() {
    window.setupDeliveryMethodChange();
});
