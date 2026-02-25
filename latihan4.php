<?php
function formatRp($angka){
    return "Rp ".number_format($angka. 0);
}
    class belanja{
        public $namaPembeli;
        public $hargaBarang;
        public $namaBarang;
        public $jmlhBeli;

        public function hitungSubtotal(){
            return $this->hargaBarang * $this->jmlhBeli;
        }

        public function hitungTotalDiskon($persenDiskon){
            $subtotal = $this->hitungSubtotal();
            $diskon = ($persenDiskon / 100 * $subtotal);
            return $subtotal - $diskon;
        }
    }

    $data = [
        'namaPembeli'=>"ivan",
        'namaBarang'=>"sepatu",
        'hargaBarang'=>1000000,
        'jumlahBeli'=>2
    ];

    $belanja = new belanja();
    $belanja->namaPembeli = $data["namaPembeli"];
    $belanja->namaBarang = $data["namaBarang"];
    $belanja->hargaBarang = $data["hargaBarang"];
    $belanja->jmlhBeli = $data["jumlahBeli"];

    echo "<h2>struk toko <br>";
    echo "nama pembeli: ".$belanja->namaPembeli."<br>";
    echo "nama barang: ".$belanja->namaBarang."<br>";
    echo "Sub total: ".formatRp($belanja->hitungSubtotal())."<br>";
    echo "total diskon: ".formatRp($belanja->hitungTotalDiskon(10))."<br>";

?>