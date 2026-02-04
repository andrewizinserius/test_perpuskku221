<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Perpustakaan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top,
                    #0a2540,
                    #06182c,
                    #020b17);
            overflow: hidden;
        }

        /* efek cahaya laut */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 70% 30%,
                    rgba(0, 255, 200, 0.15),
                    transparent 40%);
            animation: floatLight 8s ease-in-out infinite alternate;
        }

        @keyframes floatLight {
            from { transform: translateY(0); }
            to { transform: translateY(-30px); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            border: 1px solid rgba(0, 255, 200, 0.25);
            box-shadow: 0 0 40px rgba(0, 255, 200, 0.15);
            color: #e0f7fa;
        }

        .form-control {
            border-radius: 14px;
            padding-left: 45px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #e0f7fa;
        }

        .form-control::placeholder {
            color: #b2ebf2;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 200, 0.25);
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #7fffd4;
        }

        .form-group {
            position: relative;
        }

        .btn-login {
            border-radius: 14px;
            font-weight: 600;
            padding: 10px;
            background: linear-gradient(135deg, #00e5ff, #00bfa5);
            border: none;
            color: #00363a;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 200, 0.35);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7fffd4;
        }

        a {
            color: #64ffda;
        }

        a:hover {
            color: #1de9b6;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 position-relative">

    <div class="card login-card p-4" style="width: 100%; max-width: 420px; z-index: 1;">
        <div class="card-body">

            <h3 class="text-center fw-bold mb-1">🌊 Selamat Datang</h3>
            <p class="text-center text-muted mb-4">
                Sistem Informasi Perpustakaan Laut Dalam
            </p>

            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3 form-group">
                    <i class="bi bi-person-fill input-icon"></i>
                    <input
                        type="text"
                        name="username"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="Username"
                        value="{{ old('username') }}"
                        required
                    >
                </div>

                <div class="mb-4 form-group">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        required
                    >
                    <i class="bi bi-eye toggle-password" onclick="togglePassword(event)"></i>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </button>
            </form>

            <hr class="my-4 border-light">

            <p class="text-center mb-0">
                Belum punya akun?
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">
                    Daftar di sini
                </a>
            </p>

        </div>
    </div>

    <script>
        function togglePassword(event) {
            const password = document.getElementById('password');
            const icon = event.target;

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>
