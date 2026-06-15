<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membuat CRUD dengan php dan mysql</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="judul"><a href="index.php">
        <h1>membuat CRUD dengan php dan mysql</h1>
        <h2>menampilkan data dari database</h2>
        </a>
    </div>
    <div class="menu">
         <ul>
            <li><a href="data_user.php">Data User</a></li>
            <li><a href="data_barang.php">Data Barang</a></li>
            <li><a href="data_customer.php">Data Customer</a></li>
            <li><a href="data_supplier.php">Data Supplier</a></li>
            <li><a href="data_transaksi.php">Data Transaksi</a></li>
            <li><a href="">LOGOUT</a></li>
        </ul>
    </div>
    <br>

    <?php
    if(isset($_GET['pesan'])){
        $pesan = $_GET['pesan'];
        if($pesan == "input"){
            echo "data berhasil di input";
        }else if($pesan == "update"){
            echo "data berhasi; di update";
        }else if($pesan == "delete"){
            echo "data berhasil di hapus";
        }
    }
    ?>

    <br>
    <a href="input_barang.php" class="tombol">tambah data baru</a>

    <h3>data user</h3>
    <table class="table" border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Kode Jenis</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>opsi</th>
        </tr>
        <?php
        include "koneksi.php";
        $query_mysql = mysqli_query($koneksi, "select * from tb_barang");
        $nomor = 1;
        while($data = mysqli_fetch_array($query_mysql)){
        ?>

        <tr>
            <td><?php echo $data['kd_barang'] ?></td>
            <td><?php echo $data['kode_jenis'] ?></td>
            <td><?php echo $data['nama_barang']; ?></td>
            <td><?php echo $data['stok']; ?></td>
            <td><?php echo $data['harga_beli']; ?></td>
            <td><?php echo $data['harga_jual']; ?></td>
            <td>
                <a href="edit_barang.php?id=<?= $data['kd_barang'] ?>" class="edit"> Edit</a>
                |
                <a href="hapus.php?action=barang&id=<?= $data['kd_barang'] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php }?>
    </table>
</body>
</html>
