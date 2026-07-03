<!-- Stats -->
<div class="row g-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Asset</small>
                    <h3 class="fw-bold mb-0">{{ $totalAsset }}</h3>
                </div>
                <div class="icon-box">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Department</small>
                    <h3 class="fw-bold mb-0">{{ $totalDepartment }}</h3>
                </div>
                <div class="icon-box">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Active Asset</small>
                    <h3 class="fw-bold mb-0">{{ $activeAsset }}</h3>
                </div>
                <div class="icon-box">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Maintenance</small>
                    <h3 class="fw-bold mb-0">{{ $maintenanceAsset }}</h3>
                </div>
                <div class="icon-box">
                    <i class="bi bi-tools"></i>
                </div>
            </div>
        </div>
    </div>
</div>
