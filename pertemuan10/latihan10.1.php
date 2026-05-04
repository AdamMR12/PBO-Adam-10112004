<?php
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

class TagihanListrikRepository{
    private $data = [
        ["nama"=>"budi","kwh"=>1200],
        ["nama"=>"sinta","kwh"=>800],
        ["nama"=>"rani","kwh"=>1500]
    ];

    public function getAll(){
        return $this->data;
    }
}

class TagihanListrik{
    private $nama;
    private $kwh;
    private $tarif = 1500;

    public function setData($nama,$kwh){
        $this->nama;
        $this->kwh;
    }

    public function getNama(){
        return $this->nama;
    }

    public function hitungTotal(){
        $total = $this->kwh *$this->tarif;

        if($this->kwh > 1000){
            $total = $total - 50000;
        }
        return $total;
    }
}

$repo = new TagihanListrikRepository();
$data = $repo->getAll();

$hasil = [];

foreach($data as $d){
    $obj = new TagihanListrik();
    $obj->setData($d["nama"],$d["kwh"]);

    $hasil[] = [
        "nama"=>$obj->getNama(),
        "kwh"=>$d["kwh"],
        "total"=>$obj->hitungTotal()
    ];
}

echo "<h2>DATA TAGIHAN LISTRIK</h2>";

echo "<table border='1' cellpadding='6'>";
echo "<tr>
<th>No</th>
<th>Nama</th>
<th>Pemakaian (kWh)</th>
<th>Total Bayar</th>
</tr>";

$no = 1;

foreach($hasil as $h){
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $h["nama"] . "</td>";
    echo "<td>" . $h["kwh"] . "</td>";
    echo "<td>" . formatRupiah($h["total"]) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>