<!-- Edit Manufacturer Modal -->
<div class="modal fade" id="editManufacturerModal" tabindex="-1" aria-labelledby="editManufacturerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editManufacturerModalLabel">Edit Manufacturer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editManufacturerName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="editManufacturerName">
                </div>
                <!-- Placeholder for additional fields -->
                <div class="mb-3">
                    <label for="editManufacturerSlug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="editManufacturerSlug">
                </div>
                <div class="mb-3">
                    <label for="editManufacturerCode" class="form-label">Code</label>
                    <input type="text" class="form-control" id="editManufacturerCode">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitEditManufacturerData()">Save Changes</button>
            </div>
        </div>
    </div>
</div>
