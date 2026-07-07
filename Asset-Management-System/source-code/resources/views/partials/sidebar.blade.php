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
