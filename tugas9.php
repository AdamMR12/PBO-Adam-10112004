<?php

function formatRupiah($jumlah) {
    return "Rp " . number_format($jumlah, 0, ',', '.');
}

class Tabungan {
    protected $saldo; 

    public function __construct($saldoAwal) {
        $this->saldo = $saldoAwal;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setor($jumlah) {
        $this->saldo += (float)$jumlah;
        echo "[SUKSES] Setor: " . formatRupiah($jumlah) . "\n";
    }

    public function tarik($jumlah) {
        if ($jumlah > $this->saldo) {
            echo "[GAGAL] Saldo tidak cukup untuk menarik " . formatRupiah($jumlah) . "\n";
        } else {
            $this->saldo -= (float)$jumlah;
            echo "[SUKSES] Tarik: " . formatRupiah($jumlah) . "\n";
        }
    }
}

class Siswa extends Tabungan {
    private $namaSiswa; 

    public function __construct($nama, $saldoAwal) {
        parent::__construct($saldoAwal);
        $this->namaSiswa = $nama;
    }

    public function getNama() {
        return $this->namaSiswa;
    }

    public function tampilkanInfo() {
        echo "\n------------------------------\n";
        echo "Nama Siswa : " . $this->namaSiswa . "\n";
        echo "Total Saldo: " . formatRupiah($this->saldo) . "\n";
        echo "------------------------------\n";
    }
}

$daftarSiswa = [
    new Siswa("Siswa 1", 1000000),
    new Siswa("Siswa 2", 500000),
    new Siswa("Siswa 3", 750000)
];

while (true) {
    echo "\n=== MENU TABUNGAN SEKOLAH ===\n";
    foreach ($daftarSiswa as $key => $s) {
        echo ($key + 1) . ". " . $s->getNama() . "\n";
    }
    echo "0. Keluar Program\n";
    echo "Pilih Siswa (1-3): ";
    
    $pilihanSiswa = trim(fgets(STDIN));

    if ($pilihanSiswa === "0") break;

    $idx = (int)$pilihanSiswa - 1;
    if (!isset($daftarSiswa[$idx])) {
        echo "Pilihan tidak valid!\n";
        continue;
    }

    $siswaAktif = $daftarSiswa[$idx];

    
    $menuTransaksi = true;
    while ($menuTransaksi) {
        $siswaAktif->tampilkanInfo();
        echo "Aksi: [1] Setor | [2] Tarik | [3] Ganti Siswa\nPilih: ";
        $aksi = trim(fgets(STDIN));

        switch ($aksi) {
            case "1":
                echo "Jumlah Setor: ";
                $nominal = trim(fgets(STDIN));
                $siswaAktif->setor($nominal);
                break;
            case "2":
                echo "Jumlah Tarik: ";
                $nominal = trim(fgets(STDIN));
                $siswaAktif->tarik($nominal);
                break;
            case "3":
                $menuTransaksi = false;
                break;
            default:
                echo "Menu tidak tersedia di sistem.\n";
        }
    }
}

echo "Program selesai. Data telah disimpan.\n";
?>