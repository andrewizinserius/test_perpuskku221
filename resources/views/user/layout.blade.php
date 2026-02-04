<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Tema Modern */
        body {
            font-family: 'Poppins', sans-serif;
            color: #ddd;
            background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #28a745 !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 5px;
            padding: 8px 16px;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745 !important;
            transform: translateY(-2px);
        }

        /* Jumbotron Modern */
        .jumbotron {
            padding: 120px 0;
            background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);
            position: relative;
            overflow: hidden;
        }

        .jumbotron::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .jumbotron .left-content {
            text-align: left;
            z-index: 1;
            position: relative;
        }

        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .jumbotron p {
            font-size: 1.25rem;
            color: #bbb;
            line-height: 1.6;
        }

        .jumbotron .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .jumbotron .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
        }

        .right-content img {
            width: 100%;
            max-width: 450px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .right-content img:hover {
            transform: scale(1.05);
        }

        /* Horizontal Line */
        hr.custom-line {
            border: 0;
            height: 3px;
            background: linear-gradient(90deg, #444 0%, #666 50%, #444 100%);
            margin: 60px 0;
            border-radius: 2px;
        }

        /* About Section */
        #about {
            padding: 80px 0;
        }

        .card-custom {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 20px;
        }

        .card-custom:hover {
            transform: translateY(-15px) scale(1.02);
        }

        .card-custom .card {
            border-radius: 20px;
            background: linear-gradient(135deg, #1f1f1f 0%, #2c2c2c 100%);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-custom:hover .card {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .card-custom .card-body {
            padding: 50px 40px;
            text-align: center;
        }

        .icon-wrapper {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .card-custom:hover .icon-wrapper {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .card-custom .bi {
            font-size: 3rem;
            color: white;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 1.1rem;
            color: #ccc;
            line-height: 1.6;
        }

        /* Footer Styling */
        footer {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: white;
            padding: 50px 0 30px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #20c997 50%, #28a745 100%);
        }

        footer h4 {
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }

        footer ul {
            padding: 0;
            list-style: none;
        }

        footer .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        footer .contact-item:hover {
            transform: translateX(5px);
        }

        footer .contact-item i {
            margin-right: 12px;
            font-size: 1.3rem;
            min-width: 22px;
            color: #28a745;
        }

        footer .contact-item span {
            line-height: 1.5;
        }

        footer .list-inline-item a {
            margin-right: 15px;
            font-size: 1.6rem;
            color: #bbb;
            transition: all 0.3s ease;
        }

        footer .list-inline-item a:hover {
            color: #28a745;
            transform: translateY(-3px);
        }

        footer img {
            transition: transform 0.3s ease;
        }

        footer img:hover {
            transform: scale(1.05);
        }

        footer .border-top {
            border-color: #444 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .jumbotron {
                padding: 80px 0;
                text-align: center;
            }

            .jumbotron h1 {
                font-size: 2.5rem;
            }

            .jumbotron .d-flex {
                flex-direction: column;
                text-align: center;
            }

            .right-content {
                margin-top: 40px;
            }

            .card-custom .card-body {
                padding: 30px 20px;
            }

            .icon-wrapper {
                width: 70px;
                height: 70px;
            }

            .card-custom .bi {
                font-size: 2.5rem;
            }

            .card-title {
                font-size: 1.4rem;
            }

            .card-text {
                font-size: 1rem;
            }
        }

        /* Scroll Effect */
        .hidden {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.index') }}">Perpustakaan Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger me-2" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content mt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5">
        <div class="container">
            <div class="row">
                <!-- Follow Us Section -->
                <div class="col-md-4 mb-4 text-md-start text-center">
                    <h4>Follow Us</h4>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/smkantartika1sda?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                                class="text-light"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://youtube.com/@smkantartika1sidoarjo726?si=HVdGlSohXCPsBSlK"
                                class="text-light"><i class="bi bi-youtube"></i></a>
                        </li>
                    </ul>
                </div>

               <!-- Logo Sekolah Section -->
               <div class="col-md-4 mb-4 text-center">
                <img src="https://hummatech.com/storage/partner/8iq8YE7TuolFdQtyTpsyTeq6xzEV2BrvyYQcxWI1.png" 
                alt="Logo Sekolah Antartika" 
                class="img-fluid" 
                style="max-width: 200px;">
            </div>

                <!-- Contact Us Section -->
                <div class="col-md-4 mb-4 text-md-start text-center">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li class="contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>Email: smkmuhammadiyah9gambiran@gmail.com</span>
                        </li>
                        <li class="contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>Telepon: +62 831 1216 7054</span>
                        </li>
                        <li class="contact-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Alamat: Jl. Singosari, Sumberjaya, Wringin Agung, Kec. Gambiran, Kabupaten Banyuwangi, Jawa Timur 68486</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center py-3 border-top mt-4">
                <p class="mb-0">&copy; 2023 Your Company. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>