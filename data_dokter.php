<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:formlogin.php");
    exit;
}

include 'koneksi.php';

// Menangani penambahan data dokter
if (isset($_POST['tambah'])) {
    $Id_Dokter = $_POST['Id_Dokter'];
    $Nama_Dokter = $_POST['Nama_Dokter'];
    $Spesialisasi = $_POST['Spesialisasi'];
    $Telepon = $_POST['Telepon'];
    $Email = $_POST['Email'];
    
    // Menangani upload gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek jika file gambar adalah gambar sebenarnya atau palsu
    if (isset($_POST["tambah"])) {
        $check = getimagesize($_FILES["Foto"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["Foto"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Hanya izinkan format gambar tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Jika semua cek berhasil, upload file
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO dokter (Id_Dokter, Nama_Dokter, Spesialisasi, Telepon, Email, Foto) 
                      VALUES ('$Id_Dokter', '$Nama_Dokter', '$Spesialisasi', '$Telepon', '$Email', '$target_file')";
            mysqli_query($koneksi, $query);
            header("Location: data_dokter.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Menangani penghapusan data dokter
if (isset($_GET['hapus'])) {
    $Id_Dokter = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM dokter WHERE Id_Dokter = '$Id_Dokter'");
    header("Location: data_dokter.php");
}

// Menangani pengubahan data dokter
if (isset($_POST['ubah'])) {
    $Id_Dokter = $_POST['Id_Dokter'];
    $Nama_Dokter = $_POST['Nama_Dokter'];
    $Spesialisasi = $_POST['Spesialisasi'];
    $Telepon = $_POST['Telepon'];
    $Email = $_POST['Email'];

    // Menangani upload gambar
    if ($_FILES["Foto"]["name"] != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
        move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file);
        $foto = ", Foto = '$target_file'";
    } else {
        $foto = "";
    }

    $query = "UPDATE dokter SET 
        Nama_Dokter='$Nama_Dokter', 
        Spesialisasi='$Spesialisasi', 
        Telepon='$Telepon', 
        Email='$Email' 
        $foto
        WHERE Id_Dokter='$Id_Dokter'";
    mysqli_query($koneksi, $query);
    header("Location: data_dokter.php");
}

// Menangani pengiriman pesan
if (isset($_POST['kirim_pesan'])) {
    $Id_Dokter = $_POST['Id_Dokter'];
    $Isi_pesan = $_POST['Isi_pesan'];
    $Tanggal = date('Y-m-d H:i:s');

    $query = "INSERT INTO pesan (Id_dokter, Isi_pesan, Tanggal) VALUES ('$Id_Dokter', '$Isi_pesan', '$Tanggal')";
    mysqli_query($koneksi, $query);
    header("Location: data_dokter.php?edit=$Id_Dokter");
}

// Menampilkan data dokter
$data_dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Data Dokter - Aplikasi Apotik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f7;
        }

        header {
            background-color: #00796b;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        form {
            margin-bottom: 30px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        td img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
        }

        a {
            color: #00796b;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            margin-top: 20px;
            color: #00796b;
        }

        .btn {
            background-color: #00796b;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Data Dokter</h1>
        <a href="logout.php" style="color:white;">Logout</a>
    </header>

    <div class="container">
        <h2>Tambah Dokter</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="number" name="Id_Dokter" placeholder="Id Dokter" required>
            <input type="text" name="Nama_Dokter" placeholder="Nama Dokter" required>
            <input type="text" name="Spesialisasi" placeholder="Spesialisasi" required>
            <input type="number" name="Telepon" placeholder="Telepon" required>
            <input type="email" name="Email" placeholder="Email" required>
            <input type="file" name="Foto" accept="image/*">
            <input type="submit" name="tambah" class="btn" value="Tambah">
        </form>

        <h2>Daftar Dokter</h2>
        <table>
            <tr>
                <th>Id Dokter</th>
                <th>Nama Dokter</th>
                <th>Spesialisasi</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data_dokter)): ?>
            <tr>
                <td><?php echo $row['Id_Dokter']; ?></td>
                <td><?php echo $row['Nama_Dokter']; ?></td>
                <td><?php echo $row['Spesialisasi']; ?></td>
                <td><?php echo $row['Telepon']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td>
                    <?php if ($row['foto']): ?>
                        <img src="<?php echo $row['foto']; ?>" alt="Foto Dokter">
                    <?php else: ?>
                        <span>No Foto</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="data_dokter.php?edit=<?php echo $row['Id_Dokter']; ?>">Ubah</a> |
                    <a href="data_dokter.php?hapus=<?php echo $row['Id_Dokter']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Form untuk ubah data dokter -->
        <?php if (isset($_GET['edit'])): ?>
        <?php
            $Id_Dokter = $_GET['edit'];
            $dokter_data = mysqli_query($koneksi, "SELECT * FROM dokter WHERE Id_Dokter='$Id_Dokter'");
            $dokter = mysqli_fetch_assoc($dokter_data);
        ?>
        <h2>Ubah Dokter</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="Id_Dokter" value="<?php echo $dokter['Id_Dokter']; ?>">
            <input type="text" name="Nama_Dokter" value="<?php echo $dokter['Nama_Dokter']; ?>" required>
            <input type="text" name="Spesialisasi" value="<?php echo $dokter['Spesialisasi']; ?>" required>
            <input type="number" name="Telepon" value="<?php echo $dokter['Telepon']; ?>" required>
            <input type="email" name="Email" value="<?php echo $dokter['Email']; ?>" required>
            <input type="file" name="Foto" accept="image/*">
            <input type="submit" name="ubah" class="btn" value="Ubah">
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
