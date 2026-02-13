<?php
class kalku{//sebagai class
    public int $cel;    //variabel instance

    public function __construct($cel)//method dengan parameter
    {
        $this->cel = $cel;//local variabel
    }

    public function hitungfah(){
        $Total = (9/5 * $this->cel) + 32;
        return $Total;
    }
    public function hitungkel(){
        $Total = $this->cel + 273.15;
        return $Total;
    }
    public function hitungre(){
        $Total = (4/5)*$this->cel;
        return $Total;
    }
    public function hitungra(){
        $Total = ($this->cel+ 273.15)*9/5;
        return $Total;
    }

    public function tampilhasil($cel)//method dengan local varibel
    {
        echo "celcius :".$this->cel."<br>";
        echo "Fahrenheit:".$this->hitungfah()."<br>";
        echo "Fahrenheit:".$this->hitungkel()."<br>";
        echo "Fahrenheit:".$this->hitungre()."<br>";
        echo "Fahrenheit:".$this->hitungra()."<br>"; ///
    }
}

$kalku = new kalku(30);
$kalku->tampilhasil($kalku->cel);

?>