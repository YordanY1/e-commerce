document.addEventListener('DOMContentLoaded', () => {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const pageContent = document.querySelector('.page-content');

    navbarToggler.addEventListener('click', () => {
        if (navbarToggler.classList.contains('collapsed')) {
            pageContent.classList.add('blur-when-active');
        } else {
            pageContent.classList.remove('blur-when-active');
        }
    });
});


//Carosel

window.updateActiveDot = function updateActiveDot(activeIndex) {
    const dots = document.querySelectorAll('#carouselStepper .dot-stepper li');
    dots.forEach((dot, index) => {
        if (index === activeIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

window.moveCarousel = function moveCarousel(step) {
    $('#productCarousel').carousel(step);
    updateActiveDot(step);
}


