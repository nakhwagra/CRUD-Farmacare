<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotik Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f7;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar a {
            color: white;
        }

        .container {
            margin-top: 50px;
        }

        .logo {
            width:800px;
            max-width: 100%;
        }

        .title {
            color: #007bff;
            font-size: 30px;
            margin-top: 20px;
        }

        .description {
            font-size: 18px;
            color: #555;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #007bff;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            color: #ffffff;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logo {
            max-width: 100%;
            width: 500px;
            height: auto;
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
                    <li class="nav-item"><a class="nav-link" href="#home" onclick="showSection('home')">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#dashboard" onclick="showSection('dashboard')">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#carousel" onclick="showSection('carousel')">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="formlogin.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-3">
            <img src="profil.jpg" alt="Profile" class="profile-img">
            <h5 class="text-white">Farmacare</h5>
            <p class="text-white-50">Admin</p>
        </div>
        <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="data_obat.php"><i class="fas fa-briefcase"></i> Data Obat</a>
        <a href="data_karyawan.php"><i class="fas fa-user"></i> Data Karyawan</a>
        <a href="data_pelanggan.php"><i class="fas fa-file-alt"></i> Data Pelanggan</a>
        <a href="data_dokter.php"><i class="fas fa-file-alt"></i> Data Dokter</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Content -->
        <div id="home" class="content-section active-section">
            <img src="logo.jpg" alt="Logo Apotik" class="logo">
            <h1 class="title">Selamat Datang di Farmacare</h1>
            <p class="description">Kami menyediakan berbagai jenis obat dan kebutuhan apotek dengan kualitas terbaik untuk kesehatan Anda. <br>Temukan obat yang Anda butuhkan di sini!</p>
        </div>

        <div id="dashboard" class="content-section">
            <h4>Dashboard</h4>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-info text-white mb-4">
                            <div class="card-body">Total Obat</div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Total Supplier</div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Total Transaksi</div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layanan -->
        <div id="carousel" class="content-section">
            <div id="carouselExample" class="carousel slide my-5 carousel-container" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <img src="slide1.jpg" class="d-block w-100" alt="Obat Kesehatan">
                        <div class="carousel-text">
                            <h3>Obat Kesehatan untuk Anda</h3>
                            <p>Temukan berbagai obat yang aman dan terpercaya untuk menjaga kesehatan Anda. Kami menyediakan obat-obatan yang telah terjamin kualitasnya.</p>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="slide2.jpg" class="d-block w-100" alt="Layanan Apotek">
                        <div class="carousel-text">
                            <h3>Layanan Apotek 24 Jam</h3>
                            <p>Apotek kami siap melayani Anda kapan saja dengan layanan 24 jam. Anda bisa mengakses layanan kami dengan mudah, kapan dan di mana saja.</p>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <img src="slide3.jpg" class="d-block w-100" alt="Kesehatan Anda Prioritas Kami">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Function to display content based on the selected menu
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach((section) => {
                section.classList.remove('active-section');
            });
            document.getElementById(sectionId).classList.add('active-section');
        }
    </script>
</body>
</html>
