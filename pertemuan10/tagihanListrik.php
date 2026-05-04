<?php
class TagihanListrik{
    private $nama;
    private $kwh;
    private $tarif = 1500;

    public function setData($nama,$kwh){
        $this->nama;
        $this->kwh;
    }

    public function getNama(){
        return $this->nama;
    }

    public function hitungTotal(){
        $total = $this->kwh *$this->tarif;

        if($this->kwh > 1000){
            $total = $total - 50000;
        }
        return $total;
    }
}
?>