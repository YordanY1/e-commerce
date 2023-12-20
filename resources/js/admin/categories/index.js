//Adding Categories in the modal

document.getElementById('createCategoryForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Fetch form data
    const formData = new FormData(this);

    // Make AJAX request to the store route
    fetch('/api/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error)); // Handle errors
});

//Edit Categories

window.editCategory = function editCategory(categoryId) {
    fetch(`/api/categories/${categoryId}`)
    .then(response => response.json())
    .then(data => {
        // Populate the edit form with the category data
        document.getElementById('editCategoryId').value = data.id;
        document.getElementById('editCategoryName').value = data.name;
        document.getElementById('editCategorySlug').value = data.slug;
        document.getElementById('editCategoryCode').value = data.code;
        // Populate other fields if necessary

        // Show the edit modal
        var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        editModal.show();
    })
    .catch(error => console.error('Error:', error));
}

// Handling form submission for editing a category
document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Fetch form data
    const formData = new FormData(this);
    const categoryId = formData.get('id');

    // Make AJAX request to the update route
    fetch(`/api/categories/${categoryId}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Handle success
        location.reload(); // Optionally reload the page to show the updated category
    })
    .catch(error => console.error('Error:', error)); // Handle errors
});


//Deleting a Category
window.deleteCategory = function deleteCategory(categoryId) {
    if (confirm('Are you sure you want to delete this category?')) {
        fetch(`/api/categories/${categoryId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            if (response.ok) {
                console.log('Category deleted successfully');
                location.reload(); // Reload to update the list
            } else {
                console.error('Error:', response);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
