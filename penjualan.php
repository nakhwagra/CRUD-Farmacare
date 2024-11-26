<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani penambahan data penjualan
if (isset($_POST['tambah'])) {
    $Id_obat = $_POST['Id_obat'];
    $Jumlah = $_POST['Jumlah'];
    $Nama_pembeli = $_POST['Nama_pembeli']; // Ambil nama pembeli dari form

    // Ambil harga dan stok obat
    $result = mysqli_query($koneksi, "SELECT Harga, Stok FROM obat WHERE Id_obat='$Id_obat'");
    $obat = mysqli_fetch_assoc($result);
    $Total_harga = $obat['Harga'] * $Jumlah;

    // Cek apakah stok cukup untuk dijual
    if ($obat['Stok'] >= $Jumlah) {
        // Insert data penjualan
        $query = "INSERT INTO penjualan (Id_obat, Jumlah, Tanggal, Total_harga, Nama_pembeli) 
                  VALUES ('$Id_obat', '$Jumlah', NOW(), '$Total_harga', '$Nama_pembeli')";
        mysqli_query($koneksi, $query);

        // Update stok obat
        $new_stok = $obat['Stok'] - $Jumlah;
        $update_stok_query = "UPDATE obat SET Stok = '$new_stok' WHERE Id_obat = '$Id_obat'";
        mysqli_query($koneksi, $update_stok_query);

        header("Location: penjualan.php");
    } else {
        echo "<script>alert('Stok obat tidak cukup!');</script>";
    }
}

// Menangani penghapusan data penjualan
if (isset($_GET['hapus'])) {
    $Id_penjualan = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM penjualan WHERE Id_penjualan = '$Id_penjualan'");
    header("Location: penjualan.php");
}

// Menampilkan data penjualan
$data_penjualan = mysqli_query($koneksi, "SELECT p.*, o.Nama_obat, p.Nama_pembeli FROM penjualan p JOIN obat o ON p.Id_obat = o.Id_obat");

// Menampilkan data obat untuk form penjualan
$data_obat = mysqli_query($koneksi, "SELECT * FROM obat");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Penjualan Obat - Aplikasi Apotik</title>
    <style>
        body {
            background-color: #f1f1f1;
        }
        .container {
            margin-top: 30px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .header {
            background-color: #00796b;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .table-custom th, .table-custom td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
        }
        .table-custom th {
            background-color: #00796b;
            color: white;
            border: 1px solid #ddd;
            font-weight: bold;
        }
        .table-custom td {
            background-color: #fff;
            border: 1px solid #ddd;
            color: #333;
        }
        .table-custom tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table-custom tr:hover {
            background-color: #e2e6ea;
        }
        .table-custom td a {
            transition: all 0.3s ease;
        }
        .table-custom td a:hover {
            color: #ff7043;
        }
        .notification {
            background-color: #e9f7fc;
            border: 1px solid #bde0fd;
            color: #4e94e5;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
        }
        .select2-container .select2-selection--single {
            height: 40px;
        }

        /* Centering the table */
        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .boxed-btn {
            display: inline-block;
            padding: 10px 25px;
            font-size: 16px;
            border: 2px solid #007bff;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .boxed-btn:hover {
            background-color: #007bff;
            color: white;
            transform: translateY(-2px);
        }

        .employee-name {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Penjualan Obat</h1>
            <h2>Farmacare</h2>
            <p>Kelola Penjualan Obat dengan Mudah</p>
        </div>

        <!-- Form Penjualan -->
        <h3>Form Penjualan Obat</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="Id_obat" class="form-label">Pilih Obat</label>
                <select name="Id_obat" id="Id_obat" class="form-control" required>
                    <option value="">Pilih Obat</option>
                    <?php while ($row = mysqli_fetch_assoc($data_obat)): ?>
                        <option value="<?php echo $row['Id_obat']; ?>">
                            <?php echo $row['Nama_obat']; ?> (Stok: <?php echo $row['Stok']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Jumlah" class="form-label">Jumlah Obat</label>
                <input type="number" name="Jumlah" id="Jumlah" class="form-control" placeholder="Jumlah Obat" required>
            </div>
            <div class="mb-3">
                <label for="Nama_pembeli" class="form-label">Nama Pembeli</label>
                <input type="text" name="Nama_pembeli" id="Nama_pembeli" class="form-control" placeholder="Nama Pembeli" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-custom">Tambah Penjualan</button>
        </form>

        <!-- Data Penjualan -->
        <center><h2 class="mt-4">Daftar Penjualan</h2></center>

        <div class="table-container">
            <table class="table table-striped table-custom" style="width: 90%;">
                <thead>
                    <tr>
                        <th>Id Penjualan</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data_penjualan)): ?>
                        <tr>
                            <td><?php echo $row['Id_penjualan']; ?></td>
                            <td><?php echo $row['Nama_pembeli']; ?></td>
                            <td><?php echo $row['Nama_obat']; ?></td>
                            <td><?php echo $row['Jumlah']; ?></td>
                            <td><?php echo number_format($row['Total_harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $row['Tanggal']; ?></td>
                            <td>
                                <a href="cetakstruk.php?Id_penjualan=<?php echo $row['Id_penjualan']; ?>" class="btn btn-primary btn-sm" target="_blank">Cetak Struk</a>
                                <a href="penjualan.php?hapus=<?php echo $row['Id_penjualan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="notification">
            <strong>Catatan:</strong> Pastikan untuk selalu memeriksa stok obat sebelum melakukan penjualan.
        </div>
        <br>
        <div class="text-end mt-4">
            <a href="tampil.php" class="boxed-btn">Kembali ke Halaman Tampil</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
