<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryCode" class="form-label">Code</label>
                        <input type="text" class="form-control" id="categoryCode" name="code">
                    </div>
                    <div class="mb-3">
                        <label for="parentCategory" class="form-label">Parent Category</label>
                        <select class="form-select" id="parentCategory" name="parent_id">
                            <option value="">None</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="categoryDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="categoryImage" name="image" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCategoryButton">Save Category</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('saveCategoryButton').addEventListener('click', function() {
    var form = document.getElementById('createCategoryForm');
    var formData = new FormData(form);

    fetch('{{ route('categories.store') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            //console.log('Validation errors:', data.errors);
            alert('There was an error submitting the form.');
        } else {
           // console.log('Category created:', data);
            alert('Category created successfully.');
            // Close the modal or perform other actions as needed
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the form.');
    });
});

</script>
