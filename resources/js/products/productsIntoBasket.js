
document.addEventListener('DOMContentLoaded', (event) => {
    // Global cart object
    window.cart = {
        items: [],
        totalItems: 0
    };


    // Function to update the cart badge
    window.updateCartBadge = function() {
        const badge = document.getElementById('cart-badge');
        badge.textContent = window.cart.totalItems;
    };

    // Function to update and show the modal
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
            const productImage = productElement.querySelector('.product-grid').style.backgroundImage.slice(5, -2); // Extract URL from background-image style
            const productName = productElement.querySelector('.desc h3 a').textContent;
            const productPrice = productElement.querySelector('.desc .price').textContent;

            const product = {
                name: productName,
                price: productPrice,
                image: productImage
            };
            window.cart.items.push(product);
            window.cart.totalItems++;
            window.updateCartBadge();

            // Show the modal with product details
            window.showCartModal(productName, productPrice, productImage);
        });
    });
});

console.log(document.getElementById('cartModal'));
