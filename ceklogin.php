<?php 
    session_start();
    include 'koneksi.php';
 
    // menangkap data yang dikirim dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // menyeleksi data pada tabel admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username' and password='$password'");

    if (!$data) {
        die("Query Error: " . mysqli_error($koneksi));
    }
    
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($data);
 
    if($cek > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:dashboard2.php");
    }
    else{
        
        echo "<script> alert ('login gagal ! username dan password tidak benar ');</script>";
        echo "<script> window.location ='formlogin.php';</script>";
    }
?>