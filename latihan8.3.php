<?php
echo "siapa namamu: ";
$input = fopen("php://stdin","r");
$nama = trim(fgets($input));

echo "hello $nama, apa kabar\n";
?>