<?php
include "koneksi.php";
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerja = $_POST['pekerjaan'];

mysqli_query($koneksi, "update user set nama='$nama', alamat='$alamat', pekerjaan='$pekerja' where id_user='$id'");
header("location:index.php?pesan=update");
?>