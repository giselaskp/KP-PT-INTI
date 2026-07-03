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

        .auto-alert {
            animation: fadeAlert 4s ease forwards;
        }

        .modal-alert{
            border-radius:14px;
            font-size:15px;
            padding:14px 18px;
        }

        .modal-action-btn{
            min-width:130px;
            height:48px;
            border-radius:12px;
            font-weight:600;
        }

        @keyframes fadeAlert {
            0%{
                opacity: 1;
                transform: translateY(0);
            }

            75%{
                opacity: 1;
                transform: translateY(0);
            }

            100%{
                opacity: 0;
                transform: translateY(-12px);
            }
        }

        .search-box {
            position: relative;
            max-width: 300px;
            transition: all .25s ease;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 15px;
            z-index: 2;
            transition: all .25s ease;
        }

        .search-box input {
            height: 46px;
            border-radius: 12px;
            padding-left: 42px;
            border: 1px solid #E5E7EB;
            font-size: 14px;
            box-shadow: none;
            transition: all .25s ease;
            background: #fff;
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(47,99,199,.12);
            border-color: #2F63C7;
        }

        .search-box:focus-within i {
            color: #2F63C7;
        }

        .search-box:hover input {
            border-color:#5C8FF5;
            box-shadow: 0 8px 22px rgba(47,99,199,.12);
        }

        .search-box:hover i {
            color:#2F63C7;
        }

        .clear-search {
            position:absolute;
            right:10px;
            top:50%;
            transform:translateY(-50%);
            width:34px;
            height:34px;
            border:none;
            border-radius:50%;
            background:#F1F5F9;
            color:#2563EB;
            display:none;
            align-items:center;
            justify-content:center;
            font-size:14px;
            line-height: 1;
            cursor: pointer;
            z-index: 3;
            transition: .25s ease;
        }

        .clear-search i {
            position: static;
            transform: none;
            color: inherit;
            font-size: 14px;
        }

        .clear-search:hover {
            background: #E0ECFF;
            color: #214A9B;
        }

        .search-box input {
            padding-right: 52px;
        }

        .btn-main {
            background: linear-gradient(135deg,  #214A9B 0%, #2F63C7 55%, #5C8FF5 100%);
            color: white;
            border: none;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            pointer-events: none;
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

        .btn-delete{
            background:linear-gradient(135deg, #B91C1C, #DC2626, #EF4444);
            color:white;
            border:none;
            transition:.3s ease;
        }

        .btn-delete:hover{
            background:linear-gradient(135deg, #991B1B, #B91C1C, #DC2626);
            color:white;
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(220,38,38,.22);
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

        .pagination-wrapper {
            display:flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 24px;
            gap: 18px;
        }

        .pagination-info {
            color: #64748B;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .pagination-links {
            margin-left: auto;
        }

        .pagination {
            margin: 0;
        }

        .page-link{
            color:#214A9B;
            border-radius:10px !important;
            margin:0 4px;
            border:1px solid #E2E8F0;
            transition:.25s;
        }

        .page-link:hover{
            background:#EEF4FF;
            border-color:#2F63C7;
            color:#214A9B;
        }

        .page-item.active .page-link{
            background:linear-gradient(
                135deg,
                #214A9B,
                #2F63C7,
                #5C8FF5
            );

            border:none;
            color:white;
        }

        .page-item.disabled .page-link{
            background:#F8FAFC;
            color:#94A3B8;
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
            .pagination-wrapper {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: nowrap;
            }

            .pagination-info {
                font-size: 14px;
                white-space: nowrap;
            }

            .pagination {
                margin-left: auto;
            }

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

        <nav class="sidebar-menu">
            <a href="/dashboard" class="active">
                <i class="bi bi-box-seam"></i>
                Asset Inventory
            </a>
        </nav>

        <div class="position-absolute bottom-0 start-0 w-100 p-4">
            <div class="sidebar-divider"></div>

            <button
                type="button"
                class="logout-btn"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-left"></i>
                Logout
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show auto-alert" role="alert">
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
                <div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4">

                            <form action="{{ route('assets.update', $asset->id) }}" method="POST" class="asset-form" data-asset-id="{{ $asset->id }}" novalidate>
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
                <div class="modal fade" id="deleteModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
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
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST">
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

        </div>

        <!-- Add Asset Modal -->
        <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addAssetModalLabel">Add New Asset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('assets.store') }}" method="POST" class="asset-form" novalidate>
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-main">Save Asset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade"
            id="logoutModal"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title fw-bold">
                            Logout
                        </h4>
                        <button
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body text-center py-4">
                        <h5 class="fw-semibold">
                            Logout Session?
                        </h5>
                        <p class="text-secondary mb-0">
                            Are you sure you want to logout from your account?
                        </p>
                    </div>

                    <div class="modal-footer border-0 justify-content-center">
                        <button
                            type="button"
                            class="btn btn-light modal-action-btn"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="/logout" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-main modal-action-btn">
                                Logout
                            </button>
                        </form>
                    </div>
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

    <script>
        const searchInput = document.getElementById("searchInput");
        const clearSearch = document.getElementById("clearSearch");
        const assetTableArea = document.getElementById("assetTableArea");

        let searchTimer;

        function toggleClearButton() {
            clearSearch.style.display = searchInput.value ? "flex" : "none";
        }

        function loadAssets(url) {
            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const newTable = doc.getElementById("assetTableArea");

                if (newTable) {
                    assetTableArea.innerHTML = newTable.innerHTML;
                }
            });
        }

        searchInput.addEventListener("input", function () {
            clearTimeout(searchTimer);

            const keyword = this.value.trim();
            const url = keyword
                ? `/dashboard?search=${encodeURIComponent(keyword)}`
                : `/dashboard`;

            toggleClearButton();

            searchTimer = setTimeout(() => {
                loadAssets(url);
                window.history.replaceState({}, "", url);
                searchInput.focus();
            }, 250);
        });

        clearSearch.addEventListener("click", function () {
            searchInput.value = "";
            toggleClearButton();

            loadAssets("/dashboard");
            window.history.replaceState({}, "", "/dashboard");
            searchInput.focus();
        });

        document.addEventListener("click", function (e) {
            const pageLink = e.target.closest(".pagination a");

            if (pageLink) {
                e.preventDefault();
                loadAssets(pageLink.href);
                window.history.replaceState({}, "", pageLink.href);
                searchInput.focus();
            }
        });

        toggleClearButton();
    </script>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.auto-alert').forEach(alert => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            });
        }, 4200);
    </script>

    <script>
        const assetCodes = @json($assetCodes);

        document.querySelectorAll('.asset-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const alertBox = form.querySelector('.modal-alert');
                const assetCodeInput = form.querySelector('[name="asset_code"]');

                let message = '';
                let firstInvalidField = null;

                form.querySelectorAll('[required]').forEach(field => {
                    const label = field.dataset.label || field.name;

                    if (!message && field.value.trim() === '') {
                        message = `${label} wajib diisi.`;
                        firstInvalidField = field;
                    }

                    if (!message && field.maxLength > 0 && field.value.length > field.maxLength) {
                        message = `${label} maksimal ${field.maxLength} karakter.`;
                        firstInvalidField = field;
                    }
                });

                const assetCode = assetCodeInput.value.trim();
                const currentId = form.dataset.assetId || null;

                Object.entries(assetCodes).forEach(([id, code]) => {
                    if (!message && code.toLowerCase() === assetCode.toLowerCase() && id !== currentId) {
                        message = 'Asset Code sudah digunakan. Silakan gunakan kode lain.';
                        firstInvalidField = assetCodeInput;
                    }
                });

                if (message) {
                    e.preventDefault();
                    alertBox.textContent = message;
                    alertBox.classList.remove('d-none');

                    if (firstInvalidField) {
                        firstInvalidField.focus();
                    }
                }
            });
        });
    </script>

</body>
</html>
