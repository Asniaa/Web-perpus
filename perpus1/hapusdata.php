<?php
include 'config/controller.php';

// Memeriksa apakah 'id' ada dan angka valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Kondisi tombol hapus diklik
    if (isset($id) && is_numeric($id)) {
    if (delete_login($id) > 0) {
        echo "<script>alert('Data Berhasil Dihapus'); document.location.href='register.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus'); document.location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid'); document.location.href='register.php';</script>";
}
}
?>
