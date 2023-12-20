<!-- Modal for Adding New Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Product Form -->
                <form id="addProductForm" action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>

                    <!-- Product Code -->
                    <div class="mb-3">
                        <label for="productCode" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="code" required>
                    </div>

                    <!-- Manufacturer Select -->
                    {{-- <div class="mb-3">
                        <label for="manufacturerSelect" class="form-label">Manufacturer</label>
                        <select class="form-select" id="manufacturerSelect" name="manufacturer_id">
                            @foreach ($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <!-- Categories Select -->
                    {{-- <div class="mb-3">
                        <label for="categoriesSelect" class="form-label">Categories</label>
                        <select class="form-select" id="categoriesSelect" name="categories[]" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <!-- Additional Product Attributes -->
                    <div class="mb-3">
                        <label for="productSize" class="form-label">Size</label>
                        <input type="text" class="form-control" id="productSize" name="size">
                    </div>
                    <div class="mb-3">
                        <label for="productWeight" class="form-label">Weight</label>
                        <input type="text" class="form-control" id="productWeight" name="weight">
                    </div>
                    <div class="mb-3">
                        <label for="productColor" class="form-label">Color</label>
                        <input type="text" class="form-control" id="productColor" name="color">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description"></textarea>
                    </div>


                    <!-- Pricing Fields -->
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price" step="0.01">
                    </div>
                    <!-- Additional pricing fields can be added as needed -->

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addProductForm">Save Product</button>
            </div>
        </div>
    </div>
</div>
