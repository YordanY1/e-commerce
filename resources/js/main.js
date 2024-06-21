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
    const desktopManufacturerInputs = document.querySelectorAll('.desktop-manufacturer-input');
    const modalManufacturerInputs = document.querySelectorAll('.modal-manufacturer-input');
    const desktopPriceRangeInputs = document.querySelectorAll('.desktop-price-range-input');
    const modalPriceRangeInputs = document.querySelectorAll('.modal-price-range-input');
    const desktopSortingSelect = document.getElementById('desktop-sorting');
    const desktopPaginationSelect = document.getElementById('desktop-pagination');

    // Define a function to fetch products based on filters
    function fetchProducts() {
        const selectedCategoryId = getSelectedCategoryId();
        const selectedManufacturerId = getSelectedManufacturerId();
        const selectedPriceRangeId = getSelectedPriceRangeId();
        const selectedSorting = getSelectedSorting();
        const selectedPagination = getSelectedPagination();

        fetchProductsByFilters(selectedCategoryId, selectedManufacturerId, selectedPriceRangeId, selectedSorting, selectedPagination);
    }

    function getSelectedCategoryId() {
        const desktopSelected = Array.from(desktopCategoryInputs).find(input => input.checked);
        const modalSelected = Array.from(modalCategoryInputs).find(input => input.checked);
        return desktopSelected ? desktopSelected.dataset.category : (modalSelected ? modalSelected.dataset.category : 'all');
    }

    function getSelectedManufacturerId() {
        const desktopSelected = Array.from(desktopManufacturerInputs).find(input => input.checked);
        const modalSelected = Array.from(modalManufacturerInputs).find(input => input.checked);
        return desktopSelected ? desktopSelected.dataset.manufacturer : (modalSelected ? modalSelected.dataset.manufacturer : 'all');
    }

    function getSelectedPriceRangeId() {
        const desktopSelected = Array.from(desktopPriceRangeInputs).find(input => input.checked);
        const modalSelected = Array.from(modalPriceRangeInputs).find(input => input.checked);
        return desktopSelected ? desktopSelected.dataset.priceRange : (modalSelected ? modalSelected.dataset.priceRange : 'all');
    }

    function getSelectedSorting() {
        return desktopSortingSelect ? desktopSortingSelect.value : 'default';
    }

    function getSelectedPagination() {
        return desktopPaginationSelect ? desktopPaginationSelect.value : 'all';
    }

    // Attach event listeners conditionally
    desktopCategoryInputs.forEach(input => input.addEventListener('change', fetchProducts));
    modalCategoryInputs.forEach(input => input.addEventListener('change', fetchProducts));
    desktopManufacturerInputs.forEach(input => input.addEventListener('change', fetchProducts));
    modalManufacturerInputs.forEach(input => input.addEventListener('change', fetchProducts));
    desktopPriceRangeInputs.forEach(input => input.addEventListener('change', fetchProducts));
    modalPriceRangeInputs.forEach(input => input.addEventListener('change', fetchProducts));
    if (desktopSortingSelect) {
        desktopSortingSelect.addEventListener('change', fetchProducts);
    }
    if (desktopPaginationSelect) {
        desktopPaginationSelect.addEventListener('change', fetchProducts);
    }

    // Function to execute fetching products with current filters
    function fetchProductsByFilters(categoryId, manufacturerId, priceRangeId, sorting, pagination) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', categoryId);
        url.searchParams.set('manufacturer', manufacturerId);
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
