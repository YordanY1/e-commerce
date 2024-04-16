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


document.addEventListener('DOMContentLoaded', () => {
    // Select elements from the main page
    const categoryInputs = document.querySelectorAll('.category-input');
    const priceRangeInputs = document.querySelectorAll('.price-range-input');
    const sortingSelect = document.getElementById('sorting');
    const paginationSelect = document.getElementById('pagination');

    // Attach event listeners for category and price range filters
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

    // Attach event listeners for sorting and pagination options in the modals
    document.querySelectorAll('input[name="sorting-option"]').forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    document.querySelectorAll('input[name="pagination-option"]').forEach(input => {
        input.addEventListener('change', fetchProducts);
    });

    function fetchProducts() {
        // Get selected category and price range
        const selectedCategoryId = Array.from(categoryInputs).find(input => input.checked)?.dataset.category || 'all';
        const selectedPriceRangeId = Array.from(priceRangeInputs).find(input => input.checked)?.id || 'all';

        // Get selected sorting and pagination option
        // Check both main page and modal inputs
        const selectedSorting = document.querySelector('input[name="sorting-option"]:checked')?.value || sortingSelect?.value || 'default';
        const selectedPagination = document.querySelector('input[name="pagination-option"]:checked')?.value || paginationSelect?.value || 'default';

        fetchProductsByFilters(selectedCategoryId, selectedPriceRangeId, selectedSorting, selectedPagination);
    }

    function fetchProductsByFilters(categoryId, priceRangeId, sorting, pagination) {
        const url = new URL(window.location.href);

        // Update URL with query parameters
        url.searchParams.set('category', categoryId !== 'all' ? categoryId : '');
        url.searchParams.set('priceRange', priceRangeId !== 'all' ? priceRangeId : '');
        url.searchParams.set('sorting', sorting !== 'default' ? sorting : '');
        url.searchParams.set('pagination', pagination !== 'default' ? pagination : '');

        // Fetch and update the product list
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.json())
            .then(data => {
                document.getElementById('fh5co-product').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    }
});

