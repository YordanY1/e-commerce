//TODO move it to app.js
import axios from "axios"

//TODO these can be done with event listeners but make sure you load the script once the DOC is loaded
//document.addEventListener('DOMContentLoaded', function() {});

window.scm_addToCart = async function(el, evnt) {
    
    const product_id = el.getAttribute('data-product-id');

    let result = await axios.post('/api/shopping-cart/add-to-cart/' + product_id, {});

    if (result.data.status == 'ok') {

    }

    return true;
}

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