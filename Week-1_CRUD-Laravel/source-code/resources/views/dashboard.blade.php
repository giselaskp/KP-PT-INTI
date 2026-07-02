<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CRUD System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --navy: #0F2E6E;
            --blue: #2563EB;
            --sky: #38BDF8;
            --bg: #F8FAFC;
            --dark: #0F172A;
            --muted: #64748B;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--dark);
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, rgba(37,99,235,.80), rgba(15,46,110,.92)), url("{{ asset('images/gedung_inti.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            padding: 24px 20px;
            z-index: 1000;
            transition: .3s ease;
            overflow: hidden;
        }

        .sidebar::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,.05);
            pointer-events: none;
        }

        .sidebar-logo {
            width: 115px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,.18);
            margin: 22px 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .sidebar-title{
            color:rgba(255,255,255,.55);
            font-size:12px;
            font-weight:700;
            letter-spacing:2px;
            margin-bottom:12px;
            margin-left:14px;
            text-transform:uppercase;
        }

        .sidebar-menu a,
        .logout-btn {
            color: rgba(255,255,255,.88);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 13px;
            margin-bottom: 8px;
            transition: .25s;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active,
        .logout-btn:hover {
            background: rgba(255,255,255,.16);
            color: white;
        }

        .main-content {
            margin-left: 260px;
            padding: 28px;
            transition: .3s ease;
        }

        .mobile-topbar {
            display: none;
        }

        .hero-card{
            background:
                linear-gradient(
                    135deg,
                    rgba(15,46,110,.90),
                    rgba(37,99,235,.72)
                ),
                url("{{ asset('images/gedung.png') }}");
            background-size:cover;
            background-position:center;
            border-radius:26px;
            padding:30px;
            color:white;
            margin-bottom:28px;
            box-shadow:0 20px 45px rgba(37,99,235,.20);
            position: relative;
            overflow: hidden;
        }

        .hero-badge{
            display:inline-flex;
            align-items:center;
            padding:8px 20px;
            border-radius:999px;
            background:rgba(255,255,255,.14);
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,.12);
            color:white;
            font-size:14px;
            font-weight:600;
            letter-spacing:.4px;
        }

        .hero-title{
            font-size:34px;
            font-weight:800;
            margin-top:22px;
        }

        .hero-info{
            display:flex;
            align-items:center;
            gap:24px;
            margin-top:22px;
        }

        .hero-item{
            display:flex;
            align-items:center;
            gap:8px;
            color:white;
            font-size:16px;
        }

        .hero-item i{
            color:white;
            font-size:16px;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 8px 24px rgba(15,23,42,.06);
            height: 100%;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, rgba(32,74,155,.90), rgba(52,114,220,.88), rgba(110,160,255,.82));
            box-shadow: 0 8px 20px rgba(47,99,199,.18), inset 0 1px 1px rgba(255,255,255,.25);
            color: white;
            font-size: 23px;
        }

        .table-card {
            background: white;
            border: none;
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(15,23,42,.06);
            margin-top: 24px;
        }

        .btn-main {
            background: linear-gradient(135deg,  #214A9B 0%, #2F63C7 55%, #5C8FF5 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 600;
            position:relative;
            overflow:hidden;
            transition:.3s ease;
        }

        .btn-main::before{
            content:"";
            position:absolute;
            top:0;
            left:-120%;
            width:70%;
            height:100%;
            background:linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.25),
                transparent
            );
            transition:.7s;

        }

        .btn-main:hover::before{
            left:150%;
        }      

        .btn-main:hover {
            background: linear-gradient(135deg,  #183A82, #2958B8, #4F84ED);
            color: white;
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(33,74,155,.25);
        }

        .btn-outline-primary{
            color:#2F63C7;
            border:1px solid #2F63C7;
            border-radius:10px;
            transition:.25s ease;
        }

        .btn-outline-primary:hover{
            color:#fff;
            background:linear-gradient(135deg, #214A9B, #2F63C7);
            border-color:#214A9B;
            transform:translateY(-2px);
            box-shadow:0 6px 16px rgba(33,74,155,.20);
        }
        
        .btn-outline-danger{
            color:#DC3545;
            border:1px solid #DC3545;
            border-radius:10px;
            transition:.25s ease;
        }

        .btn-outline-danger:hover{
            color:#fff;
            background:#D7263D;
            border-color:#D7263D;
            transform:translateY(-2px);
            box-shadow:0 6px 16px rgba(215,38,61,.18);
        }

        .btn-outline-primary i,
        .btn-outline-danger i{
            transition:.25s;
        }

        .btn-outline-primary:hover i,
        .btn-outline-danger:hover i{
            transform:scale(1.08);
        }

        .btn-outline-primary:active,
        .btn-outline-danger:active{
            transform:scale(.96);
        }

        .delete-icon{
            width:80px;
            height:80px;
            margin:auto;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#FEE2E2;
            color:#DC2626;
            font-size:40px;
        }

        .asset-preview{
            background:#F8FAFC;
            border-radius:12px;
            padding:14px;
            border:1px solid #E2E8F0;
        }

        .modal-content{
            border-radius:24px;
        }

        .badge-active {
            background: #DCFCE7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .sidebar-overlay {
            display: none;
        }

        footer a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15,23,42,.45);
                z-index: 999;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-content {
                margin-left: 0;
                padding: 18px;
                padding-top: 86px;
            }

            .mobile-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 68px;
                background: white;
                padding: 0 18px;
                z-index: 900;
                box-shadow: 0 8px 24px rgba(15,23,42,.08);
            }

            .mobile-logo {
                width: 82px;
            }

            .burger-btn {
                border: none;
                background: transparent;
                font-size: 26px;
                color: var(--dark);
            }

            .hero-card{
                padding:30px;
            }

            .table-card {
                padding: 18px !important;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive table {
                min-width: 900px;
            }

            .table-responsive::-webkit-scrollbar {
                height: 8px;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background: rgba(37,99,235,.35);
                border-radius: 999px;
            }

            .table-responsive::-webkit-scrollbar-track {
                background: #EEF2F7;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Topbar -->
    <div class="mobile-topbar">
        <button class="burger-btn" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>

        <img src="{{ asset('images/logo.png') }}" class="mobile-logo" alt="Logo PT INTI">

    </div>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" class="sidebar-logo" alt="Logo PT INTI">
        </div>

        <div class="sidebar-divider"></div>

        <div class="user-profile">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <div>
                <h6 class="fw-bold mb-0">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </h6>
                <small class="text-white-50">Administrator</small>
            </div>
        </div>

        <div class="sidebar-divider"></div>

        <p class="sidebar-title">MENU</p>
        
        <nav class="sidebar-menu">
            <a href="/dashboard" class="active">
                <i class="bi bi-grid"></i> Dashboard
            </a>

            <a href="#">
                <i class="bi bi-box-seam"></i> Data Asset
            </a>

            <a href="#">
                <i class="bi bi-building"></i> Department
            </a>

            <a href="#">
                <i class="bi bi-file-earmark-text"></i> Report
            </a>
        </nav>

        <div class="position-absolute bottom-0 start-0 w-100 p-4">
            <div class="sidebar-divider"></div>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

        <!-- Hero -->
        <section class="hero-card">

            <span class="hero-badge">
                PT INTI (Persero)
            </span>

            <h2 class="hero-title mt-4">
                Asset Management Dashboard
            </h2>

            <div class="hero-info mt-4">

                <div class="hero-item">
                    <i class="bi bi-calendar3"></i>
                    <span id="todayDate"></span>
                </div>

            </div>

        </section>

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

        <!-- Table -->
        <div class="card table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-0">Asset Inventory</h5>
                    <small class="text-muted">xxx</small>
                </div>

                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Asset
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Asset ID</th>
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
                                <td>{{ $asset->asset_name }}</td>
                                <td>{{ $asset->department }}</td>
                                <td>{{ $asset->location }}</td>
                                <td>
                                    @if($asset->status == 'Active')
                                        <span class="badge-active">Active</span>
                                    @elseif($asset->status == 'Maintenance')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                            Maintenance
                                        </span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAssetModal{{ $asset->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $asset->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade"
                                id="deleteModal{{ $asset->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow">
                                        <div class="modal-header border-0 pb-0">
                                            <h4 class="modal-title fw-bold text-danger">
                                                <i class="bi bi-trash3-fill me-2"></i>
                                                Delete Asset
                                            </h4>
                                            <button
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                            </button>
                                        </div>

                                        <div class="modal-body text-center py-4">
                                            <div class="mb-3">
                                                <div class="delete-icon">
                                                    <i class="bi bi-exclamation-lg"></i>
                                                </div>
                                            </div>
                                            <h5 class="fw-semibold">
                                                Delete Asset
                                            </h5>
                                            <p class="text-secondary mb-1">
                                                You are about to delete this asset.
                                            </p>
                                            <div class="asset-preview mt-3">
                                                <strong>{{ $asset->asset_name }}</strong>
                                            </div>
                                            <small class="text-danger">
                                                This action cannot be undone.
                                            </small>
                                        </div>

                                        <div class="modal-footer border-0 justify-content-center">
                                            <button
                                                class="btn btn-light px-4"
                                                data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <form
                                                action="{{ route('assets.destroy',$asset->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger px-4">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Edit Asset</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="/assets/{{ $asset->id }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Asset Code</label>
                                                    <input type="text" name="asset_code" class="form-control" value="{{ $asset->asset_code }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Asset Name</label>
                                                    <input type="text" name="asset_name" class="form-control" value="{{ $asset->asset_name }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Department</label>
                                                    <input type="text" name="department" class="form-control" value="{{ $asset->department }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Location</label>
                                                    <input type="text" name="location" class="form-control" value="{{ $asset->location }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Status</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="Active" {{ $asset->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Maintenance" {{ $asset->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                        <option value="Inactive" {{ $asset->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
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
        </div>

        <!-- Add Asset Modal -->
        <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addAssetModalLabel">Add New Asset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="/assets" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Asset Code</label>
                                <input type="text" name="asset_code" class="form-control" placeholder="Example: AST004" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Asset Name</label>
                                <input type="text" name="asset_name" class="form-control" placeholder="Example: Laptop Dell Latitude" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Department</label>
                                <input type="text" name="department" class="form-control" placeholder="Example: IT Support" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Location</label>
                                <input type="text" name="location" class="form-control" placeholder="Example: Gedung INTI Lt. 2" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-main">Save Asset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="text-center mt-4">
            <small class="text-muted">
                © 2026 • Designed & Developed by
                <a href="https://github.com/supgeesashere" target="_blank">
                    <i class="bi bi-github me-1"></i>supgeesashere
                </a>
            </small>
        </footer>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>

    <script>
    function updateDate(){
        const now = new Date();
        const options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "2-digit"
        };
        document.getElementById("todayDate").textContent =
            now.toLocaleDateString("en-US", options);
    }

    updateDate();
    setInterval(updateDate, 60000);
    </script>

</body>
</html>