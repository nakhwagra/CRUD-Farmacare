<!DOCTYPE html>
<head>
	<title>tampil data</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>::after
table {
    padding: 20px;
}
tr, th, td {
    padding: 10px;
    margin: 20px;
}
</style>
</head>
<body>
 <br>
    <form method="POST" action="tambah.php">
    <hr>
    <button type="input" class="btn btn-outline-primary">Tambah</button>
    <hr>
    </form>
	<table class="table table-striped">
		<tr>
			<th>Id Obat</th>
            <th>Nama Obat</th>
			<th>Jenist</th>
			<th>Dosis</th>
			<th>Harga</th>
			<th>Tanggal kadaluarsa</th>
			<th>Stok</th>
            <th>Aksi</th>
            
		</tr>
		<?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from obat");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
                <td><?php echo $d['Id_obat']; ?></td>
				<td><?php echo $d['Nama_obat']; ?></td>
				<td><?php echo $d['Jenis_obat']; ?></td>
				<td><?php echo $d['Dosis']; ?></td>
				<td><?php echo $d['Harga']; ?></td>
				<td><?php echo $d['Tgl_kadaluarsa']; ?></td>
				<td><?php echo $d['Stok']; ?></td>

                
				<td>
					<a role ="button" class="btn btn-info" href="ubah.php?id=<?php echo $d['Id_Produk']; ?>">UBAH</a> </button>
					<a role ="button" class="btn btn-danger" href="hapus.php?id=<?php echo $d['Id_Produk']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>