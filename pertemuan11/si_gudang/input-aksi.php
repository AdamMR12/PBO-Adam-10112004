<?php
ini_set('display_error',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

include "koneksi.php";
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerja = $_POST['pekerjaan'];

mysqli_query($koneksi, "insert into user(nama,alamat,pekerjaan)values('$nama','$alamat','$pekerja')");
header("location:index.php?pesan=input");
?>