<?php
// Cek session sebelum start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../app/classes/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Validasi input
        $no_item = $_POST['no_item'] ?? '';
        $kd_barang = $_POST['kd_barang'] ?? '';
        $kode_jenis = $_POST['kode_jenis'] ?? '';
        $jumlah_barang = $_POST['jumlah_barang'] ?? 0;
        $harga_barang = $_POST['harga_barang'] ?? 0;
        $total_harga = $_POST['total_harga'] ?? 0;
        
        if (empty($no_item)) {
            throw new Exception('No Item tidak valid!');
        }
        
        // Mulai transaksi
        $conn->begin_transaction();
        
        // Ambil data lama untuk menghitung selisih stok
        $query_old = "SELECT kd_barang, jumlah_barang FROM detail_pembelian WHERE no_item = ?";
        $stmt = $conn->prepare($query_old);
        $stmt->bind_param("i", $no_item);
        $stmt->execute();
        $old_data = $stmt->get_result()->fetch_assoc();
        
        if (!$old_data) {
            throw new Exception('Data tidak ditemukan!');
        }
        
        $selisih = $jumlah_barang - $old_data['jumlah_barang'];
        
        // Update detail_pembelian
        $query_update = "UPDATE detail_pembelian 
                        SET kd_barang = ?, kode_jenis = ?, jumlah_barang = ?, 
                            harga_barang = ?, total_harga = ? 
                        WHERE no_item = ?";
        $stmt = $conn->prepare($query_update);
        $stmt->bind_param("ssiddi", $kd_barang, $kode_jenis, $jumlah_barang, $harga_barang, $total_harga, $no_item);
        $stmt->execute();
        
        // Update stok barang
        $query_stok = "UPDATE tb_barang SET stok = stok + ? WHERE kd_barang = ?";
        $stmt = $conn->prepare($query_stok);
        $stmt->bind_param("is", $selisih, $old_data['kd_barang']);
        $stmt->execute();
        
        // Commit transaksi
        $conn->commit();
        
        $response['success'] = true;
        $response['message'] = 'Data berhasil diupdate!';
        
        $database->closeConnection();
        
    } catch (Exception $e) {
        if (isset($conn)) {
            $conn->rollback();
        }
        $response['message'] = 'Error: ' . $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Method not allowed']);
?>