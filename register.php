<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Enkripsi password sebelum disimpan
    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $checkQuery = "SELECT * FROM register WHERE username = '$Username'";
    $checkResult = mysqli_query($koneksi, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username sudah terdaftar!";
    } else {
        // Simpan data pengguna ke database
        $query = "INSERT INTO register (Username, Password) VALUES ('$Username', '$PasswordHash')";
        $result = mysqli_query($koneksi, $query);
        
        if ($result) {
            echo "Pendaftaran berhasil! Silakan login.";
        } else {
            echo "Gagal mendaftar. Coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengguna</title>
    <style>
        /* Mengatur background halaman */
        body {
            background-color: #1e2a3a; /* Biru muda */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling untuk container form */
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff; /* Putih */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #f0f8ff, #e0ffe0); /* Gradasi biru muda ke hijau */
        }

        h3 {
            text-align: center;
            color: #007bff; /* Biru muda */
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff; /* Biru muda */
            background-color: #fff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff; /* Biru muda */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3; /* Biru lebih gelap */
        }

        /* Memberikan sedikit warna dan efek pada link */
        a {
            color: #ff69b4; /* Pink */
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsif pada layar kecil */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Form Pendaftaran -->
    <div class="container">
        <h3>Daftar Akun</h3>
        <form method="POST" action="register.php">
            <div>
                <label for="Username">Username</label>
                <input type="text" id="Username" name="Username" required>
            </div>
            <div>
                <label for="Password">Password</label>
                <input type="Password" id="Password" name="Password" required>
            </div>
            <button type="submit" name="register">Daftar</button>
        </form>
        <p style="text-align:center; font-size: 14px; margin-top: 15px;">
            Sudah punya akun? <a href="formlogin.php">Login di sini</a>
        </p>
    </div>

</body>
</html>
