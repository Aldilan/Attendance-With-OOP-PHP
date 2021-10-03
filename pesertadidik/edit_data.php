<?php 
@session_start();

require "../config/database.php";

$query = "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'";
$result = mysqli_query($konek, $query);
$query = mysqli_fetch_array($result);

if (empty($_SESSION['username'])) {
    echo "<script>
            alert('Anda Belum Melakukan Login');
            document.location.href='index.php';
        </script>";
}

$date = explode("-", $query['tgl_lahir']);
$thn = $date[0];
$bln = $date[1];
$tgl = $date[2];

if ($query['jk'] == "L") {
    $l = "checked"; 
} else {
    $p = "checked";
}

$perintah = new oop();
@$table = "tbl_siswa";
@$tanggal = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
@$field = array('nama' => $_POST['nama'],
				'jk' => $_POST['jk'],
				'tgl_lahir' => $tanggal);
@$where = "nis = $_GET[nis]";
@$redirect = "?menu=lihat_data";

if (isset($_POST['ubah'])) {
	echo $perintah->ubah($table, $field, $where, $redirect);
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
			<td><img src="../images/<?= $query['foto'] ?>" border="5" height="175" width="155"></td>
			<td></td>
		</tr>
	</table>
	<table align="center">
		<tr>
			<td>NIS</td>
			<td>:</td>
			<td><input type="text" name="nis" value="<?= $query['nis'] ?>"></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama" value="<?= $query['nama'] ?>"></td>
		</tr>
		<tr>
			<td>Kelamin</td>
			<td>:</td>
			<td><input type="radio" name="jk" value="L" <?= @$l ?>>Laki=laki
				<input type="radio" name="jk" value="P" <?= @$p ?>>Perempuan
		</tr>
		<tr>
			<td>Rayon</td>
			<td>:</td>
			<td><?= $query['rayon'] ?></td>
		</tr>
		<tr>
			<td>Rombel</td>
			<td>:</td>
			<td><?= $query['rombel'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td>
				 <select name="tgl">
                    <option value="<?= $tgl ?>"><?= $tgl ?></option>
                    <option value="">------</option>
                    <?php
                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                            if ($tgl <= 9) {
                    ?>
                    <option value="<?= "0" . $tgl; ?>"><?= "0" . $tgl; ?></option>
                    <?php
                            } else {
                                ;
                    ?>
                    <option value="<?= $tgl ?>"><?= $tgl ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <select name="bln">
                    <option value="<?= $bln ?>"><?= $bln ?></option>
                    <option value="">------</option>
                    <?php
                        for ($bln = 1; $bln <= 12; $bln++) {
                            if ($bln <= 9) {
                    ?>
                    <option value="<?= "0" . $bln; ?>"><?= "0" . $bln; ?></option>
                    <?php
                            } else {
                                ;
                    ?>
                    <option value="<?= $bln ?>"><?= $bln ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <select name="thn">
                    <option value="<?= $thn ?>"><?= $thn ?></option>
                    <option value="">------</option>
                    <?php
                        for ($thn = 1990; $thn <= 2021; $thn++) {
                    ?>
                    <option value="<?= $thn ?>"><?= $thn ?></option>
                    <?php
                        }
                    ?>
                </select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="ubah" value="Ubah"></td>
		</tr>
	</table>
</form>
</body>
</html>