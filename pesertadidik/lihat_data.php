<?php 
include "../config/database.php";

$username = $_SESSION['username'];

$sql = "SELECT * FROM query_siswa WHERE nis = '$username'";
$result = mysqli_query($konek, $sql);

if (empty($_SESSION['username'])) {
	echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Siswa</title>
</head>
<body>
<h1 align="center">Berikut Data Diri Anda : </h1>
<table align="center">
<?php foreach ($result as $row) :?>
	<tr>
		<td></td>
		<td><img border="5" height="175" width="155" src="../images/<?php echo $row['foto']; ?>"></td>
		<td></td>
	</tr>
</table>
<table align="center">	
	<tr>
		<td>NIS</td>
		<td>:</td>
		<td><?php echo $row['nis']; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $row['nama']; ?></td>
	</tr>
	<tr>
		<td>Kelamin</td>
		<td>:</td>
		<td><?php echo $row['jk']; ?></td>
	</tr>
	<tr>
		<td>Rayon</td>
		<td>:</td>
		<td><?php echo $row['rayon']; ?></td>
	</tr>
	<tr>
		<td>Rombel</td>
		<td>:</td>
		<td><?php echo $row['rombel']; ?></td>
	</tr>
	<tr>
		<td>Tgl Lahir</td>
		<td>:</td>
		<td><?php echo $row['tgl_lahir']; ?></td>
	</tr>
<?php endforeach ?>
</table>
<br>
</body>
</html>