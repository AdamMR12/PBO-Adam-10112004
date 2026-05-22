<?php
session_start();
require_once '../../app/classes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';


$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT id_user, nama, password, alamat, pekerjaan FROM user WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        
        header("Location: dashboard.php");
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