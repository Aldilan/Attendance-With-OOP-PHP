<?php 
include "../config/database.php";

$perintah = new oop();

@$table = "tbl_rombel";
@$id = $_GET['id'];
@$where = "id_rombel = $id";
@$redirect = "?menu=rombel";
@$field = array('rombel' => $_POST['rombel']);

if (isset($_POST['simpan'])) {
	$perintah->simpan($table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
	$perintah->hapus($table, $where, $redirect);
}

if (isset($_GET['edit'])) {
	$edit = $perintah->edit($table, $where);
}

if (isset($_POST['ubah'])) {
	$perintah->ubah($table, $field, $where, $redirect);
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post">
	<table align="center">
		<tr>
			<td>Rombel</td>
			<td>:</td>
			<td><input type="text"  name="rombel" value="<?= @$edit['rombel']; ?>" required placeholder="Rombel"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<?php if (@$_GET['id'] == "" ) { ?>
					<input type="submit" name="simpan" value="Simpan">
				<?php } else { ?>
					<input type="submit" name="ubah" value="Ubah">
				<?php } ?>
			</td>
		</tr>
	</table>
</form>
<br>
<table align="center" border="1">
	<tr>
		<td>No</td>
		<td>Rombel</td>
		<td colspan="2">Aksi</td>
	</tr>
	<?php 
	$a = $perintah->tampil($table);
	$no = 0;
	if ($a == "") {
		echo "<tr><td align = 'center' colspan='4'>NO RECORD</td></tr>";
	} else {
		foreach ($a as $r) {
			$no++;
	?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $r['rombel']; ?></td>
				<td><a href="?menu=rombel&edit&id=<?php echo $r['id_rombel']; ?>"><img src="../images/b_change.png" width="15px" height="15px"></a></td>
				<td><a href="?menu=rombel&hapus&id=<?php echo $r['id_rombel']; ?>" onClick="return confirm ('Hapus Data ?')" >
					<img src="../images/b_drop.png" width="15px" height="15px"></a>
				</td>
			</tr>
		<?php }
	} ?>
</table>
<br>
</body>
</html>