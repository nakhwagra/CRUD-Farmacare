<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

// Cek apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: formlogin.php"); // Arahkan ke login jika belum login
    exit;
}

// Query untuk mendapatkan total obat
$query_obat = "SELECT COUNT(*) AS total_obat FROM obat"; // Gantilah dengan nama tabel dan kolom sesuai database Anda
$result_obat = mysqli_query($koneksi, $query_obat);
$data_obat = mysqli_fetch_assoc($result_obat);
$total_obat = $data_obat['total_obat'];

// Query untuk mendapatkan total pelanggan
$query_pelanggan = "SELECT COUNT(*) AS total_pelanggan FROM pelanggan"; // Gantilah dengan nama tabel dan kolom sesuai database Anda
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
$data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$total_pelanggan = $data_pelanggan['total_pelanggan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: teal;
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
        .dropdown-toggle::after {
            display: none;
        }
        .address-box {
            padding: 15px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .address-box h5 {
            margin-bottom: 10px;
        }
        .sidebar .fas.fa-home {
            margin-right: 10px;
        }
        .logo {
            max-width: 100%;
            width: 500px;
            height: auto;
        }

        /* Styling untuk kotak data (obat, karyawan, dll.) */
        .data-box {
            background-color: #f1f1f1;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .data-box h3 {
            margin-bottom: 15px;
            color: #333;
        }
        .data-box .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-3">
            <img src="profil.jpg" alt="Profile" class="profile-img">
            <h5 class="text-white">Farmacare</h5>
            <p class="text-white-50">Admin</p>
        </div>
        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="data_obat.php"><i class="fas fa-briefcase"></i> Data Obat</a>
        <a href="data_karyawan.php"><i class="fas fa-user"></i> Data Karyawan</a>
        <a href="data_pelanggan.php"><i class="fas fa-file-alt"></i> Data Pelanggan</a>
        <a href="data_dokter.php"><i class="fas fa-file-alt"></i> Data Dokter</a>
        <a href="tampil.php"><i class="fas fa-sign-out-alt"></i> Semua</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div>
                <h4>Dashboard</h4>
            </div>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="profil.jpg" class="profile-img" alt="Profile">
                    <span>Farmacare</span>
                    <i class="fas fa-caret-down ms-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="logout.php" role="button">Logout</a></li>
                </ul>   
            </div>
        </div>

        <!-- Alamat Box (Tidak Menimpa Header) -->
        <div class="address-box">
            <center><img src="depan.jpg" class="logo" alt="Profile"></center>
            <center><h6>Jl. Raya No. 123, RT 03/RW 02, Desa Sukamaju Kecamatan Sukaraja, Kota Bandung, Jawa Barat, 40123</h6></center>
            <center><p>Website: www.farmacare.co.id | Email: info@farmacare.co.id</p></center>
        </div>

        <!-- Data Boxes (Latar Belakang Kotak untuk Data Obat dan Lainnya) -->
    <center>
        <div class="container mt-4">
            <div class="row">
                <!-- Data Obat -->
                <div class="col-md-4">
                    <div class="data-box">
                        <h3>Total Obat</h3>
                        <p>Jumlah total obat yang terdaftar di sistem.</p>
                        <a href="data_obat.php" class="btn btn-primary w-100">Lihat Data Obat</a> <!-- Tambahkan href untuk tautan -->
                    </div>
                </div>
                <!-- Data Transaksi -->
                <div class="col-md-4">
                    <div class="data-box">
                        <h3>Total Transaksi</h3>
                        <p>Jumlah total transaksi yang tercatat.</p>
                        <a href="laporan.php" class="btn btn-primary w-100">Lihat Data Penjualan</a> <!-- Tambahkan href untuk tautan -->
                    </div>
                </div>
            </div>
        </div>
    </center>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>