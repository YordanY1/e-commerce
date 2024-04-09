// import { parsePrice } from '../utils/utils';


// document.addEventListener('DOMContentLoaded', () => {
//     // Load cart from local storage or initialize an empty cart
//     window.cart = JSON.parse(localStorage.getItem('cart')) || {
//         items: [],
//         totalItems: 0
//     };

//     // Update cart badge
//     window.updateCartBadge = function() {
//         window.cart.totalItems = window.cart.items.reduce((total, item) => total + item.quantity, 0);
//         const badge = document.getElementById('cart-badge');
//         badge.textContent = window.cart.totalItems;
//     };

//     // Update cart badge on page load
//     window.updateCartBadge();

//        // Function to remove an item from the cart
//     window.removeItemFromCart = function(index) {
//         window.cart.items.splice(index, 1);
//         updateCart();
//     };

//     // Render cart items
//     window.renderCartItems = function() {
//         const cartItemsContainer = document.getElementById('cart-items');
//         cartItemsContainer.innerHTML = '';
//         window.cart.items.forEach((item, index) => {
//             const priceNumber = parsePrice(item.price);
//             const itemElement = document.createElement('div');
//             itemElement.className = 'card mb-3 cart-item';
//             itemElement.innerHTML = `
//                 <div class="row g-0">
//                     <div class="col-md-3 d-flex align-items-center justify-content-center">
//                         <img src="${item.image}" alt="${item.name}" class="img-fluid rounded-start">
//                     </div>
//                     <div class="col-md-5 d-flex align-items-center justify-content-center">
//                         <div>
//                             <h5 class="card-title">${item.name}</h5>
//                             <div class="quantity-controls">
//                                 <button class="btn btn-outline-primary me-2" onclick="decreaseQuantity(${index})">-</button>
//                                 <span class="quantity">${item.quantity}</span>
//                                 <button class="btn btn-outline-primary ms-2" onclick="increaseQuantity(${index})">+</button>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col-md-3 d-flex flex-column justify-content-between">
//                         <div class="card-body text-end">
//                             <p class="card-text price">${priceNumber.toFixed(2)} лв.</p>
//                             <button class="btn btn-danger btn-sm" onclick="removeItemFromCart(${index})">Премахни</button>
//                         </div>
//                     </div>
//                 </div>
//             `;
//             cartItemsContainer.appendChild(itemElement);
//         });
//         updateCartSummary();
//     };



//     // Function to increase quantity
//     window.increaseQuantity = function(index) {
//         window.cart.items[index].quantity++;
//         updateCart();
//     };

//     // Function to decrease quantity
//     window.decreaseQuantity = function(index) {
//         if (window.cart.items[index].quantity > 1) {
//             window.cart.items[index].quantity--;
//             updateCart();
//         }
//     };

//     // Update the cart (render items and update badge)
//     window.updateCart = function() {
//         renderCartItems();
//         updateCartBadge();
//         saveCartToLocalStorage();
//     };

//     // Update cart summary (subtotal and total price)
//     window.updateCartSummary = function() {
//         let subtotal = 0;
//         window.cart.items.forEach(item => {
//             const priceNumber = parsePrice(item.price);
//             subtotal += priceNumber * item.quantity;
//         });
//         document.getElementById('subtotal-price').textContent = `${subtotal.toFixed(2)} лв.`;
//         let total = subtotal * 1.10; // Assuming a 10% tax rate
//         document.getElementById('total-price').textContent = `${total.toFixed(2)} лв.`;
//     };

//     // Save cart to local storage
//     window.saveCartToLocalStorage = function() {
//         localStorage.setItem('cart', JSON.stringify(window.cart));
//     };

//     // Render cart items if on the cart page
//     if (document.getElementById('cart-items')) {
//         renderCartItems();
//     }
// });
