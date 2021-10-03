<?php 

include "../config/database.php";

class oop {
	
	function simpan($table, array $field, $redirect) {
		global $konek;
		$sql = "INSERT INTO $table SET";
		foreach ($field as $key => $value) {
			$sql.=" $key = '$value',";
		}
		$sql = rtrim($sql,',');
		$jalan = mysqli_query($konek, $sql);
		if ($jalan) {
			echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
		} else {
			echo mysqli_error();
		}
	}

	function tampil($table) {
		global $konek;
		$sql = "SELECT * FROM $table";
		$result = mysqli_query($konek, $sql);
		while ($data = mysqli_fetch_array($result))
            $isi[] = $data;
        return @$isi;
	}

	function hapus($table, $where, $redirect) {
		global $konek;
		$sql = "DELETE FROM $table WHERE $where";
		$query = mysqli_query($konek, $sql);
		if ($query) {
			echo "<script>alert('Berhasil');document.location.href='$redirect';</script>";
		} else {
			echo mysqli_error();
		}
	}

	function edit($table,$where) {
		global $konek;
		$sql = "SELECT * FROM $table WHERE $where";
		$query = mysqli_query($konek, $sql);
		$jalan = mysqli_fetch_array($query);
		return $jalan;
	}

	function ubah($table, array $field, $where, $redirect) {
		global $konek;
		$sql = "UPDATE $table SET";
		foreach ($field as $key => $value) {
			$sql.=" $key = '$value',";
		}
		$sql = rtrim($sql, ',');
		$sql.= "WHERE $where";
		$query = mysqli_query($konek, $sql);

		if ($query) {
			echo "<script>alert('Berhasil');document.location.href='$redirect';</script>";
		} else {
			echo mysqli_error();
		}
	}

	function upload($foto, $tempat) {
	$NF = $_FILES['foto']['name'];
	$UF = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$PS = $_FILES['foto']['tmp_name'];

	if ( $error === 4 ) {
		echo "<script>
				alert('Masukan gambar terlebih dahulu');
			</script>";
		return false;
	}

	$KTF = ['jpg', 'jpeg', 'png'];
	$TF = explode('.', $NF);
	$TF = strtolower(end($TF));
	if (!in_array($TF, $KTF)) {
		echo "<script>
				alert('Jenis file yang anda masukkan salah');
			</script>";
		return false;
	}

	if ($UF > 5000000) {
		echo "<script>
				alert('Ukuran file terlalu besar');
			</script>";
		return false;
	}

	$NFN = uniqid();
	$NFN .= '.';
	$NFN .= $TF;

	move_uploaded_file($PS, '../images/' . $NFN);

	return $NFN;
	}

	function login($table, $username, $password, $nama_form) {
		global $konek;
		$sql = "SELECT * FROM $table WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($konek,$sql);
		$tampil = mysqli_fetch_array($result);
		$cek = mysqli_num_rows($result);

		if (mysqli_num_rows($result) === 1) {
			
			if ($password == True) {

				$_SESSION["login"] = true;
				$_SESSION["username"] = $username;
				$_SESSION['table'] = $table;

				header("Location: $nama_form");
			exit;
			} 
		}

		$error = True;
	}
}


 ?>