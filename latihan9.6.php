<?php
class kendaraan{
    var $merek;
    var $jmlRoda;
    var $harga;
    var $warna;
    var $bhnBakar;
    var $tahun;

    function setMerek($x){
        return $this->merek = $x;
    }

    function setHarga($x){
        return $this->harga = $x;
    }

    function setjmlroda($x){
        return $this->jmlRoda = $x;
    }

    function setwarna($x){
        return $this->warna = $x;
    }

    function setbhnBakar($x){
        return $this->bhnBakar = $x;
    }

    function settahun($x){
        return $this->tahun = $x;
    }
}

$kendaraan1 = new Kendaraan();
$kendaraan1->setMerek('Toyota Yaris');
$kendaraan1->setjmlroda(4);
$kendaraan1->setHarga(160000000);
$kendaraan1->setwarna("Merah");
$kendaraan1->setbhnbakar("Premium");
$kendaraan1->settahun(2005);

$kendaraan2 = new Kendaraan();
$kendaraan2->setMerek('Honda Scoopy');
$kendaraan2->setjmlroda(2);
$kendaraan2->setHarga(13000000);
$kendaraan2->setwarna("Putih");
$kendaraan2->setbhnbakar("Premium");
$kendaraan2->settahun(2004);

$kendaraan3 = new Kendaraan();
$kendaraan3->setMerek('Isuzu Panther');
$kendaraan3->setjmlroda(4);
$kendaraan3->setHarga(170000000);
$kendaraan3->setwarna("Hitam");
$kendaraan3->setbhnbakar("Solar");
$kendaraan3->settahun(2003);

echo $kendaraan1->merek;
echo "<br>";
echo $kendaraan1->jmlRoda;
echo "<br>";
echo $kendaraan1->harga;
echo "<br>";
echo $kendaraan1->warna;
echo "<br>";
echo $kendaraan1->bhnBakar;
echo "<br>";
echo $kendaraan1->tahun;
echo "<br>";

echo $kendaraan2->merek;
echo "<br>";
echo $kendaraan2->jmlRoda;
echo "<br>";
echo $kendaraan2->harga;
echo "<br>";
echo $kendaraan2->warna;
echo "<br>";
echo $kendaraan2->bhnBakar;
echo "<br>";
echo $kendaraan2->tahun;
echo "<br>";

echo $kendaraan3->merek;
echo "<br>";
echo $kendaraan3->jmlRoda;
echo "<br>";
echo $kendaraan3->harga;
echo "<br>";
echo $kendaraan3->warna;
echo "<br>";
echo $kendaraan3->bhnBakar;
echo "<br>";
echo $kendaraan3->tahun;
?>