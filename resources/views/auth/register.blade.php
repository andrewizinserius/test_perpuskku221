<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Perpustakaan</title>

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
            color: #ffffff;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 70% 30%,
                    rgba(0, 255, 200, 0.15),
                    transparent 40%);
            animation: floatLight 10s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes floatLight {
            from { transform: translateY(0); }
            to { transform: translateY(-40px); }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            border: 1px solid rgba(0, 255, 200, 0.25);
            box-shadow: 0 0 45px rgba(0, 255, 200, 0.18);
            color: #ffffff;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            padding-left: 45px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #cffff4;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 200, 0.25);
            color: #ffffff;
        }

        .form-select option {
            color: #000;
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

        .btn-register {
            border-radius: 16px;
            font-weight: 600;
            padding: 12px;
            background: linear-gradient(135deg, #00e5ff, #00bfa5);
            border: none;
            color: #00363a;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 255, 200, 0.35);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7fffd4;
        }

        .foto-preview {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            display: none;
            border: 2px solid #64ffda;
        }

        hr {
            border-color: rgba(255, 255, 255, 0.25);
        }

        a {
            color: #64ffda;
        }

        a:hover {
            color: #1de9b6;
        }

        .text-muted {
            color: #cffff4 !important;
        }

        label {
            color: #ffffff;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container position-relative" style="z-index:1">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">

                <div class="card register-card p-4">
                    <div class="card-body">

                        <h3 class="text-center fw-bold mb-1">🌊 Registrasi Anggota</h3>
                        <p class="text-center text-muted mb-4">
                            Sistem Informasi Perpustakaan Laut Dalam
                        </p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-person-fill input-icon"></i>
                                    <input type="text" name="nama_anggota" class="form-control"
                                        placeholder="Nama Lengkap" required>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-people-fill input-icon"></i>
                                    <select name="id_jenis_anggota" class="form-select" required>
                                        @foreach ($jenisAnggota as $jenis)
                                            @if ($jenis->id_jenis_anggota != 3)
                                                <option value="{{ $jenis->id_jenis_anggota }}">
                                                    {{ $jenis->jenis_anggota }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-geo-alt-fill input-icon"></i>
                                    <input type="text" name="tempat" class="form-control"
                                        placeholder="Tempat Lahir" required>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-calendar-event-fill input-icon"></i>
                                    <input type="date" name="tgl_lahir" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3 form-group">
                                    <i class="bi bi-house-fill input-icon"></i>
                                    <input type="text" name="alamat" class="form-control"
                                        placeholder="Alamat Lengkap" required>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-telephone-fill input-icon"></i>
                                    <input type="text" name="no_telp" class="form-control"
                                        placeholder="No. Telepon" required>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-envelope-fill input-icon"></i>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Email" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Foto (Opsional)</label>
                                    <input type="file" name="foto" class="form-control" onchange="previewFoto(event)">
                                    <img id="fotoPreview" class="foto-preview mt-2">
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-person-badge-fill input-icon"></i>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Username" required>
                                </div>

                                <div class="col-md-6 mb-3 form-group">
                                    <i class="bi bi-lock-fill input-icon"></i>
                                    <input type="password" id="password" name="password"
                                        class="form-control" placeholder="Password" required>
                                    <i class="bi bi-eye toggle-password"
                                        onclick="togglePassword('password', this)"></i>
                                </div>

                                <div class="col-md-12 mb-4 form-group">
                                    <i class="bi bi-lock-fill input-icon"></i>
                                    <input type="password" id="password_confirmation"
                                        name="password_confirmation" class="form-control"
                                        placeholder="Konfirmasi Password" required>
                                    <i class="bi bi-eye toggle-password"
                                        onclick="togglePassword('password_confirmation', this)"></i>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-register w-100">
                                <i class="bi bi-person-plus-fill me-1"></i> Daftar
                            </button>
                        </form>

                        <hr class="my-4">

                        <p class="text-center mb-0">
                            Sudah punya akun?
                            <a href="/login" class="fw-semibold text-decoration-none">
                                Masuk di sini
                            </a>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        function previewFoto(event) {
            const img = document.getElementById('fotoPreview');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.style.display = 'block';
        }
    </script>
</body>
</html>
