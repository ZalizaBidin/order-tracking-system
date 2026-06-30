<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OrderTrack PWA' }}</title>

    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .app-navbar {
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
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

        .bottom-nav {
            display: none;
        }

        @media (max-width: 768px) {
            .desktop-sidebar {
                display: none;
            }

            .bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #dee2e6;
                z-index: 1000;
            }

            .bottom-nav a {
                flex: 1;
                text-align: center;
                padding: 9px 4px;
                text-decoration: none;
                color: #6c757d;
                font-size: 12px;
            }

            .bottom-nav a i {
                display: block;
                font-size: 20px;
            }

            main {
                padding-bottom: 80px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark app-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="bi bi-bag-check-fill me-1"></i> OrderTrack
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="topNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <span class="nav-link">
                            {{ auth()->user()->name ?? '' }}
                            @auth
                            <span class="badge bg-light text-primary ms-1">{{ ucfirst(auth()->user()->role) }}</span>
                            @endauth
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-light btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
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
            <i class="bi bi-house"></i> Home
        </a>
        <a href="{{ route('customer.orders.index') }}">
            <i class="bi bi-list-check"></i> Orders
        </a>
        <a href="{{ route('customer.orders.create') }}">
            <i class="bi bi-plus-circle"></i> Create
        </a>
    </div>
    @else
    <div class="bottom-nav">
        <a href="{{ route('shopper.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Home
        </a>
        <a href="{{ route('shopper.orders.index') }}">
            <i class="bi bi-bag"></i> Orders
        </a>
    </div>
    @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
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
            text: "{{ session('error') }}",
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @stack('scripts')

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(() => console.log('Service Worker registered'))
                .catch(error => console.log('Service Worker failed:', error));
        }
    </script>

    @stack('scripts')
</body>

</html>