<!-- Add Asset Modal -->
<div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addAssetModalLabel">Add New Asset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="asset-form" novalidate>
                @csrf
                <div class="modal-alert alert alert-danger d-none mx-4 mt-3 mb-0"></div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Asset Code</label>
                        <input type="text" name="asset_code" class="form-control" placeholder="Example: AST004" data-label="Asset Code" maxlength="20" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Asset Name</label>
                        <input type="text" name="asset_name" class="form-control" placeholder="Example: Laptop Dell Latitude" data-label="Asset Name" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Department</label>
                        <input type="text" name="department" class="form-control" placeholder="Example: IT Support" data-label="Department" maxlength="50" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Example: Gedung INTI Lt. 2" data-label="Location" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" data-label="Status" required>
                            <option value="Active">Active</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Asset Image</label>

                        <input
                            type="file"
                            name="image"
                            class="d-none image-input"
                            id="addAssetImage"
                            accept="image/*">

                        <label for="addAssetImage" class="upload-box">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <h5>Drag & Drop image here</h5>
                            <p>or click to choose file</p>
                        </label>

                        <small class="text-muted">
                            Supported formats: JPG, JPEG, PNG. Max 5 MB.
                        </small>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light modal-action-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-main modal-action-btn">Save Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>
