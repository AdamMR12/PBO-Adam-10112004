<?php
class produk{
    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function getInfo(){
        return "produk: $this->nama - Rp ".number_format($this->harga,0,",",",");
    }
}

    class produkDigital extends produk{
        public $ukuranFile;

        public function __construct($nama, $harga, $ukuranFile) {
            parent::__construct($nama,$harga);
            $this->ukuranFile = $ukuranFile;
        }

        public function getInfo(){
            return "produk digital: $this->nama - Rp ".number_format($this->harga,0,",",",")." = $this->ukuranFile MB";
        }
}

$p1 = new produk("buku",50000);
$p2 = new produkDigital("ebook php",200000,100);

echo $p1->getInfo()."<br>";
echo $p2->getInfo()."<br>";

$data = [
    ["tipe"=>"produk","nama"=>"buku","harga"=>5000],
    ["tipe"=>"digital","nama"=>"ebook","harga"=>10000,"size"=>25]
];


?>


<?php
class Shape {
const PI = 3.142 ;
function __call($name,$arg){
if($name == 'area')
switch(count($arg)){
case 0 : return 0 ;
case 1 : return self::PI * $arg[0] ;
case 2 : return $arg[0] * $arg[1];
}
}
}
$circle = new Shape();
echo $circle->area(3)."<br>";
$rect = new Shape();
echo $rect->area(8,6)."<br>";
?>

<?php
class Base {
function display() {
echo "\nBase class function declared final!<br>";
}
function demo() {
echo "\nBase class function!<br>";
}
}
class Derived extends Base {
function demo() {
echo "\nDerived class function!<br>";
}
}
$ob = new Base;
$ob->demo();
$ob->display();
$ob2 = new Derived;
$ob2->demo();
$ob2->display();
?>
