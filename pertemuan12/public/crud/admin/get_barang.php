<?php
// Cek session sebelum start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../app/classes/database.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    $query = "SELECT 
                tb.kd_barang, 
                tb.nama_barang, 
                tb.stok, 
                tb.harga,
                tb.kode_jenis,
                tj.jenis
              FROM tb_barang tb
              LEFT JOIN tb_jenis tj ON tb.kode_jenis = tj.kode_jenis
              ORDER BY tb.kd_barang ASC";
    
    $result = $conn->query($query);
    
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $database->closeConnection();
    
    echo json_encode($data);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>