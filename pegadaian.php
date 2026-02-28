<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegadaian</title>
</head>
<body>
    <h1>Pegadaian</h1>
    <form action="" method="post">
        pinjaman:   <pre><input type="number" name="pjm"></pre>
        Bunga:      <pre><input type="number" name="bng"></pre>
        Bulan:      <pre><input type="number" name="bln"></pre>
        jatuh tempo:<pre><input type="number" name="tmp"></pre>
        <input type="submit" value="simpan">
    </form>
    <?php

if(empty($_POST['pjm']) || empty($_POST['bng']) || empty($_POST['bln'])){
    echo "Input jumlah pinjaman, bunga, dan lama pinjaman";
    exit;
}

class gadai{
    public $pinjam;
    public $bunga;
    public $bulan;
    public $tempo;
    
    public function bunga(){
        $Tbunga = $this->pinjam * ($this->bunga/100);
        return $Tbunga;
    }
    
    public function totalPinjaman(){
        $Tbunga = $this->bunga();
        $total = $Tbunga + $this->pinjam;
        return $total;
    }
    
    public function angsuran(){
        
        $totalPinjaman = (float)$this->totalPinjaman();
        $bulan = (float)$this->bulan;
        
        if($bulan <= 0) {
            return $totalPinjaman; 
        }
        
        $Tangsu = $totalPinjaman / $bulan;
        return $Tangsu;
    }
    
    public function tempo(){
        $angsu = (float)$this->angsuran();
        $denda = (float)$this->tempo * (15/100) * $angsu;
        $totalBayar = $angsu + $denda;
        return $totalBayar;
    }
}


$pinjam1 = new gadai();
$pinjam1->pinjam = (float)$_POST['pjm'];  
$pinjam1->bunga = (float)$_POST['bng'];    
$pinjam1->bulan = (float)$_POST['bln'];    
$pinjam1->tempo = isset($_POST['tmp']) ? (float)$_POST['tmp'] : 0;  


echo "<h2>Hasil Perhitungan Pegadaian</h2>";
echo "Pinjaman : Rp " . number_format($pinjam1->pinjam, 0, ',', '.') . "<br>";
echo "Bunga : " . $pinjam1->bunga . "%<br>";
echo "Bunga dalam Rupiah : Rp " . number_format($pinjam1->bunga(), 0, ',', '.') . "<br>";
echo "Lama Pinjaman : " . $pinjam1->bulan . " bulan<br>";
echo "Keterlambatan : " . $pinjam1->tempo . " bulan<br><br>";

echo "Total Pinjaman + Bunga : Rp " . number_format($pinjam1->totalPinjaman(), 0, ',', '.') . "<br>";
echo "Angsuran per Bulan : Rp " . number_format($pinjam1->angsuran(), 0, ',', '.') . "<br>";


if($pinjam1->tempo > 0) {
    $denda = $pinjam1->tempo * 0.15 * $pinjam1->angsuran();
    $totalDenganDenda = $pinjam1->tempo();
    
    echo "Denda keterlambatan (" . $pinjam1->tempo . " bulan 0.15%) : Rp " . 
         number_format($denda, 0, ',', '.') . "<br>";
    echo "Total yang harus dibayar (dengan denda) : Rp " . 
         number_format($totalDenganDenda, 0, ',', '.') . "<br>";
} else {
    echo "<br><strong>Tidak ada denda keterlambatan</strong><br>";
    echo "Total yang harus dibayar per bulan : Rp " . 
         number_format($pinjam1->angsuran(), 0, ',', '.') . "<br>";
    echo "Total keseluruhan : Rp " . 
         number_format($pinjam1->totalPinjaman(), 0, ',', '.') . "<br>";
}
?>
</body>
</html>