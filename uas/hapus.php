<?php
include 'koneksi.php';

$action = $_GET['action'];
$id = $_GET['id']; 

if($action == "user"){
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");
    
    if(!$query){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data user berhasil dihapus.');window.location='data_user.php';</script>";
    }
    
} else if($action == "barang"){
    $query = mysqli_query($koneksi, "DELETE FROM tb_barang WHERE kd_barang='$id'");
    
    if(!$query){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data barang berhasil dihapus.');window.location='data_barang.php';</script>";
    }
}
?>