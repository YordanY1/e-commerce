@extends('layouts.cart.layout')

@section('content')
<div class="container mt-4">
    <h2>Количка за пазаруване</h2>

    <!-- Cart Items -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Продукти в количката</h4>
            <hr>

            <div id="cart-items">
                {{-- Cart items will be dynamically inserted here via JavaScript --}}
            </div>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Информация за поръчката</h4>
            <hr>

            <p>Всички продукти: <span id="subtotal-price"></span></p>
            <p>Общо с ДСС: <span id="total-price"></span></p>

            <div class="d-flex justify-content-end">
                <a href="{{ url('/checkout') }}" class="btn btn-primary">Продължи напред</a>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        localStorage.removeItem('lastSearch');
        renderCartItems();
        updateCartSummary();
    });

    function renderCartItems() {
        const cartItemsDiv = document.getElementById('cart-items');
        const cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };
        let itemsHtml = '';

        Object.values(cartData.products).forEach(item => {
            itemsHtml += `
                <div class="cart-item row mb-3 p-2 bg-light rounded align-items-center">
                    <div class="col-md-2">
                        <img src="${item.image}" alt="${item.name}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-1">${item.name}</h5>
                        <p class="mb-1 text-muted">Цена: ${item.price} лв.</p>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('${item.id}')">-</button>
                        <span class="px-2" id="quantity-${item.id}">${item.quantity}</span>
                        <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('${item.id}')">+</button>
                    </div>
                    <div class="col-md-3 text-right">
                        <button class="btn btn-danger btn-sm" onclick="removeItem('${item.id}')">Изтрий</button>
                    </div>
                </div>
            `;
        });

        cartItemsDiv.innerHTML = itemsHtml;
    }

    function updateCartSummary() {
        const subtotalPriceSpan = document.getElementById('subtotal-price');
        const totalPriceSpan = document.getElementById('total-price');
        const cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };

        subtotalPriceSpan.textContent = `${cartData.total.toFixed(2)} лв.`;
        const taxRate = 0.20; // 20% tax
        const totalPrice = cartData.total * (1 + taxRate);
        totalPriceSpan.textContent = `${totalPrice.toFixed(2)} лв.`;
    }

    function increaseQuantity(productId) {
        let cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };
        if (cartData.products[productId]) {
            cartData.products[productId].quantity += 1;
            updateQuantityInBackend(productId, cartData.products[productId].quantity);
            updateTotal(cartData);
        }
    }

    function decreaseQuantity(productId) {
        let cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };
        if (cartData.products[productId] && cartData.products[productId].quantity > 1) {
            cartData.products[productId].quantity -= 1;
            updateQuantityInBackend(productId, cartData.products[productId].quantity);
            updateTotal(cartData);
        } else if (cartData.products[productId] && cartData.products[productId].quantity === 1) {
            removeItem(productId);
        }
    }

    async function updateQuantityInBackend(productId, quantity) {
        try {
            const response = await axios.post('api/shopping-cart/update', { productId, quantity });
            console.log('Quantity updated in backend', response.data);
            if (response.data.success) {
                updateCartSummary();
            }
        } catch (error) {
            console.error('Error updating quantity in backend:', error);
        }
    }

    async function removeItem(productId) {
        let cartData = JSON.parse(localStorage.getItem('cart')) || { products: {}, total: 0 };
        if (cartData.products[productId]) {
            try {
                const response = await axios.post(`/api/shopping-cart/remove-from-cart/${productId}`);
                console.log('Item removed:', response.data);
                if (response.data.success) {
                    delete cartData.products[productId];
                    updateTotal(cartData);
                    localStorage.setItem('cart', JSON.stringify(cartData)); // Update localStorage after removing the item
                } else {
                    console.error('Error removing item:', response.data.message); // Use server's error message
                }
            } catch (error) {
                console.error('Error removing item:', error.response ? error.response.data : error);
            }
        } else {
            console.log('Product not found in local cart:', productId);
        }
    }


    function updateTotal(cartData) {
        cartData.total = Object.values(cartData.products).reduce((total, product) => {
            return total + (product.quantity * parseFloat(product.price));
        }, 0);

        localStorage.setItem('cart', JSON.stringify(cartData));
        renderCartItems();
        updateCartSummary();
    }
</script>
