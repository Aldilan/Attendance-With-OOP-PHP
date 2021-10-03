<?php 

session_start();

require "../config/database.php";
require "../library/controllers.php";

$perintah = new oop();

if (isset($_POST['login'])) {
	$table = "tbl_user";
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$nama_form ="hal_admin.php?menu=home";
	$perintah->login($table, $username, $password, $nama_form);
}

if (isset($_POST['batal'])) {
	echo "<script>document.location.href='../'</script>";
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>
<form method="post" action="">
	<table align="center">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="user"></td>
		</tr>
		<tr>
			<td>password</td>
			<td>:</td>
			<td><input type="password" name="pass"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="login" value="LOGIN">
				<input type="submit" name="batal" value="BATAL">
			</td>
		</tr>
	</table>	
</form>
</body>
</html>