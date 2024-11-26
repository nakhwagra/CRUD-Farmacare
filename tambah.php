<!DOCTYPE html>
<html>
<head>
	<title>tambah data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>::after
table {
    padding: 20px;
}
tr, th, td {
    padding: 10px;
    margin: 20px;
    text-align: center;
}
</style>

</head>
<body>
	<br/>
    <form method="POST" action="tampil.php">
    <button type="input" class="btn btn-outline-primary">Tampil</button>
</form>
	<br/>
	<br/>
	<h3>TAMBAH DATA Pengguna</h3>
    <div class="mb-3">
	<form method="post" action="inputuser.php">
		<table  class="table">
			<tr>
				<td>nama lengkap</td>
				<td><input class="form-control form-control-lg"  type="text" name="nama"></td>
			</tr>
			<tr>			
				<td>username</td>
				<td><input class="form-control form-control-lg"  type="text" name="username"></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input class="form-control form-control-lg"  type="password" name="password"></td>
			</tr>
			<tr>
				<td>level</td>
				<td><input  class="form-control form-control-lg" type="text" name="level"></td>
			</tr>
			<tr>
				<td colspan=3>
                <button type="input" class="btn btn-outline-primary">Simpan</button> </td>
				
			</tr>		
		</table>
	</form>
    </div>
</body>
</html>