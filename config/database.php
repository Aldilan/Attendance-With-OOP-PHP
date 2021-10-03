<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "db_absensi";

$konek = mysqli_connect($server, $username, $password, $database);
mysqli_select_db($konek, $database);

 ?>