<?php 

if (isset($_SESSION["username"])) {
	header("Location: pesertadidik/hal_peserta_didik.php?menu=home");
	exit;
}	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SIM ABSENSI</title>
</head>
<body>
	<?php 
		if (isset($_POST['admin'])) {
			echo "<script>document.location.href='admin'</script>";
		}
		if (isset($_POST['pd'])) {
			echo "<script>document.location.href='pesertadidik'</script>";
		}
	 ?>
	 <form method="post">
	 	<table align="center">
	 		<tr>
	 			<td colspan="2" align="center">Login Sebagai :</td>
	 		</tr>
	 		<tr>
	 			<td><input type="submit" name="admin" value="Administrator"></td>
	 			<td><input type="submit" name="pd" value="Peserta Didik"></td>
	 		</tr>
	 	</table>
	 </form>
</body>
</html>