<?php
session_start();
require_once '../../app/classes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validate input
if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username and password are required!";
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT id_user, nama, password, alamat, pekerjaan, role FROM user WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // LANGSUNG BANDINGKAN PASSWORD (TANPA HASH)
    if ($password == $user['password']) {  // LANGSUNG COMPARE STRING
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['nama'];
        
        // Redirect based on role
        if ($_SESSION['role'] == "admin") {
            header("Location: ../admin/index.php");
        } elseif ($_SESSION['role'] == "customer") {
            header("Location: ../customer/index.php");
        } elseif ($_SESSION['role'] == "supplier") {
            header("Location: ../supplier/index.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "Password salah!";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Username tidak ditemukan!";
    header("Location: login.php");
    exit();
}

$stmt->close();
$conn->close();
?>