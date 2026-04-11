<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaji</title>
</head>
<body>
    <form action="" method="post">
    <table border="0" cellpadding="5">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                <select name="jabatan">
                    <option value="pro">Programmer</option>
                    <option value="dir">Direktur</option>
                    <option value="peg">Pegawai</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Masa Kerja (tahun)</td>
            <td>:</td>
            <td><input type="text" name="MasaKerja"></td>
        </tr>
        <tr>
            
            <td>Penjualan (unit)</td>
            <td>:</td>
            <td><input type="text" name="penjual"></td>
        </tr>
        <tr>
            <td>Stock 100 unit</td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="submit">
            </td>
        </tr>
    </table>
    </form>
</body>
</html>

<?php
class employee{
    public $nama;
    public $jabatan;
    public $masaKerja;
    public $gaji;
    public $bonus;
    public $tGaji;

    public function __construct($nama, $gaji, $jabatan, $masaKerja, $tGaji) {
        $this->nama = $nama;
        $this->gaji = $gaji;
        $this->jabatan = $jabatan;
        $this->masaKerja = $masaKerja;
        $this->tGaji = $tGaji;
    }

    public function getInfo(){
        return "<br><br>
            <table border='0' cellpadding='5' style='border: 1px solid black;'>
                <tr><th colspan='2'>Detail Gaji Karyawan</th></tr>
                <tr><td>Nama</td><td>: $this->nama</td></tr>
                <tr><td>Jabatan</td><td>: $this->jabatan</td></tr>
                <tr><td>Gaji Pokok</td><td>: Rp ".number_format($this->gaji,0,",",".")."</td></tr>
                <tr><td>Bonus</td><td>: Rp ".number_format($this->bonus,0,",",".")."</td></tr>
                <tr><td>Total Gaji</td><td>: Rp ".number_format($this->tGaji,0,",",".")."</td></tr>
            </table>";
    }
}

class programmer extends employee{
    public function __construct($nama, $gaji, $jabatan, $masaKerja, $tGaji) {
        parent::__construct($nama, $gaji, $jabatan, $masaKerja, $tGaji);
    }

    public function kalGaji(){
        if($this->masaKerja >= 1 && $this->masaKerja < 10){
            $this->bonus = 0.01 * $this->masaKerja * $this->gaji ;
        } elseif($this->masaKerja >= 10){
            $this->bonus = 0.02 * $this->masaKerja * $this->gaji;
        } else {
            $this->bonus = 0;
        }
        return $this->gaji + $this->bonus;
    }
}

class direktur extends employee{
    public function __construct($nama, $gaji, $jabatan, $masaKerja, $tGaji) {
        parent::__construct($nama, $gaji, $jabatan, $masaKerja, $tGaji);
    }

    public function kalGaji(){
        $bonus = 0.5 * $this->gaji;
        $tunjangan = 0.1  * $this->gaji;
        $this->bonus = $bonus + $tunjangan;
        return $this->gaji + $this->bonus;
    }
}

class pegawai extends employee{
    public $stock = 100;
    public $penjualan;
    public $hBarang = 100000;
    
    public function __construct($nama, $gaji, $jabatan, $masaKerja, $tGaji, $penjualan) {
        parent::__construct($nama, $gaji, $jabatan, $masaKerja, $tGaji);
        $this->penjualan = $penjualan;
    }

    public function bPenjualan(){
        $minP = $this->stock * 70/100;
        $pHarga1 = ($this->hBarang * 10/100) * $this->penjualan ;
        $pHarga2 = ($this->hBarang * 3/100) * $this->penjualan;
        
        if($this->penjualan > $minP){
            $this->bonus = $pHarga1;
        } else {
            $this->bonus = $pHarga2;
        }
        return $this->gaji + $this->bonus;
    }
}



if(isset($_POST['submit'])){
    $nama       = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $masaKerja  = (int)$_POST['MasaKerja'];
    $penjualan  = (int)$_POST['penjual'];

    $gajiPokok = 5000000;

    if($jabatan == "pro"){
        $karyawan = new programmer($nama, $gajiPokok, "Programmer", $masaKerja, 0);
        $karyawan->tGaji = $karyawan->kalGaji();
        echo $karyawan->getInfo();
    }
    elseif($jabatan == "dir"){
        $karyawan = new direktur($nama, $gajiPokok, "Direktur", $masaKerja, 0);
        $karyawan->tGaji = $karyawan->kalGaji();
        echo $karyawan->getInfo();
    }
    elseif($jabatan == "peg"){
        $karyawan = new pegawai($nama, $gajiPokok, "Pegawai", $masaKerja, 0, $penjualan);
        $karyawan->tGaji = $karyawan->bPenjualan();
        echo $karyawan->getInfo();
    }
}
?>