<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:data.php");
    exit;
}

include 'koneksi.php';

// Mengambil data untuk ditampilkan
$total_obat = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM obat")->fetch_assoc()['total'];
$total_pelanggan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pelanggan")->fetch_assoc()['total'];
$total_penjualan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM penjualan")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Dashboard - Aplikasi Apotik</title>
    <style>
        body {
            background-color: #e3f2fd; /* Warna latar belakang */
        }
        header {
            text-align: center;
            margin-bottom: 20px;
            position: relative; /* Agar tombol logout bisa diposisikan relatif */
        }
        .logout-btn {
            position: absolute;
            right: 20px; /* Menempatkan di kanan atas */
            top: 20px; /* Jarak dari atas */
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: teal;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .timbul {
            font-size: 48px; /* Ukuran font judul */
            color: navy; /* Warna teks */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Efek bayangan */
            margin-bottom: 20px; /* Jarak bawah */
        }
        .notification {
            background-color: #fff3cd; /* Latar belakang pemberitahuan */
            border: 1px solid #ffeeba; /* Border kuning */
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px; /* Jarak atas */
        }
        .menu-navigasi {
            text-align: center; /* Center menu navigasi */
            margin-top: 30px; /* Jarak atas menu navigasi */
        }
        .btn i {
            margin-right: 5px; /* Jarak antara ikon dan teks */
        }
        .btn-group {
            gap: 15px; /* Jarak antar tombol */
        }
    </style>
</head>
<body>
    <header>
        <br>
        <br>
        <br>   
        <h1 class="timbul">Selamat Datang di Farmacare</h1>
        <p>Halo, <?php echo $_SESSION['username']; ?>!</p>
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
    </header>

    <div class="container">
        <h2 style="color:white">Ringkasan Data</h2>
        <ul class="list-group mb-4">
            <li class="list-group-item">Total Obat: <strong><?php echo $total_obat; ?></strong></li>
            <li class="list-group-item">Total Pelanggan: <strong><?php echo $total_pelanggan; ?></strong></li>
            <li class="list-group-item">Total Penjualan: <strong><?php echo $total_penjualan; ?></strong></li>
        </ul>

        <h3 style="color:white">Pemberitahuan</h3>
        <div class="notification">
            <p>Pastikan untuk memeriksa obat yang hampir habis.</p>
        </div>
    </div>

    <div class="menu-navigasi">
        <div class="btn-group">
            <a href="data_obat.php" class="btn btn-primary"><i class="fas fa-capsules"></i> Data Obat</a>
            <a href="data_pelanggan.php" class="btn btn-primary"><i class="fas fa-user"></i> Data Pelanggan</a>
            <a href="data_karyawan.php" class="btn btn-primary"><i class="fas fa-users"></i> Data Karyawan</a>
            <a href="data_dokter.php" class="btn btn-primary"><i class="fas fa-user-md"></i> Data Dokter</a>
            <a href="penjualan.php" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Penjualan</a>
            <a href="laporan.php" class="btn btn-primary"><i class="fas fa-file-alt"></i> Laporan</a>
        </div>
    </div>
</body>
</html>
