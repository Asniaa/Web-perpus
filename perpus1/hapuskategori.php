<?php
include 'config/controller.php';

if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID kategori tidak ditemukan!');
        document.location.href = 'kategori.php';
    </script>";
    exit;
}

$id = intval($_GET['id']);
if (delete_kategori($id) < 0) {
    echo "<script>
        alert('❌ Gagal menghapus kategori.');
        document.location.href = 'kategori.php';
    </script>";
} else {
    echo "<script>
        alert('✅ Kategori berhasil dihapus!');
        document.location.href = 'kategori.php';
    </script>";
}
?>
