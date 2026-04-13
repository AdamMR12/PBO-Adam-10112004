<?php
class segitiga{
    public $tinggi;
    public $lebar;
    function __construct($tinggi, $lebar) {
        $this->tinggi = $tinggi;
        $this->lebar = $lebar;
    }

    function luas(){
        $luas = $this->tinggi * $this->lebar/2;
        echo "Tinggi Segitiga = ".$this->tinggi;
        echo "<br>Lebar Segitiga = ".$this->lebar;
        echo "<br><b>Luas Segitiga = ".$luas."</br>";
    }
}

$s = new segitiga(200, 500);
$s->luas();
?>