<?php

class kalkulatorsuhu{
    public $celcius;
    public $hasil = [];

public function __construct($celcius){
    $this->celcius = (float)$celcius;

    $this->hasil = [
        "celcius" => $this->celcius,
        "reamur" => $this->celcius * 4/5,
        "fahrenheit" => ($this->celcius * 9/5) + 32,
        "kelvin" => $this->celcius + 273.15
    ];
}


public function tampilkanhasil(){
    echo "\n========= HASIL KONVERSI SUHU =========\n";

    foreach ($this->hasil as $jenis => $nilai) {
        if ($jenis == "celcius"){
            echo "$jenis = $nilai derajat\n";
        } else {
            echo "$jenis = " . round($nilai, 2) . " derajat\n";
        }
    }
}

}

$konversi = new kalkulatorsuhu(36);
do {
    echo "\n========= MENU KONVERSI SUHU =========\n";
    echo "1. Tampilkan hasil konversi suhu\n";
    echo "2. input suhu baru\n";
    echo "3. Keluar\n";
    echo "Pilih menu (1-3): ";

    $menu = trim(fgets(STDIN));

    switch ($menu) {
        case '1':
            $konversi->tampilkanhasil();
            break;
        case '2':
            echo "Masukkan suhu dalam Celcius: ";
            $suhuBaru = trim(fgets(STDIN));
            $konversi = new kalkulatorsuhu($suhuBaru);
            echo "Suhu berhasil diperbarui.\n";
            break;
        case '3':
            echo "Terima kasih telah menggunakan program konversi suhu. Sampai jumpa!\n";
            exit;
        default:
            echo "Pilihan tidak valid. Silakan pilih menu 1, 2, atau 3.\n";
    }
}while ($menu != '3');