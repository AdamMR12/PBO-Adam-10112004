<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../app/classes/database.php';

/**
 * Mengambil semua data detail pembelian
 * @return array
 */
function getDetailPembelian() {
    $database = new Database();
    $conn = $database->getConnection();
    
    $query = "SELECT 
                dp.no_item,
                dp.no_pembelian,
                dp.kd_barang,
                dp.kode_jenis,
                dp.jumlah_barang,
                dp.harga_barang,
                dp.total_harga,
                tb.nama_barang,
                tj.jenis
              FROM detail_pembelian dp
              LEFT JOIN tb_barang tb ON dp.kd_barang = tb.kd_barang
              LEFT JOIN tb_jenis tj ON dp.kode_jenis = tj.kode_jenis
              ORDER BY dp.no_pembelian DESC, dp.no_item ASC";
    
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

/**
 * Mengambil detail pembelian berdasarkan no_item
 * @param int $no_item
 * @return array|null
 */
function getDetailById($no_item) {
    $database = new Database();
    $conn = $database->getConnection();
    
    $query = "SELECT 
                dp.no_item,
                dp.no_pembelian,
                dp.kd_barang,
                dp.kode_jenis,
                dp.jumlah_barang,
                dp.harga_barang,
                dp.total_harga,
                tb.nama_barang,
                tj.jenis
              FROM detail_pembelian dp
              LEFT JOIN tb_barang tb ON dp.kd_barang = tb.kd_barang
              LEFT JOIN tb_jenis tj ON dp.kode_jenis = tj.kode_jenis
              WHERE dp.no_item = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $no_item);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = $result->fetch_assoc();
    
    $database->closeConnection();
    return $data;
}

/**
 * Mengambil data pembelian (header/ringkasan)
 * @return array
 */
function getDataPembelian() {
    $database = new Database();
    $conn = $database->getConnection();
    
    $query = "SELECT 
                tp.no_pembelian,
                tp.tanggal_pembelian,
                tp.id_supplier,
                ts.nama_supplier,
                COUNT(dp.no_item) as total_barangall,
                COALESCE(SUM(dp.total_harga), 0) as total_hargaall
              FROM tb_pembelian tp
              LEFT JOIN tb_supplier ts ON tp.id_supplier = ts.id_supplier
              LEFT JOIN detail_pembelian dp ON tp.no_pembelian = dp.no_pembelian
              GROUP BY tp.no_pembelian, tp.tanggal_pembelian, tp.id_supplier, ts.nama_supplier
              ORDER BY tp.tanggal_pembelian DESC, tp.no_pembelian DESC";
    
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

/**
 * Mengambil detail pembelian berdasarkan no_pembelian
 * @param string $no_pembelian
 * @return array
 */
function getDetailByNoPembelian($no_pembelian) {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Query untuk header pembelian (HAPUS ts.kode_supplier)
    $query_header = "SELECT 
                        tp.no_pembelian,
                        tp.tanggal_pembelian,
                        tp.id_supplier,
                        ts.nama_supplier
                    FROM tb_pembelian tp
                    LEFT JOIN tb_supplier ts ON tp.id_supplier = ts.id_supplier
                    WHERE tp.no_pembelian = ?";
    
    $stmt = $conn->prepare($query_header);
    $stmt->bind_param("s", $no_pembelian);
    $stmt->execute();
    $header = $stmt->get_result()->fetch_assoc();
    
    // Query untuk detail items
    $query_detail = "SELECT 
                        dp.no_item,
                        dp.kd_barang,
                        dp.kode_jenis,
                        dp.jumlah_barang,
                        dp.harga_barang,
                        dp.total_harga,
                        tb.nama_barang,
                        tj.jenis
                    FROM detail_pembelian dp
                    LEFT JOIN tb_barang tb ON dp.kd_barang = tb.kd_barang
                    LEFT JOIN tb_jenis tj ON dp.kode_jenis = tj.kode_jenis
                    WHERE dp.no_pembelian = ?
                    ORDER BY dp.no_item ASC";
    
    $stmt = $conn->prepare($query_detail);
    $stmt->bind_param("s", $no_pembelian);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $details = [];
    while ($row = $result->fetch_assoc()) {
        $details[] = $row;
    }
    
    $database->closeConnection();
    
    return [
        'header' => $header,
        'details' => $details
    ];
}

/**
 * Generate nomor faktur otomatis
 * @return string
 */
function generateNoFaktur() {
    $database = new Database();
    $conn = $database->getConnection();
    
    $query = "SELECT MAX(no_pembelian) as last_no FROM tb_pembelian";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $last_no = $row['last_no'];
    
    if ($last_no) {
        $num = (int)substr($last_no, 4) + 1;
        $no_faktur = "FKP-" . date('Ymd') . "-" . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $no_faktur = "FKP-" . date('Ymd') . "-001";
    }
    
    $database->closeConnection();
    return $no_faktur;
}

// Jika dipanggil via AJAX untuk API
if (isset($_GET['action']) && $_GET['action'] === 'api') {
    header('Content-Type: application/json');
    
    if (isset($_GET['no_item'])) {
        $data = getDetailById($_GET['no_item']);
        echo json_encode($data ?: ['error' => 'Data tidak ditemukan']);
    } elseif (isset($_GET['no_pembelian'])) {
        $data = getDetailByNoPembelian($_GET['no_pembelian']);
        echo json_encode($data);
    } else {
        $data = getDetailPembelian();
        echo json_encode($data);
    }
    exit;
}
?>