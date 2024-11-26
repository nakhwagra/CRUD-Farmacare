<?php
session_start();
include 'koneksi.php'; // Pastikan untuk menyertakan koneksi ke database

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $email = $_POST['email'];

    // Memasukkan data ke dalam database
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['message'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: form_login.php"); // Arahkan ke halaman login
        exit;
    } else {
        $_SESSION['error'] = "Pendaftaran gagal: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #343a40; /* Warna gelap */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff; /* Warna putih untuk konten */
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .logo {
            width: 100%; /* Membuat logo memenuhi lebar container */
            border-radius: 15px 15px 0 0; /* Membulatkan sudut atas logo */
            margin-bottom: 20px; /* Spasi antara logo dan judul */
        }
        h3 {
            margin-bottom: 20px;
            color: #343a40; /* Warna gelap untuk teks */
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff; /* Warna biru */
            border: none;
            border-radius: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="logo.jpg" alt="Logo" class="logo"> <!-- Ganti 'logo.jpg' dengan path logo Anda -->
        <h3>Daftar Akun</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" name="daftar" class="btn btn-primary w-100">Daftar</button>
        </form>
        <div class="footer">
            <p>Sudah punya akun? <a href="form_login.php" style="color: #007bff;">Login disini</a></p>
        </div>
    </div>
</body>
</html>
