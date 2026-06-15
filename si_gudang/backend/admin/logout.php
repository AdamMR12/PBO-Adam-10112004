<?php
session_start();
session_unset(); // menghapus semua variabel session
session_destroy(); // menghancurkan session

echo "<script>
    alert('Anda berhasil logout. Terimakasih');
    window.location='../../login.php'; // redirect ke halaman depan
</script>";
?>
