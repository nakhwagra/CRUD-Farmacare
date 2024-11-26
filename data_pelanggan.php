<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani penambahan data pelanggan
if (isset($_POST['tambah'])) {
    $Id_pelanggan = $_POST['Id_pelanggan'];
    $Nama_pelanggan = $_POST['Nama_pelanggan'];
    $Alamat = $_POST['Alamat'];
    $No_telepon = $_POST['No_telepon'];
    $Email = $_POST['Email'];
    
    $query = "INSERT INTO pelanggan (Id_pelanggan, Nama_pelanggan, Alamat, No_telepon, Email) VALUES ('$Id_pelanggan', '$Nama_pelanggan', '$Alamat', '$No_telepon', '$Email')";
    mysqli_query($koneksi, $query);
    header("Location: data_pelanggan.php");
}

// Menangani penghapusan data pelanggan
if (isset($_GET['hapus'])) {
    $id_pelanggan = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE Id_pelanggan = '$id_pelanggan'");
    header("Location: data_pelanggan.php");
}

// Menangani pengubahan data pelanggan
if (isset($_POST['ubah'])) {
    $Id_pelanggan = $_POST['Id_pelanggan'];
    $Nama_pelanggan = $_POST['Nama_pelanggan'];
    $Alamat = $_POST['Alamat'];
    $No_telepon = $_POST['No_telepon'];
    $Email = $_POST['Email'];    

    $query = "UPDATE pelanggan SET 
        Nama_pelanggan='$Nama_pelanggan', 
        Alamat='$Alamat', 
        No_telepon='$No_telepon', 
        Email='$Email' 
        WHERE Id_pelanggan='$Id_pelanggan'";
    mysqli_query($koneksi, $query);
    header("Location: data_pelanggan.php");
}

// Menampilkan data pelanggan
$data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Biru muda lembut */
            color: #333; /* Teks gelap untuk kontras */
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
            color: #00796b; /* Teal gelap */
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: #b2dfdb; /* Biru tua lembut untuk header tabel */
            color: #004d40; /* Teks header gelap */
        }
        tr:nth-child(even) {
            background-color: #f1f1f1; /* Baris genap */
        }
        tr:hover {
            background-color: #e0f2f1; /* Efek hover untuk baris tabel */
        }
        .btn-custom {
            background-color: #00796b; /* Warna teal */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #004d40; /* Warna lebih gelap saat hover */
        }
        .form-control {
            margin-bottom: 10px;
            background-color: #f5f5f5; /* Warna terang untuk input */
            color: #333; /* Teks input gelap */
        }
        .form-control::placeholder {
            color: #888; /* Warna placeholder */
        }
    </style>
    <title>Data Pelanggan - Aplikasi Apotik</title>
</head>
<body>
    <header>
        <h1>Data Pelanggan</h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </header>
    
    <div class="container">
        <h2>Tambah Pelanggan</h2>
        <form method="POST" action="">
            <input type="number" name="Id_pelanggan" class="form-control" placeholder="Id Pelanggan" required>
            <input type="text" name="Nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" required>
            <input type="text" name="Alamat" class="form-control" placeholder="Alamat" required>
            <input type="text" name="No_telepon" class="form-control" placeholder="No Telepon" required>
            <input type="email" name="Email" class="form-control" placeholder="Email" required>
            <button type="submit" name="tambah" class="btn btn-custom">Tambah</button>
        </form>

        <h2>Daftar Pelanggan</h2>
        <table class="table table-bordered">
            <tr>
                <th>Id Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data_pelanggan)): ?>
            <tr>
                <td><?php echo $row['Id_pelanggan']; ?></td>
                <td><?php echo $row['Nama_pelanggan']; ?></td>
                <td><?php echo $row['Alamat']; ?></td>
                <td><?php echo $row['No_telepon']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td>
                    <a href="data_pelanggan.php?edit=<?php echo $row['Id_pelanggan']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="data_pelanggan.php?hapus=<?php echo $row['Id_pelanggan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <?php
        // Menampilkan form ubah jika ada parameter edit
        if (isset($_GET['edit'])) {
            $Id_pelanggan = $_GET['edit'];
            $pelanggan_data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE Id_pelanggan='$Id_pelanggan'");
            $pelanggan = mysqli_fetch_assoc($pelanggan_data);
        ?>
        <h2>Ubah Pelanggan</h2>
        <form method="POST" action="">
            <input type="hidden" name="Id_pelanggan" value="<?php echo $pelanggan['Id_pelanggan']; ?>">
            <input type="text" name="Nama_pelanggan" class="form-control" value="<?php echo $pelanggan['Nama_pelanggan']; ?>" required>
            <input type="text" name="Alamat" class="form-control" value="<?php echo $pelanggan['Alamat']; ?>" required>
            <input type="text" name="No_telepon" class="form-control" value="<?php echo $pelanggan['No_telepon']; ?>" required>
            <input type="email" name="Email" class="form-control" value="<?php echo $pelanggan['Email']; ?>" required>
            <button type="submit" name="ubah" class="btn btn-custom">Ubah</button>
        </form>
        <?php } ?>

        <br>
        <a href="tampil.php" class="btn btn-secondary">Kembali ke Halaman Tampil</a>
        
    </div>
</body>
</html>
