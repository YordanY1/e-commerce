import $ from 'jquery';
window.$ = window.jQuery = $;
import select2 from 'select2';
select2();

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Importing AOS
import AOS from 'aos';
// Initializing AOS
AOS.init();


import 'slick-carousel';

//JS for all of the app
import './main';

//Products into Basket Logic
import './products/productsIntoBasket';

//Checkout

