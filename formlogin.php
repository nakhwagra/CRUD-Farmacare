<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #1e2a3a; /* Biru gelap */
            height: 100vh; /* Mengatur tinggi halaman */
            display: flex;
            align-items: center; /* Mengatur posisi vertikal ke tengah */
            justify-content: center; /* Mengatur posisi horizontal ke tengah */
            margin: 0; /* Menghilangkan margin default */
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff; /* Warna putih untuk konten */
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3); /* Bayangan yang lebih jelas */
            text-align: center; /* Memusatkan teks di dalam container */
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
    <div class="login-container">
        <img src="fc.jpg" alt="Logo" class="logo"> <!-- Ganti 'logo.jpg' dengan path logo Anda -->
        <h3>-- LOGIN --</h3>
        <form method="POST" action="ceklogin.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <button type="button" class="btn btn-warning w-100 mt-2">Batal</button>
        </form>
        <div class="footer">
            <p>Belum punya akun? <a href="register.php" style="color: #007bff;">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>
