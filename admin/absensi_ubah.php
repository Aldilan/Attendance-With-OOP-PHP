<?php 
date_default_timezone_set('Asia/Bangkok');
 ?>
<?php 
include "../config/database.php";

$perintah = new oop();

@$tgl= $_GET['tgl'];
@$bln = $_GET['bln'];
@$thn = $_GET['thn'];

@$id = $_GET['id'];
@$where = "nis = $id";
@$query = "query_absen";
@$table = "tbl_rombel";

if (!empty($_GET['rombel'])) {
    $isinya = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
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
                <option value="<?= @$isinya['id_rombel'] ?>"><?= @$isinya['rombel'] ?></option>
                <?php 
                    $a = $perintah->tampil("tbl_rombel");
                    foreach ($a as $r) { ?>
                        <option value="<?= $r['0'] ?>"><?= $r['1'] ?></option>
                <?php } ?>
            </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Absen</td>
            <td>:</td>
            <td>
            <select name="tgl">
                <option value="<?= @$tgl ?>"><?= @$tgl ?></option>
                <?php 
                for ($tgl=1; $tgl <= 31; $tgl++) { 
                    if ($tgl <= 9) {
                ?>
                        <option value="<?= "0".$tgl; ?>"><?php echo "0".$tgl; ?></option>
                    <?php } else { ?>
                        <option value="<?= $tgl; ?>"><?php echo $tgl; ?></option>
                    <?php } 
                } ?>
            </select>
            <select name="bln">
                <option value="<?= @$bln ?>"><?= @$bln ?></option>
                <?php 
                for ($bln=1; $bln <= 12; $bln++) { 
                    if ($bln <= 9) {
                 ?>
                    <option value="<?= '0'.$bln; ?>"><?php echo "0".$bln; ?></option>
                <?php } else { ?>
                    <option value="<?= $bln; ?>"><?php echo $bln; ?></option>
                <?php  }
                } ?>
            </select>
            <select name="thn">
                <option value="<?= @$thn ?>"><?= @$thn ?></option>
                <?php 
                for ($thn=2011; $thn <= 2022 ; $thn++) { 
                 ?>
                    <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php } ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><center><button type="submit" name="lihat">Lihat</button></center></td>
        </tr>
    </table>
    <?php 
    if (isset($_POST['lihat'])) {
        $r = $_POST['rombel'];
        $t = $_POST['thn'];
        $b = $_POST['bln'];
        $h = $_POST['tgl'];
        echo "<script>document.location.href='?menu=ubahabsen&rombel=$_POST[rombel]&thn=$_POST[thn]&bln=$_POST[bln]&tgl=$_POST[tgl]';</script>";
    }

    if (!empty($_GET['rombel'])) {
     ?>
     <table border="1" cellspacing="0" align="center">
        <tr align="center">
            <td rowspan="2">No</td>
            <td rowspan="2">Nis</td>
            <td rowspan="2">Nama</td>
            <td rowspan="2">Rombel</td>
            <td colspan="4" align="center">Keterangan</td>
        </tr>
        <tr>
            <td>Hadir</td>
            <td>Sakit</td>
            <td>Ijin</td>
            <td>Alpa</td>
        </tr>
        <?php 
            $a = $perintah->tampil("query_absen WHERE id_rombel = '$_GET[rombel]' and tgl_absen = '$_GET[thn]-$_GET[bln]-$_GET[tgl]'");
            $no = 0;
            if ($a == "") {
                echo "<tr><td align='center' colspan='8'>No Record</td></tr>";
            } else {
                foreach ($a as $row) {
                    $no++;
                    if ($row['hadir'] == 1) {
                        $hadir = "checked";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "";
                    }
                    if ($row['sakit'] == 1) {
                        $hadir = "";
                        $sakit = "checked";
                        $ijin = "";
                        $alpa = "";
                    }
                    if ($row['ijin'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "checked";
                        $alpa = "";
                    }
                    if ($row['alpa'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "checked";
                    }
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['rombel'] ?></td>
            <td>
                <input type="radio" name="keterangan<?= $row['nis'] ?>" value="hadir" <?= $hadir ?>>
            </td>
            <td>
                <input type="radio" name="keterangan<?= $row['nis'] ?>" value="sakit" <?= $sakit ?>>
            </td>
            <td>
                <input type="radio" name="keterangan<?= $row['nis'] ?>" value="ijin" <?= $ijin ?>>
            </td>
            <td>
                <input type="radio" name="keterangan<?= $row['nis'] ?>" value="alpa" <?= $alpa ?>>
            </td>
        </tr>
        <?php
            $tgl = $_GET['thn']."-".$_GET['bln']."-".$_GET['tgl'];
            $table = "tbl_absen";
            $redirect = '?menu=ubahabsen';
            $n = $row['nis'];
            $tbabsen = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM `tbl_absen` WHERE tgl_absen = '$tgl' AND nis = $n"));
            $id_absen = $tbabsen['id_absen'];
            $where = "nis = $n AND id_absen = $id_absen ";
            if (@$_POST['keterangan' . $n] == 'hadir') {
                $field = array( 'nis' => $n, 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl, 'id_absen' => $id_absen );
            } elseif (@$_POST['keterangan' . $n] == 'sakit') {
                $field = array( 'nis' => $n, 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl, 'id_absen' => $id_absen );
            } elseif (@$_POST['keterangan' . $n] == 'ijin') {
                $field = array( 'nis' => $n, 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl, 'id_absen' => $id_absen );
            } else {
                $field = array( 'nis' => $n, 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl, 'id_absen' => $id_absen );
            }

            if (isset($_REQUEST['ubah'])) {
                $perintah->ubah($table, $field, $where, $redirect);
            }
        }
    }
        ?>
        <tr>
            <td colspan="10" align="center">
                <button type="submit" name="ubah">Ubah</button>
            </td>
        </tr>
<?php } ?>
    </table>
</form>
</body>
</html>
