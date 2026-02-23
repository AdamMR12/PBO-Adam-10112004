<?php
class kendaraan{
    public $jumlahRoda = 4;
    public $warna;
    public $bahanBakar="premium";
    public $harga=100000000;
    public $merek;
    public $tahunPembuatan=2005;

    public function statusHarga(){
        if($this->harga>50000000){
            $status = "mahal";
        }else{
            $status = "murah";
        }
        return $status;
    }
    public function statuSubsidi(){
        if($this->tahunPembuatan<2005 && $this->bahanBakar=="premium"){
            $status = "subsidi";
        }else{
            $status = "tidak subsidi";
        }
        return $status;
    }
}
$objekKendaraan = new kendaraan();
echo "jumlah roda = ".$objekKendaraan->jumlahRoda."<br>";
echo "status harga = ".$objekKendaraan->statusHarga()."<br>";
echo "status subsidi = ".$objekKendaraan->statuSubsidi()."<br>";

$objekKendaraan1 =new kendaraan();
$objekKendaraan1->harga=10000000;
$objekKendaraan1->tahunPembuatan=1999;
echo "kendaraan1 <br>";
echo "status harga = ".$objekKendaraan1->statusHarga();

$objekKendaraan2 = new kendaraan();
$objekKendaraan2->bahanBakar = "pertamax";
$objekKendaraan2->tahunPembuatan =1999;
echo "<br>kendaraan2";
echo "<br>";
echo "status BBM = ".$objekKendaraan2->statuSubsidi()."<br>";
?>