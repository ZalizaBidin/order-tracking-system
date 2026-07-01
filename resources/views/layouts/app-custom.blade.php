<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OrderTrack PWA' }}</title>

    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =========================================================
           BASE UI
        ========================================================= */

        html,
        body {
            width: 100%;
            max-width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #212529;
        }

        a {
            text-decoration: none;
        }

        .app-navbar {
            background: linear-gradient(135deg, #0d6efd, #084298);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.12);
        }

        .app-navbar-inner {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .app-brand {
            color: #ffffff !important;
            font-size: 1.15rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .app-user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-user-name {
            color: rgba(255, 255, 255, .95);
            font-weight: 500;
        }

        .app-role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            background: #ffffff;
            color: #0d6efd;
            font-size: 12px;
            font-weight: 700;
            margin-left: 4px;
        }

        .app-logout-btn {
            border: 1px solid #ffffff;
            background: #ffffff;
            color: #0d6efd;
            border-radius: 10px;
            padding: 7px 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        main.container {
            padding-top: 24px;
            padding-bottom: 90px;
        }

        .card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: #ffffff;
        }

        .card-header {
            padding: 16px 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .card-body {
            padding: 20px;
        }

        .summary-card {
            color: #ffffff;
            overflow: hidden;
            position: relative;
        }

        .summary-card .icon {
            font-size: 42px;
            opacity: .25;
            position: absolute;
            right: 18px;
            top: 18px;
        }

        .summary-card h6 {
            color: #ffffff;
            margin-bottom: 14px;
        }

        .summary-card h2 {
            color: #ffffff;
        }

        .status-badge {
            font-size: 12px;
            padding: 7px 10px;
            border-radius: 999px;
        }

        .timeline {
            border-left: 3px solid #dee2e6;
            padding-left: 18px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 18px;
        }

        .timeline-item::before {
            content: "";
            width: 14px;
            height: 14px;
            background: #0d6efd;
            border-radius: 50%;
            position: absolute;
            left: -26px;
            top: 5px;
        }

        .bottom-nav {
            display: none;
        }

        /* =========================================================
           BOOTSTRAP FALLBACK
           Ini penting kalau Bootstrap CDN tak load dalam phone/WhatsApp browser
        ========================================================= */

        .container {
            width: 100%;
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 16px;
            padding-right: 16px;
            box-sizing: border-box;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8px;
            margin-right: -8px;
        }

        .row>* {
            box-sizing: border-box;
            padding-left: 8px;
            padding-right: 8px;
        }

        .g-3 {
            row-gap: 16px;
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .col-md-3 {
            flex: 0 0 auto;
            width: 25%;
        }

        .col-md-4 {
            flex: 0 0 auto;
            width: 33.333333%;
        }

        .col-md-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .col-md-8 {
            flex: 0 0 auto;
            width: 66.666667%;
        }

        .bg-primary {
            background: linear-gradient(135deg, #0d6efd, #084298) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107, #d39e00) !important;
        }

        .bg-info {
            background: linear-gradient(135deg, #0dcaf0, #087990) !important;
        }

        .bg-success {
            background: linear-gradient(135deg, #198754, #0f5132) !important;
        }

        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #842029) !important;
        }

        .bg-white {
            background-color: #ffffff !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #198754 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #0dcaf0 !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fw-medium {
            font-weight: 500 !important;
        }

        .d-flex {
            display: flex !important;
        }

        .d-block {
            display: block !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .justify-content-end {
            justify-content: flex-end !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .align-middle {
            vertical-align: middle !important;
        }

        .gap-2 {
            gap: .5rem !important;
        }

        .gap-3 {
            gap: 1rem !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .mb-2 {
            margin-bottom: .5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mt-2 {
            margin-top: .5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .me-1 {
            margin-right: .25rem !important;
        }

        .ms-1 {
            margin-left: .25rem !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .h-100 {
            height: 100% !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            font-size: .95rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: center;
            text-decoration: none !important;
            vertical-align: middle;
            cursor: pointer;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: .2s ease;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: .85rem;
            border-radius: 8px;
        }

        .btn-primary {
            color: #ffffff !important;
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .btn-success {
            color: #ffffff !important;
            background-color: #198754 !important;
            border-color: #198754 !important;
        }

        .btn-danger {
            color: #ffffff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-light {
            color: #212529 !important;
            background-color: #f8f9fa !important;
            border-color: #f8f9fa !important;
        }

        .btn-outline-primary {
            color: #0d6efd !important;
            background-color: transparent !important;
            border-color: #0d6efd !important;
        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #0d6efd !important;
        }

        .badge {
            display: inline-block;
            padding: .35em .65em;
            font-size: .75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            border-radius: 999px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            display: block;
            width: 100%;
            padding: 10px 12px;
            min-height: 42px;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 10px;
            box-sizing: border-box;
        }

        textarea.form-control {
            min-height: 100px;
        }

        .invalid-feedback {
            display: block;
            margin-top: 4px;
            color: #dc3545;
            font-size: 13px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background: #f8d7da;
            color: #842029;
        }

        .alert-info {
            background: #cff4fc;
            color: #055160;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .table th,
        .table td {
            padding: 12px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: middle;
        }

        .table th {
            font-weight: 700;
            color: #475569;
        }

        main>.d-flex.justify-content-between {
            flex-wrap: wrap;
            gap: 12px;
        }

        main>.d-flex.justify-content-between>div {
            min-width: 0;
        }

        main h3 {
            font-size: 1.45rem;
        }

        /* =========================================================
           MOBILE UI
        ========================================================= */

        @media (max-width: 768px) {
            body {
                font-size: 14px;
            }

            .container {
                max-width: 100%;
                padding-left: 14px;
                padding-right: 14px;
            }

            main.container {
                padding-top: 22px !important;
                padding-bottom: 95px !important;
            }

            .app-navbar-inner {
                display: block;
                padding: 14px 16px;
            }

            .app-brand {
                font-size: 1.3rem;
                margin-bottom: 12px;
            }

            .app-user-area {
                display: block;
            }

            .app-user-name {
                display: block;
                margin-bottom: 8px;
                font-size: 1rem;
            }

            .app-role-badge {
                margin-left: 6px;
            }

            .app-logout-btn {
                display: inline-block;
                padding: 8px 14px;
                border-radius: 10px;
            }

            main h3 {
                font-size: 1.4rem;
                line-height: 1.3;
            }

            main p {
                font-size: 0.95rem;
            }

            main>.d-flex.justify-content-between {
                display: block !important;
            }

            main>.d-flex.justify-content-between .btn {
                width: 100%;
                margin-top: 12px;
            }

            .row {
                margin-left: -7px;
                margin-right: -7px;
            }

            .row>* {
                padding-left: 7px;
                padding-right: 7px;
            }

            .col-md-3,
            .col-md-4,
            .col-md-6,
            .col-md-8 {
                width: 100%;
            }

            .col-6 {
                width: 50%;
            }

            .card {
                border-radius: 14px;
            }

            .card-header {
                display: block !important;
                padding: 15px 16px;
            }

            .card-header .btn {
                width: 100%;
                margin-top: 10px;
            }

            .card-body {
                padding: 16px;
            }

            .summary-card {
                min-height: 125px;
            }

            .summary-card .card-body {
                padding: 18px;
                min-height: 125px;
            }

            .summary-card h6 {
                font-size: .85rem;
                margin-bottom: 18px;
            }

            .summary-card h2 {
                font-size: 1.9rem;
                margin-bottom: 0;
            }

            .summary-card .icon {
                font-size: 34px;
                right: 14px;
                top: 14px;
            }

            .form-control,
            .form-select {
                font-size: 14px;
            }

            .btn {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .table {
                font-size: 13px;
            }

            .table .btn {
                padding: 6px 10px;
                font-size: 12px;
            }

            .bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: #ffffff;
                border-top: 1px solid #dee2e6;
                z-index: 1050;
                padding-bottom: env(safe-area-inset-bottom);
                box-shadow: 0 -6px 18px rgba(15, 23, 42, 0.08);
            }

            .bottom-nav a {
                flex: 1;
                text-align: center;
                padding: 10px 4px;
                text-decoration: none;
                color: #6c757d;
                font-size: 12px;
                font-weight: 500;
            }

            .bottom-nav a i {
                display: block;
                font-size: 20px;
                margin-bottom: 2px;
            }
        }
    </style>
</head>

<body>
    <nav class="app-navbar">
        <div class="app-navbar-inner">
            <a class="app-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-bag-check-fill"></i>
                OrderTrack
            </a>

            @auth
            <div class="app-user-area">
                <div class="app-user-name">
                    {{ auth()->user()->name ?? '' }}

                    <span class="app-role-badge">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="app-logout-btn">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    @auth
    @if(auth()->user()->role === 'customer')
    <div class="bottom-nav">
        <a href="{{ route('customer.dashboard') }}">
            <i class="bi bi-house"></i>
            Home
        </a>

        <a href="{{ route('customer.orders.index') }}">
            <i class="bi bi-list-check"></i>
            Orders
        </a>

        <a href="{{ route('customer.orders.create') }}">
            <i class="bi bi-plus-circle"></i>
            Create
        </a>
    </div>
    @else
    <div class="bottom-nav">
        <a href="{{ route('shopper.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            Home
        </a>

        <a href="{{ route('shopper.orders.index') }}">
            <i class="bi bi-bag"></i>
            Orders
        </a>
    </div>
    @endif
    @endauth

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json(session('error')),
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @stack('scripts')

    {{-- TEMPORARY: Clear old PWA/service worker cache --}}
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for (let registration of registrations) {
                    registration.unregister();
                }
            });
        }

        if ('caches' in window) {
            caches.keys().then(function(names) {
                for (let name of names) {
                    caches.delete(name);
                }
            });
        }
    </script>
</body>

</html>