<?php
function format($angka){
    return "Rp " . number_format($angka,0,",",".");
}

class Belanja {

    public $member;
    public $total;

    public function hitungTotal() {

        $diskon = 0;

        if($this->member == 'ya'){

            if($this->total > 500000){
                $diskon = 50000;
            } elseif($this->total > 100000){
                $diskon = 15000;
            }

        } else {

            if($this->total > 100000){
                $diskon = 5000;
            }
        }

        return $this->total - $diskon;
    }
}

$data = [
    ['member'=>"ya",'total'=>200000],
    ['member'=>"ya",'total'=>570000],
    ['member'=>"tidak",'total'=>120000]
];

for ($x = 0; $x < count($data); $x++) {

    $belanja = new Belanja();
    $belanja->member = $data[$x]['member'];
    $belanja->total  = $data[$x]['total'];

    $totalAkhir = $belanja->hitungTotal();

    echo "<h2>Struk Toko</h2>";
    echo "Member : " . $belanja->member . "<br>";
    echo "Total Awal : " . format($belanja->total) . "<br>";
    echo "Total Bayar : " . format($totalAkhir) . "<br><hr>";
}
?>