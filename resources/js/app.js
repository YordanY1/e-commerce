import $ from 'jquery';
window.$ = window.jQuery = $;
import select2 from 'select2';
select2();


import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import 'slick-carousel';

// Importing AOS
import AOS from 'aos';
import 'aos/dist/aos.css'; // Import AOS styles

// Initialize AOS
AOS.init();


//JS for all of the app
import './main';

//Products into Basket Logic
import './products/productsIntoBasket';

//Checkout
import './checkout/checkout';

