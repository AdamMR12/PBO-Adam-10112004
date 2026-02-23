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
        
    class produk{
        public function harga(){
            if($this->harga){
                return "produk mahal";
            }else{
                return "produk murah";
            }
        }
    }
        
        $nama = "";
        $harga = "";

        if(empty($_POST['nama']) && empty($_POST['harga'])){
            echo "input nama dan harga produk";
        }else{
            echo "nama produk: ".$nama."<br>";
            echo "harga produk: ".$harga;

        }
    ?>
</body>
</html>