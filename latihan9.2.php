<?php
class manusia{
    private $nama = "adam";
    private $kelas = "SI 1";

    private function m_nama(){
        return $this->nama;
    }

    public function tampil_nama(){
        return $this->m_nama();
    }

    function tampil_kelas(){
        return $this->kelas;
    }
}

$manusia = new manusia();

echo "nama = ".$manusia->tampil_nama()."<br>";
echo "kelas = ".$manusia->tampil_kelas();
?>