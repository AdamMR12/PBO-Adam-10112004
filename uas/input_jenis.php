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

    <a href="input_barang.php">kembali</a>

    <br>
    <h3>input data Jenis</h3>
    <form action="input-aksi.php?action=jenis" method="post">
        <table>
            <tr>
                <td>Kode Jenis</td>
                <td><input type="text" name="kode"></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td><input type="text" name="jenis"></td>
            </tr>
            <tr>
                <td>Satuan</td>
                <td><input type="text" name="satuan"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>