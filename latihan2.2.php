<?php
class belanja{//sebagai class
    public string $namaPembeli = "Adam";    //variabel instance
    public string $namaBarang = "mie";      //variabel instance
    public int $hargaBarang = 3000;         //variabel instance
    public int $jumlahBayar = 4;            //variabel instance
    public float $totalBayar = 1;               //variabel instance
    public float $diskon = 0.5;                   //variabel instance
    public static float $pajak = 0.02;      //variabel static

    public function __construct($namaPembeli)//method dengan parameter
    {
        $this->namaPembeli = $namaPembeli;//local variabel
    }

    public function hitungTotal(): float{
        $subTotal = $this->hargaBarang * $this->jumlahBayar;
        return $subTotal;
    }

    public function hitungDiskon(): float{
        $Total = $this->hitungTotal() * $this->diskon;
        return $Total;
    }

    public function total(): float{
        $Total = $this->hitungTotal() - $this->hitungDiskon();
        return $Total;
    }

    public function tampilRincian($namaPembeli)//method dengan local varibel
    {
        echo "Nama Pembeli:".$this->namaPembeli."<br>"; ///
        echo "Nama Barang:".$this->namaBarang."<br>";   /////menampilkan hasil
        echo "Harga Barang:".$this->hargaBarang."<br>"; /////
        echo "Jumlah:".$this->jumlahBayar."<br>";       ///
        echo "Total:".$this->hitungTotal()."<br>";
        echo "Diskon:".$this->hitungDiskon()."<br>";
        echo "Total Keseluruhan:".$this->total()."<br>";
    }
}

$belanja1 = new belanja("dinm");
$belanja1->tampilRincian($belanja1->namaPembeli);

?>