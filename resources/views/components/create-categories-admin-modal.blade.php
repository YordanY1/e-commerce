<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryCode" class="form-label">Code</label>
                        <input type="text" class="form-control" id="categoryCode" name="code">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createCategoryForm">Save Category</button>
            </div>
        </div>
    </div>
</div>
