<?php
class kendaraan{
    var $jumlahRoda;
    var $warna;
    var $bahanBakar;
    var $harga;
    var $merek;

    function statusharga(){
        if($this->harga > 50000000) $status = 'mahal';
        else $status = 'murah';
        return $status;
    }

    function setmerek($x){
        return $this->merek = $x;
    }

    function setharga($x){
        return $this->harga = $x;
    }
}

$kendaraan1 = new kendaraan();
$kendaraan1->setmerek('Yamaha');
$kendaraan1->setharga(10000000);
echo $kendaraan1->statusHarga();
?>