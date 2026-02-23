<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>form produk</h1>
        nama produk: <pre><input type="text" name="nama"></pre>
        harga: <pre><input type="number" name="harga"></pre>
        <input type="submit" value="simpan">
    </form>
    <?php
        $nama = "";
        $harga = "";
        if(empty($_POST['nama']) && empty($_POST['harga'])){
            echo "input nama dan harga produk";
            exit;
        }
        class produk{
        public $harga;
        public function harga(){
            if($this->harga>100000){
                return "produk mahal";
            }else{
                return "produk murah";
            }
            }
        }
        
        $produk1 = new Produk();

        $nama = $_POST['nama'];
        $harga = $_POST['harga'];

        $produk1->harga = $harga;

        echo "nama produk: " . $nama . "<br>";
        echo "harga produk: " . $harga . "<br>";
        echo "status harga: " . $produk1->Harga();
    ?>
</body>
</html>