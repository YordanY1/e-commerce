//Create products
document.addEventListener('DOMContentLoaded', function () {
    const addProductForm = document.getElementById('addProductForm');
    addProductForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('/api/products', { // Ensure this is the correct API endpoint
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            location.reload(true);
            // Refresh the page or update the UI as needed
        })
        .catch((error) => {
            console.error('Error:', error);
            // Handle errors here
        });
    });
});

//Edit
window.editProduct = function editProduct(productId) {
    fetch('/api/products/' + productId)
        .then(response => response.json())
        .then(data => {
            // Populate form fields in the modal
            document.getElementById('editProductId').value = data.id;
            document.getElementById('editProductName').value = data.name;
            document.getElementById('editProductCode').value = data.code;
            document.getElementById('editManufacturerSelect').value = data.manufacturer_id;

            // Handle Categories Select
            const categoriesSelect = document.getElementById('editCategoriesSelect');
            if (categoriesSelect && data.attributes && data.attributes.categories) {
                Array.from(categoriesSelect.options).forEach(option => {
                    option.selected = data.attributes.categories.includes(parseInt(option.value));
                });
            }

            // Additional fields - accessing nested attributes
            document.getElementById('editProductSize').value = data.attributes.size;
            document.getElementById('editProductWeight').value = data.attributes.weight;
            document.getElementById('editProductColor').value = data.attributes.color;
            document.getElementById('editProductDescription').value = data.attributes.description;

            // Pricing Fields - accessing nested price object
            if (data.price && data.price.price) {
                document.getElementById('editProductPrice').value = data.price.price;
            }

            // Open the modal
            $('#editProductModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching product data:', error);
        });
};

//Edit
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editProductForm');

    editForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);
        const productId = document.getElementById('editProductId').value;

        fetch('/api/products/' + productId, {
            method: 'POST', // Using POST because browsers don't support PUT with FormData
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with status ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            // console.log('Success:', data);
            $('#editProductModal').modal('hide'); // Close the modal
            location.reload(); // Refresh the page to show the updated product
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors here, such as displaying error messages
        });
    });
});

//Delete
window.deleteProduct = function(productId) {
    if(confirm('Are you sure you want to delete this product?')) {
        fetch('/api/products/' + productId, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with status ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            // console.log('Product deleted:', data);
            location.reload(); // Refresh the page or update the UI as needed
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors here, such as displaying error messages
        });
    }
};

