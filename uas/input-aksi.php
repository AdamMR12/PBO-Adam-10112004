<?php
ini_set('display_error',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

include "koneksi.php";

$action = $_GET['action'];
if($action == "user"){
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerja = $_POST['pekerjaan'];

$query = mysqli_query($koneksi, "insert into user(nama,alamat,pekerjaan)values('$nama','$alamat','$pekerja')");
if(!$query){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil ditambah.');window.location='data_user.php';</script>";
}
}else if($action == "barang"){
$jenis = $_POST['kode_jenis'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$beli = $_POST['beli'];
$jual = $_POST['jual'];

$query = mysqli_query($koneksi, "INSERT INTO tb_barang (kode_jenis,nama_barang,stok,harga_beli,harga_jual,gambar_produk) VALUES ('$jenis', '$nama', '$stok', '$beli', '$jual', null)");
if(!$query){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
} else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil ditambah.');window.location='data_barang.php';</script>";
}
}else if($action == "jenis"){
$kode = $_POST['kode'];
$jenis = $_POST['jenis'];
$satuan = $_POST['satuan'];
$query = mysqli_query($koneksi, "INSERT INTO tb_jenis (kode_jenis,jenis,satuan) VALUES ('$kode', '$jenis', '$satuan')");
if(!$query){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
} else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil ditambah.');window.location='input_barang.php';</script>";
}
}
?>