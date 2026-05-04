<?php
class manusia{
    private $nama = "adam";
    private $kelas = "SI 1";

    protected function nama(){
        return "nama :".$this->nama;
    }

    public function tampil_nama(){
        return $this->nama();
    }

    protected function tampil_kelas(){
        return $this->kelas;
    }
}

$manusia = new manusia();

echo "nama = ".$manusia->tampil_nama()."<br>";
echo "kelas = ".$manusia->tampil_kelas();
?>