<?php

class GajiKaryawan
{
    private $dataKaryawan; 
    private $gajiPokokList; 
    private $lemburPerJam = 15000;

    public function __construct($dataAwal = [])
    {
        $this->gajiPokokList = [
            "Ib"  => 1250000,
            "Ic"  => 1300000,
            "Id"  => 1350000,
            "Ila" => 2000000,
            "Ilb" => 2100000,
            "Ilc" => 2200000,
            "Ivd" => 2300000
        ];
        $this->dataKaryawan = [];
        foreach ($dataAwal as $item) {
            $this->tambahData($item['nama'], $item['golongan'], $item['jamLembur']);
        }
    }

    private function getGajiPokok($golongan)
    {
        if (isset($this->gajiPokokList[$golongan])) {
            return $this->gajiPokokList[$golongan];
        } else {
            return 0;
        }
    }

    private function hitungTotalGaji($golongan, $jamLembur)
    {
        $gajiPokok = $this->getGajiPokok($golongan);
        $tunjanganLembur = $jamLembur * $this->lemburPerJam;
        return $gajiPokok + $tunjanganLembur;
    }

    public function tambahData($nama, $golongan, $jamLembur)
    {
        $totalGaji = $this->hitungTotalGaji($golongan, $jamLembur);
        $this->dataKaryawan[] = [
            'nama'      => $nama,
            'golongan'  => $golongan,
            'jamLembur' => $jamLembur,
            'totalGaji' => $totalGaji
        ];
        echo "Data berhasil ditambahkan!\n";
    }

    public function tampilkanData()
    {
        if (empty($this->dataKaryawan)) {
            echo "\nBelum ada data karyawan.\n";
            return;
        }

        echo "\nDATA GAJI KARYAWAN\n";
        echo str_pad("No", 3) . " | " . str_pad("Nama", 12) . " | " . str_pad("Golongan", 10) . " | " . str_pad("Jam Lembur", 12) . " | Total Gaji\n";
        echo str_repeat("-", 55) . "\n";

        foreach ($this->dataKaryawan as $index => $karyawan) {
            $no = $index + 1;
            $totalGajiFormatted = "Rp" . number_format($karyawan['totalGaji'], 0, ',', ',');
            echo str_pad($no, 3) . " | " . str_pad($karyawan['nama'], 12) . " | " . str_pad($karyawan['golongan'], 10) . " | " . str_pad($karyawan['jamLembur'], 12) . " | " . $totalGajiFormatted . "\n";
        }
        echo "\n";
    }

    public function updateData($no, $namaBaru, $golonganBaru, $jamLemburBaru)
    {
        $index = $no - 1;
        if (!isset($this->dataKaryawan[$index])) {
            echo "Data dengan nomor $no tidak ditemukan.\n";
            return;
        }
        $totalGajiBaru = $this->hitungTotalGaji($golonganBaru, $jamLemburBaru);
        $this->dataKaryawan[$index] = [
            'nama'      => $namaBaru,
            'golongan'  => $golonganBaru,
            'jamLembur' => $jamLemburBaru,
            'totalGaji' => $totalGajiBaru
        ];
        echo "Data nomor $no berhasil diperbarui.\n";
    }

    public function hapusData($no)
    {
        $index = $no - 1;
        if (!isset($this->dataKaryawan[$index])) {
            echo "Data dengan nomor $no tidak ditemukan.\n";
            return;
        }
        array_splice($this->dataKaryawan, $index, 1);
        echo "Data nomor $no berhasil dihapus.\n";
    }

    public function __destruct()
    {
        echo "\nProgram selesai. Data telah diproses. Terima kasih.\n";
    }
}


$dataAwal = [
    ['nama' => 'Andin',  'golongan' => 'Ilb', 'jamLembur' => 30],
    ['nama' => 'Dini', 'golongan' => 'Ivd', 'jamLembur' => 52],
    ['nama' => 'Udin', 'golongan' => 'Ivd', 'jamLembur' => 70]
];

$manager = new GajiKaryawan($dataAwal);

do {
    echo "\nMENU GAJI KARYAWAN\n";
    echo "1. Tampilkan Data\n";
    echo "2. Tambah Data\n";
    echo "3. Update Data\n";
    echo "4. Hapus Data\n";
    echo "5. Keluar\n";
    echo "Pilih menu: ";
    $pilihan = trim(fgets(STDIN));

    switch ($pilihan) {
        case '1':
            $manager->tampilkanData();
            break;
        case '2':
            echo "Masukkan Nama: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan Golongan (Ib, Ic, Id, Ila, Ilb, Ilc, Ivd): ";
            $gol = trim(fgets(STDIN));
            echo "Masukkan Jam Lembur: ";
            $jam = (int) trim(fgets(STDIN));
            $manager->tambahData($nama, $gol, $jam);
            break;
        case '3':
            $manager->tampilkanData();
            echo "Masukkan nomor data yang akan diupdate: ";
            $no = (int) trim(fgets(STDIN));
            echo "Masukkan Nama baru: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan Golongan baru: ";
            $gol = trim(fgets(STDIN));
            echo "Masukkan Jam Lembur baru: ";
            $jam = (int) trim(fgets(STDIN));
            $manager->updateData($no, $nama, $gol, $jam);
            break;
        case '4':
            $manager->tampilkanData();
            echo "Masukkan nomor data yang akan dihapus: ";
            $no = (int) trim(fgets(STDIN));
            $manager->hapusData($no);
            break;
        case '5':
            echo "Keluar dari program.\n";
            break;
        default:
            echo "Pilihan tidak valid. Silakan pilih 1-5.\n";
    }
} while ($pilihan != '5');
?>