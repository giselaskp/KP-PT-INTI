<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CRUD System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .asset-table{
            width: 100%;
            table-layout: fixed;
        }

        .asset-table th,
        .asset-table td{
            vertical-align: middle;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .asset-table th:nth-child(1),
        .asset-table td:nth-child(1){
            width: 10%;
        }

        .asset-table th:nth-child(2),
        .asset-table td:nth-child(2){
            width: 9%;
        }

        .asset-table th:nth-child(3),
        .asset-table td:nth-child(3){
            width: 23%;
        }

        .asset-table th:nth-child(4),
        .asset-table td:nth-child(4){
            width: 16%;
        }

        .asset-table th:nth-child(5),
        .asset-table td:nth-child(5){
            width: 17%;
        }

        .asset-table th:nth-child(6),
        .asset-table td:nth-child(6){
            width: 15%;
        }

        .asset-table th:nth-child(7),
        .asset-table td:nth-child(7){
            width: 12%;
        }

        .asset-table td:nth-child(6),
        .asset-table th:nth-child(6){
            text-align: center;
        }

        .badge-status{
            min-width: 110px;
            display: inline-flex;
            justify-content: center;
        }

        .asset-img,
        .asset-img-placeholder{
            width: 52px;
            height: 52px;
            border-radius: 14px;
            object-fit: cover;
        }

        .asset-img{
            border: 1px solid #E2E8F0;
        }

        .asset-img-placeholder{
            background: #F1F5F9;
            color: #94A3B8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .upload-box{
            border:2px dashed #CBD5E1;
            border-radius:18px;
            height:220px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            cursor:pointer;
            color:#64748B;
            transition:.3s;
            background:#F8FAFC;
            text-align:center;
        }

        .upload-box:hover,
        .upload-box.dragover{
            border-color:#2563EB;
            background:#EFF6FF;
        }

        .upload-box i{
            font-size:48px;
            color:#2563EB;
            margin-bottom:15px;
        }

        .upload-box h5{
            font-size:18px;
            font-weight:700;
            color:#1F2937;
            margin-bottom:6px;
        }

        .upload-box p{
            font-size:15px;
            color:#64748B;
            margin-bottom:0;
        }

        .upload-box small{
            color: #64748B;
        }

        .upload-box input{
            display: none;
        }

        .uploaded-image-wrapper{
            position:relative;
            width:320px;
            height:220px;
            margin:auto;
            border-radius:18px;
            overflow:hidden;
            border:1px solid #E2E8F0;
            background:#F8FAFC;
        }

        .uploaded-image{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }

        .image-overlay{
            position:absolute;
            inset:0;
            background:rgba(15,23,42,.60);
            opacity:0;
            transition:.3s ease;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            gap:14px;
        }

        .uploaded-image-wrapper:hover .image-overlay{
            opacity:1;
        }

        .change-image{
            color:white;
            cursor:pointer;
            text-align:center;
            font-size:17px;
            font-weight:700;
            text-decoration:none;
        }

        .change-image i{
            display:block;
            font-size:40px;
            margin-bottom:10px;
        }

        .remove-image{
            background:#EF4444;
            color:white;
            border:none;
            border-radius:10px;
            padding:8px 18px;
            font-weight:600;
            transition:.25s ease;
        }

        .remove-image:hover{
            background:#DC2626;
            transform:translateY(-1px);
        }

        .upload-box{
            border:2px dashed #CBD5E1;
            border-radius:18px;
            height:220px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            cursor:pointer;
            color:#64748B;
            transition:.3s;
        }

        .upload-box:hover{
            border-color:#2563EB;
            background:#EFF6FF;
        }

        .upload-box i{
            font-size:48px;
            color:#2563EB;
            margin-bottom:15px;
        }

        .clickable-image{
            cursor:pointer;
            transition:.25s ease;
        }

        .clickable-image:hover{
            transform:scale(1.08);
            box-shadow:0 8px 18px rgba(15,23,42,.16);
        }

        .large-image-preview{
            max-width:100%;
            max-height:70vh;
            object-fit:contain;
            border-radius:16px;
            border:1px solid #E2E8F0;
            background:#F8FAFC;
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

        .current-image,
        .image-preview{

            width:220px;
            height:160px;

            display:block;
            margin:0 auto;

            object-fit:cover;

            border-radius:12px;
            border:1px solid #E2E8F0;

            background:#F8FAFC;
        }

        .edit-preview-wrapper,
        .add-preview-wrapper{
            text-align:center;
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

    @include('partials.sidebar')

    <main class="main-content">

        @include('partials.alerts')

        @include('partials.hero')

        @include('partials.stats')

        @include('partials.asset-table')

        @include('partials.add-modal')

        @include('partials.logout-modal')

        @include('partials.footer')

    </main>

    @include('partials.scripts')

</body>
</html>
