<?php

function getDataPembelian() {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Query JOIN untuk mengambil data dari kedua tabel
    $query = "SELECT 
                pb.no_pembelian, 
                pb.tanggal_pembelian, 
                pb.id_supplier, 
                sp.nama_supplier, 
                pb.total_barangall, 
                pb.total_hargaall 
              FROM tb_pembelian pb 
              LEFT JOIN tb_supplier sp ON pb.id_supplier = sp.id_supplier 
              ORDER BY pb.tanggal_pembelian DESC";
    
    $result = $conn->query($query);
    
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $database->closeConnection();
    return $data;
}

// Jika dipanggil langsung
if (basename($_SERVER['PHP_SELF']) == 'get_pembelian.php') {
    header('Content-Type: application/json');
    echo json_encode(getDataPembelian());
}
?>