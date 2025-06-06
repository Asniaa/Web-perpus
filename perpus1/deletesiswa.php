<?php
include 'config/controller.php';

$id = $_GET['id'];
if (delete_siswa($id) > 0) {
    echo "<script>alert('Data berhasil dihapus!'); document.location.href='datasiswa.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus!'); document.location.href='datasiswa.php';</script>";
}
?>
