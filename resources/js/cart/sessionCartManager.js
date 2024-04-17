// Function to handle adding products to the cart or updating their quantity
window.scm_addToCart = async function(el, event, increment = 1) {
    const productId = el.getAttribute('data-product-id');
    console.log('Product ID:', productId);

    try {
        const response = await axios.post(`/api/shopping-cart/add-to-cart/${productId}`);
        const productData = response.data;

        // Retrieve existing cart from local storage or initialize a new one
        let cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };

        // Check if product already exists in the cart products
        if (cartData.products[productId]) {
            // Product exists, update quantity based on the increment passed
            cartData.products[productId].quantity += increment;
        } else {
            // Product does not exist, add it to the cart products with the provided quantity
            cartData.products[productId] = {
                id: productId,
                quantity: increment,
                name: productData.name,
                price: productData.price,
                image: productData.image,
                description: productData.description,
                weight: productData.weight
            };
        }

        // Update total price in the cart
        cartData.total = Object.values(cartData.products).reduce((total, product) => {
            return total + (product.quantity * parseFloat(product.price));
        }, 0);

        // Update the cart in local storage
        localStorage.setItem('cart', JSON.stringify(cartData));

        // Update UI
        updateCartUI();
        updateModal(productData);

    } catch (error) {
        console.error('Error adding product to cart:', error);
    }
};

// Update UI based on current cart state
function updateCartUI() {
    let cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };
    const cartBadge = document.getElementById('cart-badge');

    // Calculate total quantity for cart badge
    let totalQuantity = Object.values(cartData.products).reduce((total, product) => total + product.quantity, 0);
    cartBadge.textContent = totalQuantity;
}

// Function to update modal with the latest added product details
function updateModal(productData) {
    document.getElementById('modal-product-image').src = productData.image;
    document.getElementById('modal-product-name').textContent = productData.name;
    document.getElementById('modal-product-price').textContent = `Price: ${productData.price} BGN`;

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
