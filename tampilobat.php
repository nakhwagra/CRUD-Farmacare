<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'apotik';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM obat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Data Obat</title>
</head>
<body>
    <header>
        <h1>Data Obat</h1>
        <a href="logout.php">Logout</a>
    </header>
    <div class="container">
        <h2>Daftar Obat</h2>
        <table border="1">
            <tr>
                <th>Id_obat</th>
                <th>Nama_obat</th>
                <th>Jenis_obat</th>
                <th>Dosis</th>
                <th>Harga</th>
                <th>Tgl_kadaluarsa</th>
                <th>Stok</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Id_obat']; ?></td>
                <td><?php echo $row['Nama_obat']; ?></td>
                <td><?php echo $row['Jenis_obat']; ?></td>
                <td><?php echo $row['Dosis']; ?></td>
                <td><?php echo $row['Harga']; ?></td>
                <td><?php echo $row['Tgl_kadaluarsa']; ?></td>
                <td><?php echo $row['Stok']; ?></td>
                <td>
                    <a href="ubahobat.php?id=<?php echo $row['Id_obat']; ?>">Ubah</a>
                    <a href="hapusobat.php?id=<?php echo $row['Id_obat']; ?>">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="tambahobat.php">Tambah Obat</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
