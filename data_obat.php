<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani penambahan data obat
if (isset($_POST['tambah'])) {
    $Id_obat = $_POST['Id_obat'];
    $Nama_obat = $_POST['Nama_obat'];
    $Jenis_obat = $_POST['Jenis_obat'];
    $Dosis = $_POST['Dosis'];
    $Harga = $_POST['Harga'];
    $Tgl_kadaluarsa = $_POST['Tgl_kadaluarsa'];
    $Stok = $_POST['Stok'];

    $query = "INSERT INTO obat (Id_obat, Nama_obat, Jenis_obat, Dosis, Harga, Tgl_kadaluarsa, Stok) VALUES ('$Id_obat', '$Nama_obat', '$Jenis_obat', '$Dosis', '$Harga', '$Tgl_kadaluarsa', '$Stok')";
    mysqli_query($koneksi, $query);
    header("Location: data_obat.php");
}

// Menangani penghapusan data obat
if (isset($_GET['hapus'])) {
    $id_obat = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM obat WHERE Id_obat = '$id_obat'");
    header("Location: data_obat.php");
}

// Menangani pengubahan data obat
if (isset($_POST['ubah'])) {
    $Id_obat = $_POST['Id_obat'];
    $Nama_obat = $_POST['Nama_obat'];
    $Jenis_obat = $_POST['Jenis_obat'];
    $Dosis = $_POST['Dosis'];
    $Harga = $_POST['Harga'];
    $Tgl_kadaluarsa = $_POST['Tgl_kadaluarsa'];
    $Stok = $_POST['Stok'];

    $query = "UPDATE obat SET Nama_obat='$Nama_obat', Jenis_obat='$Jenis_obat', Dosis='$Dosis', Harga='$Harga', Tgl_kadaluarsa='$Tgl_kadaluarsa', Stok='$Stok' WHERE Id_obat='$Id_obat'";
    mysqli_query($koneksi, $query);
    header("Location: data_obat.php");
}

// Menampilkan data obat
$data_obat = mysqli_query($koneksi, "SELECT * FROM obat");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Data Obat - Aplikasi Apotik</title>
    <style>
        body {
            background-color: #e3f2fd;
        }
        .container {
            margin: 40px auto;
            padding: 20px;
            background-color: teal;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 1200px;
        }
        h1, h2 {
            text-align: center;
            color: #007bff;
        }
        .photo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .photo-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
        }
        th, td {
            text-align: center;
            padding: 15px;
        }
        th {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        td {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-control {
            margin-bottom: 10px;
            height: 35px; /* Memperkecil tinggi input */
            font-size: 14px; /* Memperkecil ukuran font */
        }
        .form-group {
            display: flex;
            flex-wrap: wrap; /* Agar tetap rapi dalam satu baris */
            justify-content: space-between; /* Menyusun secara rapi */
            max-width: 100%;
            margin: 0 auto; /* Centering */
        }
        .text-end {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .notification {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="text-center">
        <h1 style="color:navy"><marquee>Data Obat</marquee></h1>
    </header>
    
    <div class="container">
        <div class="photo-container">
        </div>

        <h2 style="color:white">Tabel Daftar Obat</h2>
        <table class="table table-bordered">
            <tr>
                <th>Id Obat</th>
                <th>Nama Obat</th>
                <th>Jenis Obat</th>
                <th>Dosis</th>
                <th>Harga</th>
                <th>Tanggal Kadaluarsa</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data_obat)): ?>
            <tr>
                <td><?php echo $row['Id_obat']; ?></td>
                <td><?php echo $row['Nama_obat']; ?></td>
                <td><?php echo $row['Jenis_obat']; ?></td>
                <td><?php echo $row['Dosis']; ?></td>
                <td><?php echo $row['Harga']; ?></td>
                <td><?php echo $row['Tgl_kadaluarsa']; ?></td>
                <td><?php echo $row['Stok']; ?></td>
                <td>
                    <a href="data_obat.php?edit=<?php echo $row['Id_obat']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="data_obat.php?hapus=<?php echo $row['Id_obat']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2 style="color:white">Tambah Obat</h2>
        <form method="POST" action="">
            <div class="form-group">
                <input type="number" name="Id_obat" class="form-control" placeholder="Id Obat" required style="flex: 1; margin-right: 10px;">
                <input type="text" name="Nama_obat" class="form-control" placeholder="Nama Obat" required style="flex: 1; margin-right: 10px;">
                <input type="text" name="Jenis_obat" class="form-control" placeholder="Jenis Obat" required style="flex: 1; margin-right: 10px;">
                <input type="text" name="Dosis" class="form-control" placeholder="Dosis" required style="flex: 1; margin-right: 10px;">
                <input type="text" name="Harga" class="form-control" placeholder="Harga" required style="flex: 1; margin-right: 10px;">
                <input type="date" name="Tgl_kadaluarsa" class="form-control" required style="flex: 1; margin-right: 10px;">
                <input type="number" name="Stok" class="form-control" placeholder="Stok" required style="flex: 1;">
            </div>
            <button type="submit" name="tambah" class="btn btn-custom">Tambah</button>
        </form>

        <div class="text-end">
            <a href="tampil.php" class="btn btn-secondary btn-custom">Kembali ke Halaman Tampil</a>
            <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
        </div>

        <div class="notification">
            <strong style="color:navy">Catatan:</strong> Pastikan untuk memeriksa obat yang hampir kadaluarsa.
        </div>
    </div>
</body>
</html>
