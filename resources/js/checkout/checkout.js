import { parsePrice } from '../utils/utils';

window.renderOrderSummary = function() {
    // Retrieve and parse the cart data from localStorage
    const storedCart = localStorage.getItem('cart');
    const cart = storedCart ? JSON.parse(storedCart) : { items: [], totalItems: 0 };

    const orderItemsContainer = document.getElementById('order-items');
    orderItemsContainer.innerHTML = '';

    // Check if there are items in the cart
    if (cart.items.length > 0) {
        cart.items.forEach((item) => {
            const priceNumber = parsePrice(item.price);
            const itemElement = document.createElement('div');
            itemElement.className = 'order-item';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" style="width: 100px; height: 100px;">
                <span>${item.name}</span>
                <span>Price: ${priceNumber.toFixed(2)} лв.</span>
            `;
            orderItemsContainer.appendChild(itemElement);
        });
    } else {
        orderItemsContainer.innerHTML = '<p>Вашата кошница е празна.</p>';
    }
};

// Call this function on page load or when the cart is updated
window.renderOrderSummary();
