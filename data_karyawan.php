<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani penambahan data karyawan
if (isset($_POST['tambah'])) {
    $Id_karyawan = $_POST['Id_karyawan'];
    $Nama_karyawan = $_POST['Nama_karyawan'];
    $Jabatan = $_POST['Jabatan'];
    $No_telepon = $_POST['No_telepon'];
    $Email = $_POST['Email'];
    
    $query = "INSERT INTO karyawan (Id_karyawan, Nama_karyawan, Jabatan, No_telepon, Email) VALUES ('$Id_karyawan', '$Nama_karyawan', '$Jabatan', '$No_telepon', '$Email')";
    mysqli_query($koneksi, $query);
    header("Location: data_karyawan.php");
}

// Menangani penghapusan data karyawan
if (isset($_GET['hapus'])) {
    $Id_karyawan = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM karyawan WHERE Id_karyawan = '$Id_karyawan'");
    header("Location: data_karyawan.php");
}

// Menangani pengubahan data karyawan
if (isset($_POST['ubah'])) {
    $Id_karyawan = $_POST['Id_karyawan'];
    $Nama_karyawan = $_POST['Nama_karyawan'];
    $Jabatan = $_POST['Jabatan'];
    $No_telepon = $_POST['No_telepon'];
    $Email = $_POST['Email'];
    
    $query = "UPDATE karyawan SET 
        Nama_karyawan='$Nama_karyawan', 
        Jabatan='$Jabatan', 
        No_telepon='$No_telepon',
        Email='$Email'
        WHERE Id_karyawan='$Id_karyawan'";
    mysqli_query($koneksi, $query);
    header("Location: data_karyawan.php");
}

// Menampilkan data karyawan
$data_karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e3f2fd; /* Biru muda */
            color: #2c3e50; /* Teks gelap untuk kontras */
        }
        .container {
            margin-top: 20px;
            padding: 30px;
            background-color: #ffffff; /* Latar belakang putih untuk kontainer */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan ringan */
        }
        h1, h2 {
            text-align: center;
            color: #1976d2; /* Biru tua */
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd; /* Border tabel */
        }
        th {
            background-color: #bbdefb; /* Biru muda untuk header tabel */
            color: #0d47a1; /* Teks header gelap */
        }
        tr:nth-child(even) {
            background-color: #f1f8e9; /* Baris genap */
        }
        tr:hover {
            background-color: #bbdefb; /* Efek hover untuk baris tabel */
        }
        .btn-custom {
            background-color: #1976d2; /* Warna biru tua */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #0d47a1; /* Warna lebih gelap saat hover */
        }
        .form-control {
            margin-bottom: 10px;
            background-color: #f9fbe7; /* Warna terang untuk input */
            color: #333; /* Teks input gelap */
        }
        .form-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f1f8e9; /* Latar belakang lebih terang untuk form */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan untuk box */
        }
    </style>
    <title>Data Karyawan - Aplikasi Apotik</title>
</head>
<body>
    <header>
        <h1>Data Karyawan</h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </header>
    
    <div class="container">
        <h2>Daftar Karyawan</h2>
        <table class="table">
            <tr>
                <th>Id Karyawan</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data_karyawan)): ?>
            <tr>
                <td><?php echo $row['Id_karyawan']; ?></td>
                <td><?php echo $row['Nama_karyawan']; ?></td>
                <td><?php echo $row['Jabatan']; ?></td>
                <td><?php echo $row['No_telepon']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td>
                    <a href="data_karyawan.php?edit=<?php echo $row['Id_karyawan']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="data_karyawan.php?hapus=<?php echo $row['Id_karyawan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="form-section">
            <h2>Tambah Karyawan</h2>
            <form method="POST" action="">
                <input type="number" name="Id_karyawan" class="form-control" placeholder="Id Karyawan" required>
                <input type="text" name="Nama_karyawan" class="form-control" placeholder="Nama Karyawan" required>
                <input type="text" name="Jabatan" class="form-control" placeholder="Jabatan" required>
                <input type="number" name="No_telepon" class="form-control" placeholder="No Telepon" required>
                <input type="email" name="Email" class="form-control" placeholder="Email" required>
                <button type="submit" name="tambah" class="btn btn-custom">Tambah</button>
            </form>
        </div>

        <?php
        // Menampilkan form ubah jika ada parameter edit
        if (isset($_GET['edit'])) {
            $Id_karyawan = $_GET['edit'];
            $karyawan_data = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE Id_karyawan='$Id_karyawan'");
            $karyawan = mysqli_fetch_assoc($karyawan_data);
        ?>
        <h2>Ubah Karyawan</h2>
        <form method="POST" action="">
            <input type="hidden" name="Id_karyawan" value="<?php echo $karyawan['Id_karyawan']; ?>">
            <input type="text" name="Nama_karyawan" class="form-control" value="<?php echo $karyawan['Nama_karyawan']; ?>" required>
            <input type="text" name="Jabatan" class="form-control" value="<?php echo $karyawan['Jabatan']; ?>" required>
            <input type="number" name="No_telepon" class="form-control" value="<?php echo $karyawan['No_telepon']; ?>" required>
            <input type="email" name="Email" class="form-control" value="<?php echo $karyawan['Email']; ?>" required>
            <button type="submit" name="ubah" class="btn btn-custom">Ubah</button>
        </form>
        <?php } ?>
        
        <br>
        <a href="tampil.php" class="btn btn-secondary">Kembali ke Halaman Tampil</a>
    </div>
</body>
</html>
