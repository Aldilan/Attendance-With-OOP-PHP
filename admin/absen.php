<?php 
date_default_timezone_set('Asia/Jakarta');
require "../config/database.php";

$perintah = new oop();

if (!empty($_GET['rombel'])) {
	$isinya = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
	$id_rombel = $isinya['id_rombel'];
	$rombel = $isinya['rombel'];
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post" action="">
	<table align="center">
		<tr>
			<td>Pilih Rombel</td>
			<td>:</td>
			<td>
				<select name="rombel">
					<option value="<?= @$id_rombel ?>"><?= @$rombel ?></option>
					<?php 
						$a = $perintah->tampil("tbl_rombel");
						foreach ($a as $r) { ?>
							<option value="<?= $r[0] ?>"><?= $r[1] ?></option>
					<?php } ?>
				</select>
			</td>
			<td><input type="submit" name="cetak" value="Cetak"></td>
		</tr>
	</table>
<hr>
<?php 
	if (isset($_POST['cetak'])) {
		echo "<script>document.location.href='?menu=absen&rombel=$_POST[rombel]'</script>";
	}
	if (!empty($_GET['rombel'])) {
		$tgl_sekarang = date('Y-m-d');
		$query = "SELECT * FROM query_absen WHERE id_rombel = '$_GET[rombel]' AND tgl_absen = '$tgl_sekarang'";
		$cek = mysqli_fetch_array(mysqli_query($konek, $query));
		if (@$cek['tgl_absen'] == @$tgl_sekarang AND @$cek['id_rombel'] == @$_GET['rombel']) {
			echo "<script>alert('Rombel $rombel sudah diabsen hari ini');document.location.href='?menu=absen';</script>";
		} else {
 ?>
<br>
<table align="center" border="1">
	<tr>
		<td rowspan="2">No</td>
		<td rowspan="2">Nis</td>
		<td rowspan="2">Nama</td>
		<td rowspan="2">Rombel</td>
		<td colspan="4" align="center">Keterangan</td>
	</tr>
	<tr>
		<td>Hadir</td>
		<td>Sakit</td>
		<td>Izin</td>
		<td>Alpa</td>
	</tr>
	<?php 
		$no = 0;
		$sql = "SELECT * FROM query_siswa WHERE id_rombel = '$_GET[rombel]'";
		$query = mysqli_query($konek, $sql);
		$cek = mysqli_num_rows($query);

		if ($cek == "") {
			echo "<tr><td align='center' colspan='8'>No Record</td></tr>";
		} else {
			while ($r = mysqli_fetch_array($query)) {
				$no ++;
	 ?>
	 <tr>
	 	<td><?= $no ?></td>
	 	<td><?= $r['nis'] ?></td>
	 	<td><?= $r['nama'] ?></td>
	 	<td><?= $r['rombel'] ?></td>
	 	<td>
	 		<input type="radio" checked name="Keterangan<?= $r['nis'] ?>" value="hadir">
	 	</td>
	 	<td>
	 		<input type="radio" name="Keterangan<?= $r['nis'] ?>" value="sakit">
	 	</td>
	 	<td>
	 		<input type="radio" name="Keterangan<?= $r['nis'] ?>" value="ijin">
	 	</td>
	 	<td>
	 		<input type="radio" name="Keterangan<?= $r['nis'] ?>" value="alpa">
	 	</td>
	 </tr>
	 <?php 
	 	$tgl = date('Y-m-d');
	 	$table = "tbl_absen";
	 	$redirect = '?menu=absen';

	 	if (@$_POST['keterangan'.$r['nis']]=='hadir') {
	 		$field = array('nis' => $r['nis'], 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
	 	} elseif (@$_POST['keterangan' . $r['nis']] == 'sakit') {
                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
        } elseif (@$_POST['keterangan' . $r['nis']] == 'ijin') {
                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl);
        } else {
                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl);
        }

        if (isset($_REQUEST['simpan'])) {
        	$perintah->simpan($table, $field, $redirect);
        }
    }
}

	  ?>
	  <tr>
	  	<td colspan="10" align="center">
	  		<input type="submit" name="simpan" value="Simpan">
	  	</td>
	  </tr>
</table>
<?php 
	}
}
 ?>
</form>
<br>
</body>
</html>