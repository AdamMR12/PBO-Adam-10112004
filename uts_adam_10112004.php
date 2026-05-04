<?php

class produk
{
    private $dataProduk; 

    public function __construct($dataAwal = [])
    {
        $this->dataProduk = [];
        foreach ($dataAwal as $item) {
            $this->tambahData($item['nama'], $item['harga'], $item['stock']);
        }
    }


    public function tambahData($nama, $harga, $stock)
    {
        $this->dataProduk[] = [
            'nama'  => $nama,
            'harga' => $harga,
            'stock' => $stock
        ];
        echo "Data berhasil ditambahkan!\n";
    }

    public function tampilkanData()
    {
        if (empty($this->dataProduk)) {
            echo "\nBelum ada data produk.\n";
            return;
        }

        echo "\nDATA produk\n";
        echo str_pad("No", 3) . " | " . str_pad("Nama", 12) . " | " . str_pad("harga", 10) . " | " . str_pad("Stock", 12) . "\n";
        echo str_repeat("-", 40) . "\n";

        foreach ($this->dataProduk as $index => $produk) {
            $no = $index + 1;
            $hargaFormatted = "Rp" . number_format($produk['harga'], 0, ',', ',');
            echo str_pad($no, 3) . " | " . str_pad($produk['nama'], 12) . " | " . str_pad($hargaFormatted, 10) . " | " . str_pad($produk['stock'], 12) ."\n";
        }
        echo "\n";
    }

    public function updateData($no, $namaBaru, $hargaBaru, $stockBaru)
    {
        $index = $no - 1;
        if (!isset($this->dataProduk[$index])) {
            echo "Data dengan nomor $no tidak ditemukan.\n";
            return;
        }
        $this->dataProduk[$index] = [
            'nama'      => $namaBaru,
            'harga'  => $hargaBaru,
            'stock' => $stockBaru
        ];
        echo "Data nomor $no berhasil diperbarui.\n";
    }

    public function hapusData($no)
    {
        $index = $no - 1;
        if (!isset($this->dataProduk[$index])) {
            echo "Data dengan nomor $no tidak ditemukan.\n";
            return;
        }
        array_splice($this->dataProduk, $index, 1);
        echo "Data nomor $no berhasil dihapus.\n";
    }

    public function __destruct()
    {
        echo "\nProgram selesai. Data telah diproses. Terima kasih.\n";
    }
}


$dataAwal = [
    ['nama' => 'sabun',  'harga' => 10000, 'stock' => 30],
    ['nama' => 'sampo', 'harga' => 12000, 'stock' => 52],
    ['nama' => 'deterjen', 'harga' => 5000, 'stock' => 70]
];

$toko = new produk($dataAwal);

do {
    echo "\nMENU PRODUK\n";
    echo "1. Tampilkan Data\n";
    echo "2. Tambah Data\n";
    echo "3. Update Data\n";
    echo "4. Hapus Data\n";
    echo "5. Keluar\n";
    echo "Pilih menu: ";
    $pilihan = trim(fgets(STDIN));

    switch ($pilihan) {
        case '1':
            $toko->tampilkanData();
            break;
        case '2':
            echo "Masukkan Nama: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan harga: ";
            $harga = (int)trim(fgets(STDIN));
            echo "Masukkan jumlah stock: ";
            $stock = (int) trim(fgets(STDIN));
            $toko->tambahData($nama, $harga, $stock);
            break;
        case '3':
            $toko->tampilkanData();
            echo "Masukkan nomor data yang akan diupdate: ";
            $no = (int) trim(fgets(STDIN));
            echo "Masukkan Nama baru: ";
            $nama = trim(fgets(STDIN));
            echo "Masukkan harga baru: ";
            $gol = (int) trim(fgets(STDIN));
            echo "Masukkan stock baru: ";
            $jam = (int) trim(fgets(STDIN));
            $toko->updateData($no, $nama, $gol, $jam);
            break;
        case '4':
            $toko->tampilkanData();
            echo "Masukkan nomor data yang akan dihapus: ";
            $no = (int) trim(fgets(STDIN));
            $toko->hapusData($no);
            break;
        case '5':
            echo "Keluar dari program.\n";
            break;
        default:
            echo "Pilihan tidak valid. Silakan pilih 1-5.\n";
    }
} while ($pilihan != '5');
?>