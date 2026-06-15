<?php
// Cek session sebelum start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '../../../app/classes/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Validasi input
        $no_faktur = $_POST['no_faktur'] ?? '';
        $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? '';
        $supplier = $_POST['supplier'] ?? '';
        $kd_barang = $_POST['kd_barang'] ?? '';
        $kode_jenis = $_POST['kode_jenis'] ?? '';
        $jumlah_barang = $_POST['jumlah_barang'] ?? 0;
        $harga_barang = $_POST['harga_barang'] ?? 0;
        $total_harga = $_POST['total_harga'] ?? 0;
        
        // Validasi field wajib
        if (empty($no_faktur) || empty($kd_barang) || empty($jumlah_barang)) {
            throw new Exception('Field wajib tidak boleh kosong!');
        }
        
        // Mulai transaksi
        $conn->begin_transaction();
        
        // Insert ke tb_pembelian
        $query_pembelian = "INSERT INTO tb_pembelian (no_pembelian, tanggal_pembelian, id_supplier) 
                           VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query_pembelian);
        $stmt->bind_param("ssi", $no_faktur, $tanggal_pembelian, $supplier);
        $stmt->execute();
        
        // Insert ke detail_pembelian
        $query_detail = "INSERT INTO detail_pembelian (no_pembelian, kd_barang, kode_jenis, jumlah_barang, harga_barang, total_harga) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query_detail);
        $stmt->bind_param("sssidd", $no_faktur, $kd_barang, $kode_jenis, $jumlah_barang, $harga_barang, $total_harga);
        $stmt->execute();
        
        // Update stok barang
        $query_update_stok = "UPDATE tb_barang SET stok = stok + ? WHERE kd_barang = ?";
        $stmt = $conn->prepare($query_update_stok);
        $stmt->bind_param("is", $jumlah_barang, $kd_barang);
        $stmt->execute();
        
        // Commit transaksi
        $conn->commit();
        
        $response['success'] = true;
        $response['message'] = 'Data pembelian berhasil disimpan!';
        
        $database->closeConnection();
        
    } catch (Exception $e) {
        // Rollback jika terjadi error
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