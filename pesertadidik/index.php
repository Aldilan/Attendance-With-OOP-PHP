<?php 
session_start();

if (isset($_SESSION["username"])) {
	header("Location: hal_peserta_didik.php?menu=home");
	exit;
}

include "../config/database.php";

if (isset($_POST['login'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$result = mysqli_query($konek, "SELECT * FROM tbl_siswa WHERE nis = '$user'");
	if (mysqli_num_rows($result) === 1) {
		$_SESSION['username'] = $_POST['user'];
		$_SESSION['password'] = $_POST['pass'];
		foreach ($result as $row) {
			$nama = $row['nama'];
		}
		echo "<script>alert('Selamat datang $nama');document.location.href='hal_peserta_didik.php?menu=home'</script>";
	} else {
			echo "<script>alert('Username dan Password Tidak Sesuai!!');document.location.href='index.php'</script>";
	}
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
 <form method="post">
 	<table align="center">
 		<tr>
 			<td>Username</td>
 			<td>:</td>
 			<td><input type="text" name="user"></td>
 		</tr>
 		<tr>
 			<td>Password</td>
 			<td>:</td>
 			<td><input type="password" name="pass"></td>
 		</tr>
 		<tr>
 			<td></td>
 			<td></td>
 			<td><input type="submit" name="login" value="LOGIN">
 				<input type="submit" name="batal" value="BATAL"></td>
 		</tr>
 	</table>
 </form>
 </body>
 </html>