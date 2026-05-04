<?php
class manusia{
    public $nama = "adam";
    var $kelas = "SI 1";

    function tampil_nama(){
        return $this->nama;
    }

    function tampil_kelas(){
        return $this->kelas;
    }
}

$manusia = new manusia();

echo "nama = ".$manusia->tampil_nama()."<br>";
echo "kelas = ".$manusia->tampil_kelas();
?>