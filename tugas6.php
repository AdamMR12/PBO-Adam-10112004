<?php
class BangunRuang {
    public $jenis;
    public $sisi;
    public $jariJari;
    public $tinggi;

    public function hitungVolume() {
        switch ($this->jenis) {
            case 'Bola':
                return (4 / 3) * pi() * pow($this->jariJari, 3);
            case 'Kerucut':
                return (1 / 3) * pi() * pow($this->jariJari, 2) * $this->tinggi;
            case 'Limas Segi Empat':
                return (1 / 3) * pow($this->sisi, 2) * $this->tinggi;
            case 'Kubus':
                return pow($this->sisi, 3);
            case 'Tabung':
                return pi() * pow($this->jariJari, 2) * $this->tinggi;
            default:
                return 0;
        }
    }
}

$dataBangunRuang = [
    ["bidang" => "Bola", "sisi" => 0, "jarijari" => 7, "tinggi" => 0],
    ["bidang" => "Kerucut", "sisi" => 0, "jarijari" => 14, "tinggi" => 10],
    ["bidang" => "Limas Segi Empat", "sisi" => 8, "jarijari" => 0, "tinggi" => 24],
    ["bidang" => "Kubus", "sisi" => 30, "jarijari" => 0, "tinggi" => 0],
    ["bidang" => "Tabung", "sisi" => 0, "jarijari" => 7, "tinggi" => 10]
];

$bangunRuangList = [];
foreach ($dataBangunRuang as $data) {
    $bangun = new BangunRuang();
    $bangun->jenis = $data["bidang"];
    $bangun->sisi = $data["sisi"];
    $bangun->jariJari = $data["jarijari"];
    $bangun->tinggi = $data["tinggi"];
    $bangunRuangList[] = $bangun;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Volume Bangun Ruang</title>
</head>
<body>

<h2>Volume Bangun Ruang</h2>
<table border="1px">
    <tr>
        <th>Jenis Bangun Ruang</th>
        <th>Sisi</th>
        <th>Jari-jari</th>
        <th>Tinggi</th>
        <th>Volume</th>
    </tr>

    <?php foreach ($bangunRuangList as $bangun): ?>
        <?php
        $volume = $bangun->hitungVolume();
        ?>
        <tr>
            <td><?= $bangun->jenis ?></td>
            <td><?= $bangun->sisi ?></td>
            <td><?= $bangun->jariJari ?></td>
            <td><?= $bangun->tinggi ?></td>
            <td><?= round($volume, 6) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>