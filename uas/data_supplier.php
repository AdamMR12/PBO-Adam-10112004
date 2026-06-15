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
    <a href="input_supplier.php" class="tombol">tambah data baru</a>

    <h3>data customer</h3>
    <table class="table" border="1">
        <tr>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>opsi</th>
        </tr>
        <?php
        include "koneksi.php";
        $query_mysql = mysqli_query($koneksi, "select * from tb_supplier");
        while($data = mysqli_fetch_array($query_mysql)){
        ?>

        <tr>
            <td><?php echo $data['id_supplier'] ?></td>
            <td><?php echo $data['nama_supplier'] ?></td>
            <td><?php echo $data['alamat_supplier']; ?></td>
            <td><?php echo $data['telepon_supplier']; ?></td>
            <td><?php echo $data['email_supplier']; ?></td>
            <td>
                <a href="edit_customer.php?id=<?= $data['id_supplier'] ?>" class="edit"> Edit</a>
                |
                <a href="hapus.php?action=barang&id=<?= $data['id_supplier'] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php }?>
    </table>
</body>
</html>
