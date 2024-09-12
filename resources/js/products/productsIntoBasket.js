// document.addEventListener('DOMContentLoaded', () => {
//     // Load cart from local storage or initialize an empty cart
//     window.cart = JSON.parse(localStorage.getItem('cart')) || {
//         items: [],
//         totalItems: 0
//     };

//     // Update the cart badge to reflect the current state
//     window.updateCartBadge = function() {
//         window.cart.totalItems = window.cart.items.reduce((total, item) => total + item.quantity, 0);
//         const badge = document.getElementById('cart-badge');
//         badge.textContent = window.cart.totalItems;
//     };

//     // Call this function to update the badge on page load
//     window.updateCartBadge();

//     // Function to show a confirmation modal when a product is added to the cart
//     window.showCartModal = function(productName, productPrice, productImage) {
//         const modalImage = document.getElementById('modal-product-image');
//         const modalTitle = document.getElementById('modal-product-name');
//         const priceElement = document.getElementById('modal-product-price');
//         const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));

//         modalImage.src = productImage;
//         modalTitle.textContent = productName;
//         priceElement.textContent = `Цена на продукта: ${productPrice}`;
//         cartModal.show();
//     };

//     // Event listener for the add-to-cart buttons
//     document.querySelectorAll('.product .icon.add-to-cart').forEach(button => {
//         button.addEventListener('click', (e) => {
//             e.preventDefault();
//             const productElement = button.closest('.product');
//             const productImage = productElement.querySelector('.product-grid').style.backgroundImage.slice(5, -2);
//             const productName = productElement.querySelector('.desc h3 a').textContent;
//             const productPrice = productElement.querySelector('.desc .price').textContent;


//             // Check if the product already exists in the cart
//             const existingProductIndex = window.cart.items.findIndex(item => item.name === productName);
//             if (existingProductIndex !== -1) {
//                 window.cart.items[existingProductIndex].quantity++;
//             } else {
//                 const product = {
//                     name: productName,
//                     price: productPrice,
//                     image: productImage,
//                     quantity: 1
//                 };
//                 window.cart.items.push(product);
//             }

//             window.updateCartBadge();
//             window.saveCartToLocalStorage(); // Save the cart state to local storage
//             window.showCartModal(productName, productPrice, productImage); // Show the modal
//         });
//     });

//     // Function to save the cart state to local storage
//     window.saveCartToLocalStorage = function() {
//         localStorage.setItem('cart', JSON.stringify(window.cart));
//     };
// });
