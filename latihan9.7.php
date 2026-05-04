<?php
class kendaraan{
    var $jmlroda;
    var $warna;
    var $bhnbakar;
    var $harga;
    var $merek;
    var $tahun;

    function setmerek($x){
        $this->merek = $x;
    }

    function getmerek(){
        return $this->merek;
    }

    function setharga($y){
        $this->harga = $y;
    }

    function getharga(){
        return $this->harga;
    }
}

$kendaraan = new kendaraan();
$kendaraan->setMerek('yamaha');
$kendaraan->setharga(10000000);
echo $kendaraan->getmerek()."<br>";
echo $kendaraan->getharga();
?>