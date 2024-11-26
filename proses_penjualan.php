<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id_obat = $_POST['Id_obat'];
    $Jumlah = $_POST['Jumlah'];
    $Tanggal = date('Y-m-d H:i:s');

    // Cek apakah stok cukup
    $stok_query = mysqli_query($koneksi, "SELECT Stok FROM obat WHERE Id_Obat='$Id_Obat'");
    $stok_data = mysqli_fetch_assoc($stok_query);

    if ($stok_data['Stok'] >= $jumlah) {
        // Masukkan data penjualan ke dalam tabel penjualan
        $query = "INSERT INTO penjualan (Id_Obat, Jumlah, Tanggal) VALUES ('$Id_Obat', '$Jumlah', '$Tanggal')";
        mysqli_query($koneksi, $query);

        // Update stok obat
        mysqli_query($koneksi, "UPDATE obat SET Stok = Stok - $Jumlah WHERE Id_Obat = '$Id_Obat'");

        header("Location: penjualan.php");
    } else {
        echo "Stok tidak cukup!";
    }
}
?>
