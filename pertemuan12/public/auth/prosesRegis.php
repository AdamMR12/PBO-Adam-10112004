<?php
session_start();
require_once '../../app/classes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit();
}

$nama = trim($_POST['nama'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi_password = $_POST['konfirmasi_password'] ?? '';
$alamat = trim($_POST['alamat'] ?? '');
$pekerjaan = trim($_POST['pekerjaan'] ?? '');

if (empty($nama) || empty($password) || empty($alamat) || empty($pekerjaan)) {
    $_SESSION['error'] = "Semua field harus diisi!";
    header("Location: register.php");
    exit();
}

if ($password != $konfirmasi_password) {
    $_SESSION['error'] = "Password dan konfirmasi password tidak cocok!";
    header("Location: register.php");
    exit();
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password minimal 6 karakter!";
    header("Location: register.php");
    exit();
}

$database = new Database();
$conn = $database->getConnection();

$check_sql = "SELECT id_user FROM user WHERE nama = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $nama);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    $_SESSION['error'] = "Username sudah terdaftar! Silakan gunakan username lain.";
    header("Location: register.php");
    exit();
}
$check_stmt->close();

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (nama, password, alamat, pekerjaan) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $hashed_password, $alamat, $pekerjaan);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
    header("Location: login.php");
    exit();
} else {
    $_SESSION['error'] = "Registrasi gagal: " . $conn->error;
    header("Location: register.php");
    exit();
}

$stmt->close();
$conn->close();
?>