document.addEventListener('DOMContentLoaded', () => {
    // Load cart from local storage or initialize an empty cart
    window.cart = JSON.parse(localStorage.getItem('cart')) || {
        items: [],
        totalItems: 0
    };

    // Function to update the cart badge
    window.updateCartBadge = function() {
        window.cart.totalItems = window.cart.items.reduce((total, item) => total + item.quantity, 0);
        const badge = document.getElementById('cart-badge');
        badge.textContent = window.cart.totalItems;
    };

    // Update cart badge on page load
    window.updateCartBadge();

    // Function to show the modal with product details
    window.showCartModal = function(productName, productPrice, productImage) {
        const modalImage = document.getElementById('modal-product-image');
        const modalTitle = document.getElementById('modal-product-name');
        const priceElement = document.getElementById('modal-product-price');
        const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));

        modalImage.src = productImage;
        modalTitle.textContent = productName;
        priceElement.textContent = `Цена на продукта: ${productPrice}`;
        cartModal.show();
    };

    // Event listener for the add-to-cart buttons
    document.querySelectorAll('.product .icon.add-to-cart').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const productElement = button.closest('.product');
            const productImage = productElement.querySelector('.product-grid').style.backgroundImage.slice(5, -2);
            const productName = productElement.querySelector('.desc h3 a').textContent;
            const productPrice = productElement.querySelector('.desc .price').textContent;
            console.log("Extracted Price:", productPrice); // Check the extracted price


            const existingProductIndex = window.cart.items.findIndex(item => item.name === productName);
            if (existingProductIndex !== -1) {
                window.cart.items[existingProductIndex].quantity++;
            } else {
                const product = {
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                };
                window.cart.items.push(product);
            }

            window.updateCartBadge();
            window.saveCartToLocalStorage();
            window.showCartModal(productName, productPrice, productImage);
        });
    });

    // Function to save cart to local storage
    window.saveCartToLocalStorage = function() {
        localStorage.setItem('cart', JSON.stringify(window.cart));
    };

    // Function to render cart items
    window.renderCartItems = function() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';
        window.cart.items.forEach((item, index) => {
            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item d-flex justify-content-between align-items-center mb-3';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" style="width: 50px; height: auto;">
                <span>${item.name}</span>
                <div class="quantity-controls">
                    <button onclick="decreaseQuantity(${index})">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button onclick="increaseQuantity(${index})">+</button>
                </div>
                <span>${item.price} лв.</span>
            `;
            cartItemsContainer.appendChild(itemElement);
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

    // Function to update the cart (render items and update badge)
    window.updateCart = function() {
        renderCartItems();
        updateCartBadge();
        saveCartToLocalStorage();
    };

    // Function to update cart summary (subtotal and total price)
    window.updateCartSummary = function() {
        let subtotal = 0;
        window.cart.items.forEach(item => {
            subtotal += item.price * item.quantity;
        });
        document.getElementById('subtotal-price').textContent = `${subtotal.toFixed(2)} лв.`;
        let total = subtotal * 1.10; // Assuming a 10% tax rate
        document.getElementById('total-price').textContent = `${total.toFixed(2)} лв.`;
    };

    // Render cart items if on the cart page
    if (document.getElementById('cart-items')) {
        renderCartItems();
    }
});
