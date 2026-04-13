<?php
class manusia{
    public $nama;
    public $warna;
    function __construct() {
        echo "Ini construct<br> ";
    }

    function __destruct(){
        echo "Ini destruct<br>";
    }

    function nama(){
        echo "Ini nama";
    }
}

$s = new manusia();
echo $manusia->nama();
?>