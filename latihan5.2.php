<?php
function format($angka){
    return "Rp ".number_format($angka,0,",",".");
}

class belanjaWarung{
        public $namaPembeli;
        public $hargaBarang;
        public $namaBarang;
        public $jmlhBeli;

        public function hitungSubtotal(){
            return $this->hargaBarang * $this->jmlhBeli;
        }

        public function hitungDiskon($subtotal){
            if($subtotal > 100000){
                return $subtotal * 0.1;
            }
            return 0;
        }

        public function hitungTotal(){
            $subtotal = $this->hitungSubtotal();
            $diskon = $this->hitungDiskon($subtotal);
            return $subtotal - $diskon;
        }
    }


    $data = [
    [
        'nama'=>"ivan",
        'barang'=>"sepatu",
        'harga'=>1000000,
        'jumlah'=>2
    ],
    [
        'nama'=>"adam",
        'barang'=>"kaos",
        'harga'=>200000,
        'jumlah'=>2
    ],[
        'nama'=>"maada",
        'barang'=>"celana",
        'harga'=>300000,
        'jumlah'=>1
    ]
    ];

    $errors1 = [];
    $nama = $data[0]["nama"];
    $barang = $data[0]["barang"];
    $harga = $data[0]["harga"];
    $jumlah = $data[0]["jumlah"];

     if(empty($nama)){
        $errors1[] = "nama harus diisi";
     }
     if(empty($barang)){
        $errors1[] = "barang harus diisi";
     }
     if(empty($harga)){
        $errors1[] = "harga harus diisi";
     }elseif($harga <= 0){
        $errors1[] = "harga harus lebih dari 0";
     }
     if(empty($jumlah)){
        $errors1[] = "jumlah harus diisi";
     }elseif($jumlah <= 0){
        $errors1[] = "jumlah harus lebih dari 0";
     }


    if(!empty($errors1)){
        foreach($errors1 as $error){
            echo $error."<br>";
        }
    }else{
        for ($x = 0; $x < count($data); $x++) {

        $nama   = $data[$x]['nama'];
        $barang = $data[$x]['barang'];
        $harga  = $data[$x]['harga'];
        $jumlah = $data[$x]['jumlah'];

        $belanja = new belanjaWarung();
        $belanja->namaPembeli = $nama;
        $belanja->namaBarang  = $barang;
        $belanja->hargaBarang = $harga;
        $belanja->jmlhBeli    = $jumlah;

        $subtotal = $belanja->hitungSubtotal();
        $diskon   = $belanja->hitungDiskon($subtotal);
        $total    = $belanja->hitungTotal();
        
        echo "<h2>Struk Toko</h2>";
        echo "Nama Pembeli  : " . $belanja->namaPembeli . "<br>";
        echo "Nama Barang   : " . $belanja->namaBarang . "<br>";
        echo "Harga Barang  : " . $belanja->hargaBarang . "<br>";
        echo "Jumlah        : " . $belanja->jmlhBeli . "<br>";
        echo "Sub Total     : " . format($subtotal) . "<br>";
        echo "Diskon        : " . format($diskon) . "<br>";
        echo "Total         : " . format($total) . "<br><hr>";
        }
    }
    

    

?>