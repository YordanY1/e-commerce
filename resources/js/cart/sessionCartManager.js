// Function to handle adding products to the cart or updating their quantity
window.scm_addToCart = async function(el, event, increment = 1) {
    const productId = el.getAttribute('data-product-id');
    console.log('Product ID:', productId);

    try {
        const response = await axios.post(`/api/shopping-cart/add-to-cart/${productId}`);
        const productData = response.data;

        // Retrieve existing cart from local storage or initialize a new one
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        // Check if product already exists in the cart
        if (cart[productId]) {
            // Product exists, update quantity based on the increment passed
            cart[productId].quantity += increment;
        } else {
            // Product does not exist, add it to the cart with the provided quantity
            cart[productId] = {
                id: productId,
                quantity: increment, // Starting with the increment quantity
                name: productData.name,
                price: productData.price,
                image: productData.image
            };
        }

        // Update the cart in local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update UI
        updateCartUI();
        updateModal(productData);

    } catch (error) {
        console.error('Error adding product to cart:', error);
    }
};

// Update UI based on current cart state
function updateCartUI() {
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    const cartBadge = document.getElementById('cart-badge');

    // Calculate total quantity for cart badge
    let totalQuantity = Object.values(cart).reduce((total, product) => total + product.quantity, 0);
    cartBadge.textContent = totalQuantity;

    // Update other parts of the UI as necessary
}

// Function to update modal with the latest added product details
function updateModal(productData) {
    document.getElementById('modal-product-image').src = productData.image;
    document.getElementById('modal-product-name').textContent = productData.name;
    document.getElementById('modal-product-price').textContent = `Цена: ${productData.price} ${productData.price_currency}`;

    // Show the modal
    var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    cartModal.show();
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
