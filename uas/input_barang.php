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
    <h3>input data Barang</h3>
    <form action="input-aksi.php?action=barang" method="post">
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
                <td>Nama Barang</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="number" name="stok"></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td><input type="number" name="beli"></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="number" name="jual"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>