<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | OrderTrack PWA</title>

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

        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .register-card {
            width: 100%;
            max-width: 1100px;
            min-height: 650px;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.18);
        }

        .register-left {
            min-height: 650px;
            background: linear-gradient(160deg, #0d6efd, #052c65);
            color: #ffffff;
            padding: 55px 45px;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            right: -90px;
            top: -70px;
        }

        .register-left::after {
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

        .register-right {
            min-height: 650px;
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
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control,
        .form-select {
            height: 52px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .12);
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

        .btn-register {
            height: 52px;
            border-radius: 14px;
            border: 0;
            font-weight: 700;
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #0b5ed7, #052c65);
        }

        .info-box {
            background: #f3f7ff;
            border: 1px solid #dbeafe;
            border-radius: 18px;
            padding: 16px;
            margin-top: 22px;
            font-size: 13px;
            color: #374151;
        }

        .info-box strong {
            color: #084298;
        }

        .invalid-feedback {
            display: block;
        }

        @media (max-width: 991px) {
            .register-card {
                max-width: 560px;
            }

            .register-left {
                min-height: auto;
                padding: 38px 30px;
            }

            .register-right {
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
            .register-page {
                padding: 0;
            }

            .register-card {
                border-radius: 0;
                min-height: 100vh;
            }

            .register-left {
                padding: 30px 24px;
            }

            .register-right {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="register-page">
        <div class="register-card">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="register-left">
                        <div class="left-content">
                            <div class="brand-icon">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>

                            <h1 class="main-title">
                                Create Your<br>
                                OrderTrack Account
                            </h1>

                            <p class="main-desc">
                                Register as a customer to create orders and monitor progress.
                                Personal shopper accounts can manage orders, update status, and view productivity summary.
                            </p>

                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-bag-plus"></i></div>
                                    <div>
                                        <h6>Create Orders</h6>
                                        <p>Customers can submit order requests with item details and estimated budget.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-clock-history"></i></div>
                                    <div>
                                        <h6>Track Progress</h6>
                                        <p>Monitor order movement from pending until completed.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <h6>Role-Based Access</h6>
                                        <p>Different dashboards for customer and personal shopper.</p>
                                    </div>
                                </div>

                                <div class="feature-item">
                                    <div class="icon"><i class="bi bi-phone"></i></div>
                                    <div>
                                        <h6>PWA Ready</h6>
                                        <p>Responsive, installable, and suitable for mobile usage.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="register-right">
                        <h2 class="form-title">Register Account</h2>
                        <p class="form-subtitle">Fill in your details to create a new account.</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter your full name"
                                        required
                                        autofocus
                                        autocomplete="name">
                                </div>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
                                        autocomplete="username">
                                </div>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Role selection --}}
                            <div class="mb-3">
                                <label for="role" class="form-label">Register As</label>
                                <select
                                    id="role"
                                    name="role"
                                    class="form-select @error('role') is-invalid @enderror"
                                    required>
                                    <option value="">-- Select Role --</option>
                                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                                        Customer
                                    </option>
                                    <option value="shopper" {{ old('role') == 'shopper' ? 'selected' : '' }}>
                                        Personal Shopper
                                    </option>
                                </select>
                                @error('role')
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
                                        placeholder="Create your password"
                                        required
                                        autocomplete="new-password">
                                </div>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Re-enter your password"
                                        required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-register w-100">
                                <i class="bi bi-person-check me-1"></i>
                                Create Account
                            </button>
                        </form>

                        <div class="info-box">
                            <strong>Note:</strong>
                            For demo purposes, customers can create and view their own orders,
                            while personal shoppers can view all orders and update order progress.
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                                Login here
                            </a>
                        </div>
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