<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "si_gudang";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Method baru untuk mengambil data supplier
    public function getSuppliers() {
        $query = "SELECT id_supplier, nama_supplier FROM tb_supplier ORDER BY nama_supplier ASC";
        $result = $this->conn->query($query);
        
        $suppliers = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $suppliers[] = $row;
            }
        }
        return $suppliers;
    }

    // Method untuk menutup koneksi
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>