import { parsePrice } from '../utils/utils';


document.addEventListener('DOMContentLoaded', () => {
    // Load cart from local storage or initialize an empty cart
    window.cart = JSON.parse(localStorage.getItem('cart')) || {
        items: [],
        totalItems: 0
    };

    // Update cart badge
    window.updateCartBadge = function() {
        window.cart.totalItems = window.cart.items.reduce((total, item) => total + item.quantity, 0);
        const badge = document.getElementById('cart-badge');
        badge.textContent = window.cart.totalItems;
    };

    // Update cart badge on page load
    window.updateCartBadge();

       // Function to remove an item from the cart
    window.removeItemFromCart = function(index) {
        window.cart.items.splice(index, 1);
        updateCart();
    };

    // Render cart items
    window.renderCartItems = function() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';
        window.cart.items.forEach((item, index) => {
            const priceNumber = parsePrice(item.price);
            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item d-flex justify-content-between align-items-center mb-3';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" style="width: 100px; height: 100px;">
                <span>${item.name}</span>
                <div class="quantity-controls">
                    <button class="quantity-btn decrease" onclick="decreaseQuantity(${index})">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="quantity-btn increase" onclick="increaseQuantity(${index})">+</button>
                    <button class="remove-btn" onclick="removeItemFromCart(${index})">Изтрий</button>
                </div>
                <span>${priceNumber.toFixed(2)} лв.</span>
            `;

            // Insert item at the beginning of the container
            if (cartItemsContainer.children.length > 0) {
                cartItemsContainer.insertBefore(itemElement, cartItemsContainer.children[0]);
            } else {
                cartItemsContainer.appendChild(itemElement);
            }
        });
        updateCartSummary();
    };


    // Function to increase quantity
    window.increaseQuantity = function(index) {
        window.cart.items[index].quantity++;
        updateCart();
    };

    // Function to decrease quantity
    window.decreaseQuantity = function(index) {
        if (window.cart.items[index].quantity > 1) {
            window.cart.items[index].quantity--;
            updateCart();
        }
    };

    // Update the cart (render items and update badge)
    window.updateCart = function() {
        renderCartItems();
        updateCartBadge();
        saveCartToLocalStorage();
    };

    // Update cart summary (subtotal and total price)
    window.updateCartSummary = function() {
        let subtotal = 0;
        window.cart.items.forEach(item => {
            const priceNumber = parsePrice(item.price);
            subtotal += priceNumber * item.quantity;
        });
        document.getElementById('subtotal-price').textContent = `${subtotal.toFixed(2)} лв.`;
        let total = subtotal * 1.10; // Assuming a 10% tax rate
        document.getElementById('total-price').textContent = `${total.toFixed(2)} лв.`;
    };

    // Save cart to local storage
    window.saveCartToLocalStorage = function() {
        localStorage.setItem('cart', JSON.stringify(window.cart));
    };

    // Render cart items if on the cart page
    if (document.getElementById('cart-items')) {
        renderCartItems();
    }
});
