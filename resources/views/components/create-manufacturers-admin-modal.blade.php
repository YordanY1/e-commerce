<!-- Create Manufacturer Modal -->
<div class="modal fade" id="createManufacturerModal" tabindex="-1" aria-labelledby="createManufacturerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createManufacturerModalLabel">Add New Manufacturer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createManufacturerForm">
                    @csrf
                    <div class="mb-3">
                        <label for="manufacturerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="manufacturerName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="manufacturerCode" class="form-label">Code</label>
                        <input type="text" class="form-control" id="manufacturerCode" name="code" required>
                    </div>

                    {{-- Uncomment or remove these fields as needed --}}
                    {{-- <div class="mb-3">
                        <label for="manufacturerCountry" class="form-label">Country ID</label>
                        <input type="number" class="form-control" id="manufacturerCountry" name="country_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="manufacturerStatus" class="form-label">Status</label>
                        <input type="number" class="form-control" id="manufacturerStatus" name="status" required>
                    </div>

                    <div class="mb-3">
                        <label for="manufacturerSortOrder" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="manufacturerSortOrder" name="sort_order">
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createManufacturerForm">Save Manufacturer</button>
            </div>
        </div>
    </div>
</div>
