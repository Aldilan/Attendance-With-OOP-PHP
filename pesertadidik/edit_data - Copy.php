<?php 
@session_start();

$username = $_SESSION['username'];

$sql = "SELECT * FROM query_siswa WHERE nis = '$username'";
$result = mysqli_query($konek, $sql);

if (empty($_SESSION['username'])) {
	echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}

foreach ($result as $row) :

if ($row['jk'] == "L") {
	$l = "checked";
	$p = "";
} else {
	$l = "";
	$p = "checked";
}


if (isset($_POST['ubah'])) {
	$date = explode("-", $row['tgl_lahir']);
	$thn = $date[0];
	$bln = $date[1];
	$tgl = $date[2];

	$perintah = new oop();
	$table = "tbl_siswa";
	$tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
	$field = array('nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'],
			'id_rombel' => $_POST['rombel'], 'tgl_lahir' => $tanggal);
	$where = "nis = $_GET[nis]";
	$redirect = "?menu=lihat_data";

	echo $peintah->ubah($table, $field, $where, $redirect);
	echo "ok";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Siswa</title>
</head>
<body>
<form method="post" action="">
	<table align="center">
		<tr>
			<td></td>
			<td><img border="5" height="175" width="155" src="../foto/<?php echo $row['foto']; ?>"></td>
			<td></td>
		</tr>
	</table>
	<table align="center">
		<tr>
			<td>NIS</td>
			<td>:</td>
			<td><?= $row['nis']; ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama" value="<?= $row['nama']; ?>"></td>
		</tr>
		<tr>
			<td>Kelamin</td>
			<td>:</td>
			<td><input type="radio" name="jk" value="L" <?= $l; ?> />Laki-laki
				<input type="radio" name="jk" value="P" <?= $p; ?> />Perempuan
			</td>
		</tr>
		<tr>
			<td>Rayon</td>
			<td>:</td>
			<td><select name="rayon">
				<option value="<?= $row['id_rayon']; ?>"><?php echo $row['rayon']; ?></option>
				<?php 
				$E = mysqli_query("SELECT * FROM tbl_rayon");
				while ($r = mysqli_fetch_array($E)) {
				 ?>
				 	<option value="<?php echo $r [0]; ?>"><?php echo $r[1]; ?></option>
				 <?php } ?>
			</select></td>
		</tr>
		<tr>
			<td>Rombel</td>
			<td>:</td>
			<td><select name="rombel">
				<option value="<?php echo $row['id_rombel']; ?>"><?php echo $row['rombel']; ?></option>
				<?php 
				$E = mysqli_query("SELECT * FROM tbl_rombel");
				while ($r = mysqli_fetch_array($E)) {
				 ?>
				 	<option value="<?php echo $r [0]; ?>"><?php echo $r[1]; ?></option>
				 <?php } ?>
			</select></td>
		</tr>
<?php endforeach ?>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><select name="tgl">
				<option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>
				<option value="">-------</option>
				<?php 
				for ($tgl=1; $tgl <= 31 ; $tgl++) { 
					if ($tgl <= 9) {
				 ?>
				 	<option value="<?php echo "0" . $tgl; ?>"><?php echo "0" . $tgl; ?></option>
				<?php 
					} else {
				 ?>
				 	<option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>
				 <?php }
				 } ?>
			</select>
			<select name="bln">
				<option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
				<option value="">-------</option>
				<?php 
				for ($bln=1; $bln <= 12 ; $bln++) { 
					if ($bln <= 9) {
				 ?>
				 	<option value="<?php echo "0" . $bln; ?>"><?php echo "0" . $bln; ?></option>
				<?php 
					} else {
				 ?>
				 	<option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
				 <?php }
				 } ?>
			</select>

			<select name="thn">
				<option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
				<option value="">-------</option>
				<?php 
				for ($thn=1990; $thn <= 2012 ; $thn++) { 
				 ?>
				 	<option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
				 <?php } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="ubah" value="Ubah">Ubah</td>
		</tr>
	</table>
</form>
</body>
</html>