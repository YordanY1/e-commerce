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

// window.updateActiveDot = function updateActiveDot(activeIndex) {
//     const dots = document.querySelectorAll('#carouselStepper .dot-stepper li');
//     dots.forEach((dot, index) => {
//         if (index === activeIndex) {
//             dot.classList.add('active');
//         } else {
//             dot.classList.remove('active');
//         }
//     });
// }

// window.moveCarousel = function moveCarousel(step) {
//     $('#productCarousel').carousel(step);
//     updateActiveDot(step);
// }


//Carosel
function moveCarousel(index) {
    $('#productCarousel').carousel(index);
}



//For the categories
document.addEventListener('DOMContentLoaded', () => {
    const categoryInputs = document.querySelectorAll('.category-input');
    const priceRangeInputs = document.querySelectorAll('.price-range-input');

    categoryInputs.forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    priceRangeInputs.forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    function fetchProducts() {
        const selectedCategoryId = Array.from(categoryInputs)
            .find(input => input.checked)?.dataset.category || 'all';
        const selectedPriceRangeId = Array.from(priceRangeInputs)
            .find(input => input.checked)?.id || 'all';

        fetchProductsByFilters(selectedCategoryId, selectedPriceRangeId);
    }

    function fetchProductsByFilters(categoryId, priceRangeId) {
        const url = new URL(window.location.href);

        if (categoryId !== 'all') {
            url.searchParams.set('category', categoryId);
        } else {
            url.searchParams.delete('category');
        }

        if (priceRangeId !== 'all') {
            url.searchParams.set('priceRange', priceRangeId);
        } else {
            url.searchParams.delete('priceRange');
        }

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.json())
            .then(data => {
                document.getElementById('fh5co-product').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    }
});
