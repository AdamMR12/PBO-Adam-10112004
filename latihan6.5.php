<?php
function format($angka){
    return "Rp ".number_format($angka,0,",",".");
}

class belanjaWarung{
        public $namaPembeli;
        public $hargaBarang;
        public $namaBarang;
        public $jmlhBeli;
        public $member;

        public function hitungSubtotal(){
            return $this->hargaBarang * $this->jmlhBeli;
        }

        public function hitungDiskon($subtotal){
            if($subtotal > 100000){
                return $subtotal * 0.1;
            }
            return 0;
        }

        public function hitungTotal(){
            $subtotal = $this->hitungSubtotal();
            $diskon = $this->hitungDiskon($subtotal);
            return $subtotal - $diskon;
        }
    }


    $data = [
    [
        'nama'=>"ivan",
        'barang'=>"sepatu",
        'harga'=>1000000,
        'jumlah'=>2,
        'member'=>true
    ],
    [
        'nama'=>"adam",
        'barang'=>"kaos",
        'harga'=>200000,
        'jumlah'=>2,
        'member'=>false
    ],[
        'nama'=>"maada",
        'barang'=>"celana",
        'harga'=>300000,
        'jumlah'=>1,
        'member'=>true
    ]
    ];
    echo "<table border='1' cellpadding='6'>";

    echo "<tr>
    <th>NO</th>
    <th>Nama</th>
    <th>Member</th>
    <th>Barang</th>
    <th>subtotal</th>
    <th>Diskon</th>
    <th>Total</th>
    </tr>";
    $no = 1;
        foreach($data as $x) {

        $nama   = $x['nama'];
        $barang = $x['barang'];
        $harga  = $x['harga'];
        $jumlah = $x['jumlah'];
        $member = $x['member'];

        $belanja = new belanjaWarung();
        $belanja->namaPembeli = $nama;
        $belanja->namaBarang  = $barang;
        $belanja->hargaBarang = $harga;
        $belanja->jmlhBeli    = $jumlah;
        $belanja->member      = $member;

        $subtotal = $belanja->hitungSubtotal();
        $diskon   = $belanja->hitungDiskon($subtotal);
        $total    = $belanja->hitungTotal();
        
        echo "<tr>";
        echo "<td>". $no ."</td>";
        echo "<td>". $belanja->namaPembeli ."</td>";
        echo "<td>". ($belanja->member ? "ya":"tidak") ."</td>";
        echo "<td>". $belanja->namaBarang ."</td>";
        echo "<td>". format($subtotal) ."</td>";
        echo "<td>". format($diskon) ."</td>";
        echo "<td>". format($total) ."</td>";

        echo "</tr>";
        $no++;
        }
    
        echo "</table>";
    

?>