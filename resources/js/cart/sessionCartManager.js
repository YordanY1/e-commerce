//Add to cart
window.scm_addToCart = async function(el, evnt) {
    const product_id = el.getAttribute('data-product-id');
    console.log('Product ID:', product_id);

    try {
        let result = await axios.post('/api/shopping-cart/add-to-cart/' + product_id, {});
        console.log('Response:', result);

        if (result.data) {
            console.log('Product data:', result.data);

            // Retrieve the cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            let quantity = result.data.quantity;

            // Check if the product is already in the cart and update quantity
            if (cart[product_id]) {
                cart[product_id].quantity += quantity;
            } else {
                // Or add the product to the cart
                cart[product_id] = {
                    id: product_id,
                    quantity: quantity,
                    name: result.data.name,
                    price: result.data.price,
                    image: result.data.image
                };
            }

            // Save the updated cart back to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            document.addEventListener('DOMContentLoaded', function() {
                updateCartUI();
            });

            // Update modal content
            document.getElementById('modal-product-image').src = result.data.image;
            document.getElementById('modal-product-name').textContent = result.data.name;
            document.getElementById('modal-product-price').textContent = `Цена: ${result.data.price} ${result.data.price_currency}`;

            // Show the modal
            var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        }
    } catch (error) {
        console.error('Error:', error);
    }

    return true;
};

// Update cart badge
function updateCartUI() {
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    const cartBadge = document.getElementById('cart-badge');
    let totalQuantity = 0;

    for (let id in cart) {
        totalQuantity += cart[id].quantity;
    }

    cartBadge.textContent = totalQuantity;
}

document.addEventListener('DOMContentLoaded', updateCartUI);

window.scm_removeFromCart = async function(el, evnt) {

    const product_id = el.getAttribute('data-product-id');

    let result = await axios.post('/api/shopping-cart/remove-from-cart/' + product_id, {});

    if (result.data.status == 'ok') {

    }

    return true;
}

window.scm_emptyCart = async function(el, evnt) {

    let result = await axios.post('/api/shopping-cart/empty-cart/', {});

    if (result.data.status == 'ok') {

    }

    return true;
}
