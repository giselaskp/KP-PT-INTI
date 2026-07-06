<!-- Table -->
<div class="card table-card p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5 class="fw-bold mb-0">Asset Inventory</h5>
            <small class="text-muted">Manage and monitor all registered company assets.</small>
        </div>

        <div class="d-flex align-items-center gap-3 flex-wrap">
            <div class="search-box">
                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchInput"
                    class="form-control"
                    placeholder="Search asset..."
                    value="{{ request('search') }}">

                <button type="button" id="clearSearch" class="clear-search">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                <i class="bi bi-plus-lg me-1"></i> Add Asset
            </button>
        </div>
    </div>

<div id="assetTableArea">

    <div class="table-responsive">
    <table class="table table-hover align-middle asset-table">
        <thead class="table-light">
            <tr>
                <th>Asset ID</th>
                <th>Image</th>
                <th>Asset Name</th>
                <th>Department</th>
                <th>Location</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($assets as $asset)
                <tr>
                    <td>{{ $asset->asset_code }}</td>

                    <td>
                        @if($asset->image)
                            <img
                                src="{{ asset('storage/' . $asset->image) }}"
                                alt="{{ $asset->asset_name }}"
                                class="asset-img clickable-image"
                                data-bs-toggle="modal"
                                data-bs-target="#imagePreviewModal"
                                data-image="{{ asset('storage/' . $asset->image) }}"
                                data-title="{{ $asset->asset_name }}">
                        @else
                            <div class="asset-img-placeholder">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>

                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->department }}</td>
                    <td>{{ $asset->location }}</td>
                    <td>
                        @if($asset->status == 'Active')
                            <span class="badge-active badge-status">Active</span>
                        @elseif($asset->status == 'Maintenance')
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 badge-status">
                                Maintenance
                            </span>
                        @else
                            <span class="badge bg-secondary rounded-pill px-3 py-2 badge-status">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editAssetModal{{ $asset->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $asset->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada data asset.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($assets->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing {{ $assets->firstItem() }} - {{ $assets->lastItem() }} of {{ $assets->total() }} assets
        </div>

        <div class="pagination-links">
            {{ $assets->onEachSide(1)->links() }}
        </div>
    </div>
@endif

@foreach($assets as $asset)

    <!-- Edit Modal -->
    <div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">

                <form action="{{ route('assets.update', $asset->id) }}?page={{ request('page', 1) }}" method="POST" enctype="multipart/form-data" class="asset-form" data-asset-id="{{ $asset->id }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Asset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-alert alert alert-danger d-none mx-4 mt-3 mb-0"></div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Asset Code</label>
                            <input type="text" name="asset_code" data-label="Asset Code" maxlength="20" class="form-control" value="{{ $asset->asset_code }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Asset Name</label>
                            <input type="text" name="asset_name" data-label="Asset Name" maxlength="100" class="form-control" value="{{ $asset->asset_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" data-label="Department" maxlength="20" class="form-control" value="{{ $asset->department }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" data-label="Location" maxlength="20" class="form-control" value="{{ $asset->location }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" data-label="Status" required>
                                <option value="Active" {{ $asset->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Maintenance" {{ $asset->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Inactive" {{ $asset->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Asset Image</label>

                            <input
                                type="file"
                                name="image"
                                class="d-none image-input"
                                id="editImage{{ $asset->id }}"
                                accept="image/*">

                            <input
                                type="hidden"
                                name="remove_image"
                                class="remove-image-input"
                                value="0">

                            @if($asset->image)
                                <div class="uploaded-image-wrapper">
                                    <img
                                        src="{{ asset('storage/'.$asset->image) }}"
                                        class="uploaded-image">

                                    <div class="image-overlay">
                                        <label for="editImage{{ $asset->id }}" class="change-image">
                                            <i class="bi bi-cloud-arrow-up-fill"></i>
                                            <span>Change Image</span>
                                        </label>

                                        <button type="button" class="remove-image">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <label for="editImage{{ $asset->id }}" class="upload-box">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <h5>Drag & Drop new image here</h5>
                                    <p>or click to choose file</p>
                                </label>
                            @endif

                            <small class="text-muted">
                                Leave empty if you don't want to change the image.
                            </small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-main">Update Asset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $asset->id }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">

                <div class="modal-header border-0 pb-0">
                    <h4 class="modal-title fw-bold text-danger">
                        Delete Asset
                    </h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center py-4">
                    <div class="delete-icon mb-3">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

                    <h5 class="fw-semibold">Delete Asset</h5>
                    <p class="text-secondary mb-1">You are about to delete this asset.</p>

                    <div class="asset-preview mt-3">
                        <strong>{{ $asset->asset_name }}</strong>
                    </div>

                    <small class="text-danger">This action cannot be undone.</small>
                </div>

                <div class="modal-footer border-0 justify-content-center">
                    <button class="btn btn-light modal-action-btn" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form action="{{ route('assets.destroy', $asset->id) }}?page={{ request('page', 1) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-delete modal-action-btn">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach

<!-- Image Preview Modal -->
<div class="modal fade"
     id="imagePreviewModal"
     tabindex="-1"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="imagePreviewTitle">
                    Asset Image
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img
                    src=""
                    id="imagePreviewModalImg"
                    class="large-image-preview"
                    alt="Asset Preview">
            </div>

        </div>
    </div>
</div>

</div>
