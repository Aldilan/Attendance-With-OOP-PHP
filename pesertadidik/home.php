<?php 

if ( !isset($_SESSION["username"])) {
	header("Location: index.php");
	exit;
}

include "../config/database.php";

$username = $_SESSION['username'];

$sql = "SELECT * FROM tbl_siswa WHERE nis = '$username'";
$result = mysqli_query($konek, $sql);

if (empty($_SESSION['username'])) {
	echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
	<title>SIM ABSENSI</title>
</head>
<body>
<?php foreach ($result as $row) :?>
	<h1 align="center">Welcome <a href="?menu=lihat_data" title="<?php echo $row['nama']; ?>">
		<?php echo $row['nama']; ?></a></h1>
	<h1 align="center">Sistem Absensi Versi 1.0</h1>
<?php endforeach ?>
</body>
</html>