<?php
include 'config/controller.php';

$id = $_GET['id'];

if (delete_buku($id) > 0) {
    echo "<script>
        alert('Data buku berhasil dihapus!');
        document.location.href = 'buku.php';
    </script>";
} else {
    echo "<script>
        alert('Data buku gagal dihapus!');
        document.location.href = 'buku.php';
    </script>";
}
