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


//Sorting
document.addEventListener('DOMContentLoaded', () => {
    // Select elements
    const categoryInputs = document.querySelectorAll('.category-input');
    const priceRangeInputs = document.querySelectorAll('.price-range-input');

    // These will only be set if elements with the corresponding IDs exist
    const sortingSelect = document.getElementById('sorting');
    const paginationSelect = document.getElementById('pagination');

    // Event listeners for category and price range filters
    categoryInputs.forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    priceRangeInputs.forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    // Event listeners for sorting and pagination, if those elements exist
    if (sortingSelect) {
        sortingSelect.addEventListener('change', fetchProducts);
    }

    if (paginationSelect) {
        paginationSelect.addEventListener('change', fetchProducts);
    }

    function fetchProducts() {
        const selectedCategoryId = Array.from(categoryInputs)
            .find(input => input.checked)?.dataset.category || 'all';
        const selectedPriceRangeId = Array.from(priceRangeInputs)
            .find(input => input.checked)?.id || 'all';
        const selectedSorting = sortingSelect ? sortingSelect.value : 'default';
        const selectedPagination = paginationSelect ? paginationSelect.value : 'default';

        fetchProductsByFilters(selectedCategoryId, selectedPriceRangeId, selectedSorting, selectedPagination);
    }

    function fetchProductsByFilters(categoryId, priceRangeId, sorting, pagination) {
        const url = new URL(window.location.href);

        // Set or remove query parameters based on filters
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

        // Add parameters only if they exist
        if (sorting !== 'default') {
            url.searchParams.set('sorting', sorting);
        } else {
            url.searchParams.delete('sorting');
        }

        if (pagination !== 'default') {
            url.searchParams.set('pagination', pagination);
        } else {
            url.searchParams.delete('pagination');
        }

        // Fetch and update the product list
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.json())
            .then(data => {
                document.getElementById('fh5co-product').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    }
});


//Emails
window.sendEmail = function sendEmail(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('contactForm'));

    fetch('/api/send-email', {
        method: 'POST',
        body: formData
    }).then(response => {
        return response.json();
    }).then(data => {
        // Clear the form
        document.getElementById('contactForm').reset();

        // Show the success modal
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }).catch(error => {
        console.error('Error:', error);
    });
}
