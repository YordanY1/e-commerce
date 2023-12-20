<!-- Modal for Editing Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Product Form -->
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editProductId" name="product_id">

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="name" required>
                    </div>

                    <!-- Product Code -->
                    <div class="mb-3">
                        <label for="editProductCode" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="editProductCode" name="code" required>
                    </div>

                    <!-- Manufacturer Select -->
                    <div class="mb-3">
                        <label for="editManufacturerSelect" class="form-label">Manufacturer</label>
                        <select class="form-select" id="editManufacturerSelect" name="manufacturer_id">
                            @foreach ($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Categories Select -->
                    <div class="mb-3">
                        <label for="editCategoriesSelect" class="form-label">Categories</label>
                        <select class="form-select" id="editCategoriesSelect" name="categories[]" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Additional Product Attributes -->
                    <div class="mb-3">
                        <label for="editProductSize" class="form-label">Size</label>
                        <input type="text" class="form-control" id="editProductSize" name="size">
                    </div>
                    <div class="mb-3">
                        <label for="editProductWeight" class="form-label">Weight</label>
                        <input type="text" class="form-control" id="editProductWeight" name="weight">
                    </div>
                    <div class="mb-3">
                        <label for="editProductColor" class="form-label">Color</label>
                        <input type="text" class="form-control" id="editProductColor" name="color">
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="description"></textarea>
                    </div>

                    <!-- Pricing Fields -->
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="price" step="0.01">
                    </div>

                    <!-- Image Upload Field -->
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="editProductImage" name="image" accept="image/*">
                    </div>

                    <!-- File Upload Field -->
                    <div class="mb-3">
                        <label for="editProductFiles" class="form-label">Product Files</label>
                        <input type="file" class="form-control" id="editProductFiles" name="files[]" accept="application/pdf" multiple>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editProductForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>
