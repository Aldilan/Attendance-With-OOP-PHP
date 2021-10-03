<?php 
date_default_timezone_set('Asia/Bangkok');
 ?>

<?php 
include "../config/database.php";

$perintah = new oop();

if (!empty($_GET['rombel'])) {
	$sql = "SELECT * FROM tbl_siswa WHERE nis = '$username'";
	$result = mysqli_query($konek, $sql);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Absensi</title>
</head>
<body>
<br>
<center>
	<font size="+3">Form Laporan Absensi</font>
</center>
<hr>
<form method="post">
	<table align="center">
		<tr>
			<td>Pilih Rombel</td>
			<td>:</td>
			<td>
				<select name="rombel">
					<?php foreach ($result as $row) :?>
					<option value="<?php echo $row['id_rombel']; ?>"><?php echo $row['rombel']; ?></option>
					<?php endforeach ?>
					<?php 
					$a = $perintah->tampil("tbl_rombel");
					foreach ($a as $r) :?>
					 	<option value="<?php echo $r['rombel']; ?>"><?php echo $r['rombel']; ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td><input type="submit" name="cetak" value="Cetak"></td>
		</tr>
	</table>
<br>
	<?php 
	if (isset($_POST['cetak'])) {
		echo "<script>document.location.href='laporan_today.php?menu=laporan&rombel=$_POST[rombel]'</script>";
	}
 ?>
</form>
</body>
</html>