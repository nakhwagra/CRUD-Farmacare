<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
// menginput data ke database
mysqli_query($koneksi,"insert into user values('','$nama','$username','$password', '$level')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampil.php");
 
?>