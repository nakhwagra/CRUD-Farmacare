<?php
include 'koneksi.php';

// Cek apakah ada parameter Id_penjualan yang diteruskan
if (isset($_GET['Id_penjualan'])) {
    $Id_penjualan = $_GET['Id_penjualan'];

    // Ambil data penjualan berdasarkan Id_penjualan
    $query = "SELECT p.*, o.Nama_obat, p.Nama_pembeli, k.Nama_karyawan 
              FROM penjualan p 
              JOIN obat o ON p.Id_obat = o.Id_obat
              JOIN karyawan k ON p.Id_karyawan = k.Id_karyawan
              WHERE p.Id_penjualan = '$Id_penjualan'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "Data penjualan tidak ditemukan!";
        exit;
    }
} else {
    echo "ID penjualan tidak diterima!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: gray;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }
        .header p {
            font-size: 16px;
            color: #555;
        }
        .content {
            margin-bottom: 30px;
            font-size: 16px;
        }
        .content p {
            margin: 8px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 16px;
            color: #555;
        }
        .footer p {
            margin-bottom: 5px;
        }
        .struk {
            margin-top: 20px;
            padding: 20px;
            border: 1px dashed #007bff;
            text-align: center;
            background-color: #f4c2c1;
            border-radius: 10px;
        }
        .struk p {
            margin: 10px 0;
            font-size: 18px;
        }
        .struk .total {
            font-size: 20px;
            font-weight: bold;
            color: red;
            margin-top: 10px;
        }
        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-print:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Struk Penjualan</h1>
        <p>Farmacare Apotek</p>
    </div>

    <div class="content">
        <p><strong>Nama Pembeli:</strong> <?php echo $data['Nama_pembeli']; ?></p>
        <p><strong>Nama Obat:</strong> <?php echo $data['Nama_obat']; ?></p>
        <p><strong>Jumlah:</strong> <?php echo $data['Jumlah']; ?> pcs</p>
        <p><strong>Total Harga:</strong> Rp <?php echo number_format($data['Total_harga'], 0, ',', '.'); ?></p>
        <p><strong>Tanggal:</strong> <?php echo date("d-m-Y H:i:s", strtotime($data['Tanggal'])); ?></p>
    </div>

    <div class="struk">
        <p><strong>Terima kasih telah berbelanja!</strong></p>
        <p>Farmacare Apotek</p>
        <p class="total">Total Pembayaran: Rp <?php echo number_format($data['Total_harga'], 0, ',', '.'); ?></p>
    </div>

    <div class="footer">
        <p>Nama Karyawan: <?php echo $data['Nama_karyawan']; ?></p>
        <p>Alamat Apotek: Jl. Kesehatan No. 123, Jakarta</p>
        <p>Telp: (021) 12345678</p>
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Struk</button>
</div>

</body>
</html>
