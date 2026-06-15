<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../app/classes/database.php';

header('Content-Type: application/json');

// Hapus detail pembelian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['action']) || $_POST['action'] !== 'delete_header')) {
    $response = ['success' => false, 'message' => ''];
    
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        $no_item = $_POST['no_item'] ?? $_GET['no_item'] ?? '';
        
        if (empty($no_item)) {
            throw new Exception('No Item tidak valid!');
        }
        
        // Mulai transaksi
        $conn->begin_transaction();
        
        // Ambil data sebelum hapus untuk update stok
        $query_get = "SELECT no_pembelian, kd_barang, jumlah_barang FROM detail_pembelian WHERE no_item = ?";
        $stmt = $conn->prepare($query_get);
        $stmt->bind_param("i", $no_item);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        
        if (!$data) {
            throw new Exception('Data tidak ditemukan!');
        }
        
        // Kurangi stok barang
        $query_stok = "UPDATE tb_barang SET stok = stok - ? WHERE kd_barang = ?";
        $stmt = $conn->prepare($query_stok);
        $stmt->bind_param("is", $data['jumlah_barang'], $data['kd_barang']);
        $stmt->execute();
        
        // Hapus detail pembelian
        $query_delete = "DELETE FROM detail_pembelian WHERE no_item = ?";
        $stmt = $conn->prepare($query_delete);
        $stmt->bind_param("i", $no_item);
        $stmt->execute();
        
        // Cek apakah masih ada detail lain dengan no_pembelian yang sama
        $query_cek = "SELECT COUNT(*) as total FROM detail_pembelian WHERE no_pembelian = ?";
        $stmt = $conn->prepare($query_cek);
        $stmt->bind_param("s", $data['no_pembelian']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        // Jika tidak ada detail lagi, hapus juga header pembelian
        if ($result['total'] == 0) {
            $query_hapus_header = "DELETE FROM tb_pembelian WHERE no_pembelian = ?";
            $stmt = $conn->prepare($query_hapus_header);
            $stmt->bind_param("s", $data['no_pembelian']);
            $stmt->execute();
        }
        
        // Commit transaksi
        $conn->commit();
        
        $response['success'] = true;
        $response['message'] = 'Data berhasil dihapus!';
        
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

// Hapus header pembelian (beserta semua detailnya)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_header') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        $no_pembelian = $_POST['no_pembelian'] ?? '';
        
        if (empty($no_pembelian)) {
            throw new Exception('No Pembelian tidak valid!');
        }
        
        // Mulai transaksi
        $conn->begin_transaction();
        
        // Ambil semua detail untuk update stok
        $query_get_details = "SELECT kd_barang, jumlah_barang FROM detail_pembelian WHERE no_pembelian = ?";
        $stmt = $conn->prepare($query_get_details);
        $stmt->bind_param("s", $no_pembelian);
        $stmt->execute();
        $details = $stmt->get_result();
        
        // Kembalikan stok untuk setiap barang
        while ($detail = $details->fetch_assoc()) {
            $query_stok = "UPDATE tb_barang SET stok = stok - ? WHERE kd_barang = ?";
            $stmt_stok = $conn->prepare($query_stok);
            $stmt_stok->bind_param("is", $detail['jumlah_barang'], $detail['kd_barang']);
            $stmt_stok->execute();
        }
        
        // Hapus semua detail pembelian
        $query_delete_details = "DELETE FROM detail_pembelian WHERE no_pembelian = ?";
        $stmt = $conn->prepare($query_delete_details);
        $stmt->bind_param("s", $no_pembelian);
        $stmt->execute();
        
        // Hapus header pembelian
        $query_delete_header = "DELETE FROM tb_pembelian WHERE no_pembelian = ?";
        $stmt = $conn->prepare($query_delete_header);
        $stmt->bind_param("s", $no_pembelian);
        $stmt->execute();
        
        // Commit transaksi
        $conn->commit();
        
        $response['success'] = true;
        $response['message'] = 'Transaksi pembelian berhasil dihapus!';
        
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

// Jika via GET (untuk kompatibilitas dengan link lama)
if (isset($_GET['no_item'])) {
    $_POST['no_item'] = $_GET['no_item'];
    // Lanjut ke proses delete detail di atas
}

echo json_encode(['success' => false, 'message' => 'Method not allowed']);
?>