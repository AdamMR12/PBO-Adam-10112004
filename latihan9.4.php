<?php
class computer{
    private $jenis_processor = "intel core i7-4790 3.6ghz";
    protected $jenis_ram = "DDR 4";
    public $jenis_vga = "PCI Exxpress";

    public function tampilkan_processor(){
        return $this->jenis_processor;
    }

    public function tampilkan_jenisprocessor(){
        return $this->jenis_processor;
    }

    private function tampilkan_ram(){
        return $this->jenis_ram;
    }

    protected function tampilkan_vga(){
        return $this->jenis_vga;
    }

    public function tampilkan_vga2(){
        return $this->jenis_vga;
    }
}

class laptop extends computer{
    public function display_processor(){
        return $this->jenis_processor;
    }

    public function display_processor2(){
        return $this->tampilkan_processor();
    }

    public function display_ram(){
        return $this->jenis_ram;
    }

    public function display_ram2(){
        return $this->tampilkan_ram();
    }

    public function display_vga(){
        return $this->jenis_vga;
    }

    private function display_processorkomputer(){
        return $this->jenis_processor;
    }
}

$komputer = new computer();
$laptop = new laptop();
echo "line 61 :".$komputer->tampilkan_processor()."<br>";
echo "line 62 :".$laptop->display_processor()."<br>";
echo "line 63 :".$laptop->display_processor2()."<br>";
echo "line 64 :".$laptop->tampilkan_jenisprocessor()."<br>";
echo "line 65 :".$laptop->display_ram()."<br>";
echo "line 62 :".$laptop->display_vga()."<br>";
echo "line 62 :".$laptop->display_processorkomputer()."<br>";
?>