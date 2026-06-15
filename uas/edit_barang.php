<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membuat CRUD dengan php dan mysql</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="judul">
        <h1>membuat CRUD dengan php dan mysql</h1>
        <h2>menampilkan data dari database</h2>
    </div>
    <br>

    <a href="index.php">kembali</a>

    <br>
    <h3>edit data</h3>
    <?php
    include "koneksi.php";
    $id = $_GET['id'];
    $query_mysqli = mysqli_query($koneksi, "select * from tb_barang where kd_barang=".$id);
    $nomor = 1;
    while($data = mysqli_fetch_array($query_mysqli)){
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Kode Jenis</td>
                <td><?php
                        include "koneksi.php"; 
                        $jenis = mysqli_query($koneksi, "SELECT kode_jenis, jenis FROM tb_jenis");
                        
                    ?>
                    <select name="kode_jenis" id="kode_jenis" class="form-control">
                        <option value="">-- Pilih Jenis --</option>
                        <?php foreach($jenis as $j): ?>
                            <option value="<?php echo $j['kode_jenis']; ?>"><?php echo $j['jenis']; ?></option>
                        <?php endforeach; ?>
                    </select></td>
                    <td><button><a href="input_jenis.php">Tambah</a></button></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama_barang']?>"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" value="<?php echo $data['stok']?>"></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td><input type="text" name="beli" value="<?php echo $data['harga_beli']?>"></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="text" name="jual" value="<?php echo $data['harga_jual']?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>
    <?php } ?>
</body>
</html>
<?php
include "koneksi.php"; 
$jenis = $_POST['kode_jenis'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$beli = $_POST['beli'];
$jual = $_POST['jual'];
$query = mysqli_query($koneksi, "update tb_barang set kode_jenis='$jenis', nama_barang='$nama', stok='$stok', harga_beli='$beli', harga_jual='$jual', gambar_produk='null' where kd_barang='$id'");
if(!$query){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil diupdate.');window.location='data_barang.php';</script>";
}
?>