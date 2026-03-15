<?php
$data = [
    ["nama"=>"adam","nilai"=>80],
    ["nama"=>"mada","nilai"=>85],
    ["nama"=>"dama","nilai"=>75]
];

echo "<table border='1'>";
echo "<tr><th>Nama</th><th>Nilai</th></tr>";
foreach($data as $n){
    echo "<tr>";
    echo "<td>".$n["nama"]."</td>";
    echo "<td>".$n["nilai"]."</td>";
    echo "</tr>";
}
echo "</table>";
?>