<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotik Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #001f3f;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-image: linear-gradient(to right, #007bff, #00a676); /* Gradasi biru-hijau lebih lembut */
        }

        .navbar a {
            color: #f8f9fa;
            font-weight: 500;
        }

        .container {
            margin-top: 50px;
        }

        .logo {
            width: 900px;
            max-width: 100%;
            border-radius: 15px; /* Ujung melengkung */
        }

        .title {
            color: #ffffff;
            font-size: 32px;
            margin-top: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }

        .description {
            font-size: 18px;
            color: #d4f1f4;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            margin-top: 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .carousel-inner {
            display: flex;
            flex-direction: column;
        }

        .carousel-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .carousel-item img {
            max-height: 400px;
            object-fit: cover;
            width: 85%;
            border-radius: 10px;
        }

        .carousel-text {
            padding: 30px;
            width: 85%;
            max-width: 800px;
            color: #ffffff;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        .carousel-item:nth-child(odd) .carousel-text {
            background-color: #007bff;
        }

        .carousel-item:nth-child(even) .carousel-text {
            background-color: #28a745;
        }

        .carousel-text h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .carousel-text p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                max-height: 250px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Farmacare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard2.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="formlogin.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center">
        <img src="fc.jpg" alt="Logo Apotik" class="logo">
        <h1 class="title">Selamat Datang di Farmacare</h1>
        <p class="description">Kami menyediakan berbagai jenis obat dan kebutuhan apotek dengan kualitas terbaik untuk kesehatan Anda. <br>Temukan obat yang Anda butuhkan di sini!</p>
    </div>

    <!-- Carousel -->
    <div id="carouselExample" class="carousel slide my-5 carousel-container" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="obat.jpg" class="d-block w-100" alt="Obat Kesehatan">
                <div class="carousel-text">
                    <h3>Obat Kesehatan untuk Anda</h3>
                    <p>Temukan berbagai obat yang aman dan terpercaya untuk menjaga kesehatan Anda. Kami menyediakan obat-obatan yang telah terjamin kualitasnya.</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="carousel-text">
                    <h3>Layanan Apotek 24 Jam</h3>
                    <p>Apotek kami siap melayani Anda kapan saja dengan layanan 24 jam. Anda bisa mengakses layanan kami dengan mudah, kapan dan di mana saja.</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="carousel-text">
                    <h3>Kesehatan Anda Prioritas Kami</h3>
                    <p>Apotek Sehat berkomitmen untuk menyediakan pelayanan kesehatan terbaik bagi Anda dan keluarga. Kami selalu berinovasi untuk memenuhi kebutuhan obat Anda.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
