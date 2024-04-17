document.addEventListener('DOMContentLoaded', () => {
    // Handle Navigation Toggle and Page Blur
    const navbarToggler = document.querySelector('.navbar-toggler');
    const pageContent = document.querySelector('.page-content');

    if (navbarToggler && pageContent) {
        navbarToggler.addEventListener('click', () => {
            if (navbarToggler.classList.contains('collapsed')) {
                pageContent.classList.add('blur-when-active');
            } else {
                pageContent.classList.remove('blur-when-active');
            }
        });
    }

    // Sorting and Pagination Handling
    const desktopCategoryInputs = document.querySelectorAll('.desktop-category-input');
    const modalCategoryInputs = document.querySelectorAll('.modal-category-input');
    const desktopPriceRangeInputs = document.querySelectorAll('.desktop-price-range-input');
    const modalPriceRangeInputs = document.querySelectorAll('.modal-price-range-input');
    const desktopSortingSelect = document.getElementById('desktop-sorting');
    const modalSortingOptions = document.querySelectorAll('.modal-sorting-option');
    const desktopPaginationSelect = document.getElementById('desktop-pagination');
    const modalPaginationOptions = document.querySelectorAll('.modal-pagination-option');

    // Define a function to fetch products based on filters
    function fetchProducts() {
        if (desktopSortingSelect && desktopPaginationSelect) {
            const selectedCategoryId = getSelectedCategoryId();
            const selectedPriceRangeId = getSelectedPriceRangeId();
            const selectedSorting = getSelectedSorting();
            const selectedPagination = getSelectedPagination();

            fetchProductsByFilters(selectedCategoryId, selectedPriceRangeId, selectedSorting, selectedPagination);
        }
    }

    function getSelectedCategoryId() {
        const desktopSelected = Array.from(desktopCategoryInputs).find(input => input.checked);
        const modalSelected = Array.from(modalCategoryInputs).find(input => input.checked);
        return desktopSelected ? desktopSelected.dataset.category : (modalSelected ? modalSelected.dataset.category : 'all');
    }

    function getSelectedPriceRangeId() {
        const desktopSelected = Array.from(desktopPriceRangeInputs).find(input => input.checked);
        const modalSelected = Array.from(modalPriceRangeInputs).find(input => input.checked);
        return desktopSelected ? desktopSelected.id : (modalSelected ? modalSelected.id : 'all');
    }

    function getSelectedSorting() {
        const modalSelected = Array.from(modalSortingOptions).find(option => option.checked);
        return desktopSortingSelect ? desktopSortingSelect.value : (modalSelected ? modalSelected.value : 'default');
    }

    function getSelectedPagination() {
        const modalSelected = Array.from(modalPaginationOptions).find(option => option.checked);
        return desktopPaginationSelect ? desktopPaginationSelect.value : (modalSelected ? modalSelected.value : 'all');
    }

    // Attach event listeners conditionally
    desktopCategoryInputs.forEach(input => input.addEventListener('change', fetchProducts));
    modalCategoryInputs.forEach(input => input.addEventListener('change', fetchProducts));
    desktopPriceRangeInputs.forEach(input => input.addEventListener('change', fetchProducts));
    modalPriceRangeInputs.forEach(input => input.addEventListener('change', fetchProducts));
    if (desktopSortingSelect) {
        desktopSortingSelect.addEventListener('change', fetchProducts);
    }
    modalSortingOptions.forEach(option => option.addEventListener('change', fetchProducts));
    if (desktopPaginationSelect) {
        desktopPaginationSelect.addEventListener('change', fetchProducts);
    }
    modalPaginationOptions.forEach(option => option.addEventListener('change', fetchProducts));

    // Function to execute fetching products with current filters
    function fetchProductsByFilters(categoryId, priceRangeId, sorting, pagination) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', categoryId);
        url.searchParams.set('priceRange', priceRangeId);
        url.searchParams.set('sorting', sorting);
        url.searchParams.set('pagination', pagination);

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.json())
            .then(data => {
                document.getElementById('fh5co-product').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    }
});
