<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OrderTrack PWA' }}</title>

    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            width: 100%;
            max-width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            background: #f5f7fb;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #212529;
        }

        a {
            text-decoration: none;
        }

        .app-navbar {
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .navbar-brand {
            font-size: 1.1rem;
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, .9) !important;
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding-left: 0;
        }

        .card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 18px;
        }

        .card-body {
            padding: 20px;
        }

        .summary-card {
            color: white;
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

        .form-control,
        .form-select {
            border-radius: 10px;
            min-height: 42px;
        }

        textarea.form-control {
            min-height: 100px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
        }

        .btn-sm {
            border-radius: 8px;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            white-space: nowrap;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .bottom-nav {
            display: none;
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

        @media (max-width: 768px) {
            body {
                font-size: 14px;
            }

            main.container {
                padding-left: 14px;
                padding-right: 14px;
                padding-top: 18px !important;
                padding-bottom: 95px !important;
            }

            .navbar .container {
                padding-left: 14px;
                padding-right: 14px;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .navbar-collapse {
                margin-top: 12px;
            }

            .navbar-nav {
                gap: 8px;
            }

            .navbar-nav .nav-link {
                padding-left: 0;
            }

            main h3 {
                font-size: 1.25rem;
            }

            main p {
                font-size: 0.9rem;
            }

            main>.d-flex.justify-content-between {
                flex-direction: column;
                align-items: stretch !important;
            }

            main>.d-flex.justify-content-between .btn {
                width: 100%;
            }

            .card {
                border-radius: 14px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
            }

            .card-header .btn {
                width: 100%;
            }

            .card-body {
                padding: 16px;
            }

            .summary-card .card-body {
                min-height: 110px;
            }

            .summary-card h6 {
                font-size: 0.8rem;
            }

            .summary-card h2 {
                font-size: 1.6rem;
            }

            .summary-card .icon {
                font-size: 34px;
                right: 14px;
                top: 14px;
            }

            .row {
                row-gap: 14px;
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

            .alert {
                font-size: 14px;
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
                padding: 9px 4px;
                text-decoration: none;
                color: #6c757d;
                font-size: 11px;
                font-weight: 500;
            }

            .bottom-nav a i {
                display: block;
                font-size: 19px;
                margin-bottom: 2px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="bi bi-bag-check-fill me-1"></i> OrderTrack
            </a>

            @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar"
                aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endauth

            @auth
            <div class="collapse navbar-collapse" id="topNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <span class="nav-link">
                            {{ auth()->user()->name ?? '' }}
                            <span class="badge bg-light text-primary ms-1">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
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

    {{-- TEMPORARY: Disable old PWA cache so phone will not use old UI --}}
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