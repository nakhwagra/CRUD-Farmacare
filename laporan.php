<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani form filter berdasarkan tanggal (misal: harian atau bulanan)
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01'); // Default tanggal mulai 1 bulan lalu
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t'); // Default tanggal akhir bulan ini

$query = "SELECT p.*, o.Nama_obat, o.Harga, k.Nama_karyawan 
          FROM penjualan p 
          JOIN obat o ON p.Id_obat = o.Id_obat 
          JOIN karyawan k ON p.Id_karyawan = k.Id_karyawan 
          WHERE p.Tanggal BETWEEN '$start_date' AND '$end_date'
          ORDER BY p.Tanggal ASC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e9f7f9; /* Warna latar belakang kalem, biru muda */
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 30px auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .header h2 {
        margin: 0;
        color: #4CAF50; /* Hijau lebih lembut */
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .table th, .table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #4CAF50; /* Hijau kalem */
        color: white;
    }
    .table td {
        background-color: #f1f8f3; /* Hijau muda untuk sel */
    }
    .btn-print {
        display: block;
        margin: 30px auto;
        padding: 10px 20px;
        background-color: #4CAF50; /* Hijau kalem */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-print:hover {
        background-color: #45a049; /* Hijau lebih gelap untuk efek hover */
    }
    .filter-form {
        text-align: center;
        margin-bottom: 20px;
    }
    .filter-form input[type="date"] {
        padding: 5px;
        margin: 0 10px;
    }
    .thank-you {
        font-size: 16px;
        margin-top: 20px;
        font-style: italic;
        color: #666;
    }
</style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Laporan Penjualan</h2>
        <p>Berikut adalah laporan penjualan dalam rentang tanggal yang dipilih.</p>
    </div>

    <!-- Form Filter Laporan berdasarkan Tanggal -->
    <div class="filter-form">
        <form method="POST" action="">
            <label for="start_date">Dari Tanggal:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>" required>
            <label for="end_date">Sampai Tanggal:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>" required>
            <button type="submit" class="btn-print">Tampilkan Laporan</button>
        </form>
    </div>

    <!-- Daftar Penjualan -->
    <table class="table">
        <tr>
            <th>ID Penjualan</th>
            <th>Nama Obat</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th>
            <th>Nama Karyawan</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['Id_penjualan']; ?></td>
                <td><?php echo $row['Nama_obat']; ?></td>
                <td>Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['Jumlah']; ?></td>
                <td>Rp <?php echo number_format($row['Total_harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['Tanggal']; ?></td>
                <td><?php echo $row['Nama_karyawan']; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Tidak ada transaksi untuk rentang tanggal yang dipilih.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="thank-you">
        <center>
        <p>Terima kasih atas kerja kerasnya di Farmacare.</p>
        <p>Teruslah berkomitmen untuk memberikan layanan terbaik dan obat-obatan berkualitas tinggi untuk kesehatan pelanggan. Semoga hari Anda sehat dan menyenangkan.</p>
        </center>
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Laporan</button>
</div>

</body>
</html>
