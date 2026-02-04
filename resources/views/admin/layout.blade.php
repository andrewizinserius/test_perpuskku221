<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- External CSS Links -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== BODY BACKGROUND ===== */
        body {
            background-image: url("https://png.pngtree.com/background/20230519/original/pngtree-anime-library-room-picture-image_2648617.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #1f2933;
        }

        /* ===== TOP NAVBAR ===== */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: linear-gradient(135deg, #0f766e 0%, #0b3c3a 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            z-index: 1100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            color: #ecfeff;
            font-weight: 700;
            font-size: 20px;
            text-decoration: none;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            color: #ffffff;
            transform: scale(1.05);
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 280px;
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
            padding: 40px 25px;
            background: linear-gradient(180deg, #0b132b 0%, #1c2541 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.4);
            overflow-y: auto;
            z-index: 1000;
            border-radius: 0 20px 20px 0;
        }

        /* ===== SIDEBAR HEADER ===== */
        .sidebar-header {
            text-align: center;
            margin-bottom: 50px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .sidebar-header h4 {
            color: #ecfeff;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .sidebar-header p {
            font-size: 14px;
            opacity: 0.85;
            color: #a5f3fc;
            margin: 8px 0 0 0;
        }

        /* ===== SIDEBAR MENU ===== */
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 8px;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border-radius: 12px;
            color: #e0f2fe;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar ul li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(45, 212, 191, 0.25), transparent);
            transition: left 0.5s ease;
        }

        .sidebar ul li a:hover::before {
            left: 100%;
        }

        .sidebar ul li a:hover {
            background: rgba(45, 212, 191, 0.15);
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .sidebar ul li a i {
            width: 24px;
            text-align: center;
            font-size: 18px;
            opacity: 0.9;
        }

        /* ===== LOGOUT BUTTON ===== */
        .logout-btn {
            display: block;
            margin-top: 30px;
            background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%);
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            border: none;
            color: #fff;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #450a0a 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.6);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 40px;
            min-height: calc(100vh - 70px);
            position: relative;
        }

        /* ===== PROFILE PHOTO IN NAVBAR ===== */
        .profile-container {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 15px;
            border-radius: 50px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .profile-container:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }

        .profile-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ecfeff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.1);
        }

        .profile-name {
            font-size: 15px;
            font-weight: 600;
            color: #ecfeff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        }

        /* ===== SCROLLBAR ===== */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #5eead4, #0f766e);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .top-navbar {
                height: auto;
                padding: 15px 20px;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                top: 0;
                margin-top: 70px;
                border-radius: 0;
            }

            .main-content {
                margin-left: 0;
                margin-top: 0;
                padding-top: 20px;
            }

            .profile-container {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Top Navbar -->
    <nav class="top-navbar">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <div class="profile-container">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile Photo" class="profile-photo">
            <span class="profile-name">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Admin Dashboard</h4>
            <p>Welcome Admin</p>
        </div>

        <ul class="list-unstyled">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('transaksi.index') }}"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
            <li><a href="{{ route('anggota.index') }}"><i class="fas fa-users"></i> Anggota</a></li>
            <li><a href="{{ route('jenisanggota.index') }}"><i class="fas fa-id-card"></i> Jenis Anggota</a></li>
            <li><a href="{{ route('ddc.index') }}"><i class="fas fa-sitemap"></i> DDC</a></li>
            <li><a href="{{ route('formats.index') }}"><i class="fas fa-cogs"></i> Formats</a></li>
            <li><a href="{{ route('rak.index') }}"><i class="fas fa-box"></i> Rak</a></li>
            <li><a href="{{ route('penerbit.index') }}"><i class="fas fa-print"></i> Penerbit</a></li>
            <li><a href="{{ route('pengarang.index') }}"><i class="fas fa-pen-nib"></i> Pengarang</a></li>
            <li><a href="{{ route('pustaka.index') }}"><i class="fas fa-book"></i> Pustaka</a></li>
            <li>
                <a href="{{ route('logout') }}" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
