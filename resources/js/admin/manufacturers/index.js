//CREATE
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createManufacturerForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('/api/manufacturers', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(data => {
            form.reset(); // Reset the form
            location.reload(); // Reload the page
        })
        .catch(error => console.error('Error:', error)); // Handle errors
    });
});


//UPDATE

//Function to call the modal
window.editManufacturer = function(manufacturerId) {
    window.editingManufacturerId = manufacturerId; // Store the ID

    fetch(`/api/manufacturers/${manufacturerId}`)
    .then(response => response.json())
    .then(data => {
        // Populate the input fields with data
        document.getElementById('editManufacturerName').value = data.name || '';
        document.getElementById('editManufacturerSlug').value = data.slug || '';
        document.getElementById('editManufacturerCode').value = data.code || '';

        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editManufacturerModal'));
        editModal.show();
    })
    .catch(error => console.error('Error:', error));
};


//Update function
window.submitEditManufacturerData = function() {
    const updatedData = {
        name: document.getElementById('editManufacturerName').value,
        slug: document.getElementById('editManufacturerSlug').value,
        code: document.getElementById('editManufacturerCode').value,
        // Add other fields similarly
    };

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/api/manufacturers/${editingManufacturerId}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        location.reload(); // Reload to show updated data
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


//Delete

window.deleteManufacturer = function(manufacturerId) {
    if (!confirm('Are you sure you want to delete this manufacturer?')) {
        return; // Stop the function if the user cancels the confirmation dialog
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/api/manufacturers/${manufacturerId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        location.reload(); // Reload the page to update the list of manufacturers
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
