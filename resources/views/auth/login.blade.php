<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | OrderTrack PWA</title>

    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #eaf2ff 0%, #f8fafc 45%, #e0ecff 100%);
            font-family: Arial, sans-serif;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 1100px;
            min-height: 620px;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.18);
        }

        .login-left {
            min-height: 620px;
            background: linear-gradient(160deg, #0d6efd, #052c65);
            color: #ffffff;
            padding: 55px 45px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            right: -90px;
            top: -70px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.10);
            border-radius: 50%;
            left: -70px;
            bottom: -60px;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .brand-icon {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 28px;
        }

        .main-title {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 18px;
        }

        .main-desc {
            font-size: 16px;
            line-height: 1.7;
            opacity: .9;
            max-width: 430px;
        }

        .feature-list {
            margin-top: 45px;
        }

        .feature-item {
            display: flex;
            gap: 14px;
            margin-bottom: 22px;
        }

        .feature-item .icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .feature-item h6 {
            font-weight: 700;
            margin-bottom: 3px;
        }

        .feature-item p {
            margin: 0;
            opacity: .82;
            font-size: 14px;
            line-height: 1.5;
        }

        .login-right {
            min-height: 620px;
            padding: 55px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6b7280;
            margin-bottom: 32px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            height: 52px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            color: #6b7280;
        }

        .input-group .form-control {
            border-left: 0;
            border-radius: 0 14px 14px 0;
        }

        .btn-login {
            height: 52px;
            border-radius: 14px;
            border: 0;
            font-weight: 700;
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0b5ed7, #052c65);
        }

        .demo-box {
            background: #f3f7ff;
            border: 1px solid #dbeafe;
            border-radius: 18px;
            padding: 18px;
            margin-top: 24px;
        }

        .demo-box h6 {
            color: #084298;
            font-weight: 800;
        }

        .demo-account {
            font-size: 13px;
            color: #374151;
            margin-bottom: 6px;
            word-break: break-word;
        }

        .demo-account code {
            background: #ffffff;
            color: #0d6efd;
            padding: 3px 6px;
            border-radius: 6px;
        }

        .invalid-feedback {
            display: block;
        }

        @media (max-width: 991px) {
            .login-card {
                max-width: 560px;
            }

            .login-left {
                min-height: auto;
                padding: 38px 30px;
            }

            .login-right {
                min-height: auto;
                padding: 38px 30px;
            }

            .main-title {
                font-size: 32px;
            }

            .feature-list {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-page {
                padding: 0;
            }

            .login-card {
                border-radius: 0;
                min-height: 100vh;
            }

            .login-left {
                padding: 30px 24px;
            }

            .login-right {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="login-card">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="login-left">
                        <div class="left-content">
                            <div class="brand-icon">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>

                            <h1 class="main-title">
                                Order Tracking<br>
                                Progressive Web App
                            </h1>

                            <p class="main-desc">
                                A responsive and installable system for customers and personal shoppers
                                to manage orders, monitor progress, and receive real-time updates.
                            </p>

                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-phone"></i></div>
                                    <div>
                                        <h6>Mobile Friendly</h6>
                                        <p>Works smoothly on desktop, tablet, and mobile devices.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-wifi-off"></i></div>
                                    <div>
                                        <h6>PWA Support</h6>
                                        <p>Installable web application with offline fallback support.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                                    <div>
                                        <h6>Progress Monitoring</h6>
                                        <p>Track order status from pending until completed.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-shield-check"></i></div>
                                    <div>
                                        <h6>Secure Access</h6>
                                        <p>Role-based login for customer and personal shopper.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="login-right">
                        <h2 class="form-title">Welcome Back</h2>
                        <p class="form-subtitle">Please login to continue to your dashboard.</p>

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter your email"
                                        required
                                        autofocus
                                        autocomplete="username">
                                </div>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password"
                                        required
                                        autocomplete="current-password">
                                </div>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                </div>

                                @if (Route::has('password.request'))
                                <a class="small fw-semibold text-decoration-none" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-login w-100">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Login
                            </button>
                        </form>

                        <div class="demo-box">
                            <h6 class="mb-2">
                                <i class="bi bi-person-badge me-1"></i>
                                Demo Accounts
                            </h6>

                            <div class="demo-account">
                                Customer:
                                <code>customer@demo.com</code>
                                /
                                <code>password123</code>
                            </div>

                            <div class="demo-account">
                                Personal Shopper:
                                <code>shopper@demo.com</code>
                                /
                                <code>password123</code>
                            </div>
                        </div>

                   

                        @if (Route::has('register'))
                        <div class="text-center mt-3">
                            <span class="text-muted">Do not have an account?</span>
                            <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">
                                Register here
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(() => console.log('Service Worker registered'))
                .catch(error => console.log('Service Worker failed:', error));
        }
    </script>
</body>

</html>