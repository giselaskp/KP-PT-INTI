<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CRUD System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body style="--sidebar-bg-image: url('{{ asset('images/gedung_inti.png') }}'); --hero-bg-image: url('{{ asset('images/gedung.png') }}');">

    @include('partials.sidebar')

    <main class="main-content">

        @include('partials.alerts')

        @include('partials.hero')

        @include('partials.stats')

        @include('partials.asset-table')

        @include('partials.add-modal')

        @include('partials.footer')

    </main>

    @include('partials.logout-modal')

    @include('partials.scripts')

</body>
</html>
