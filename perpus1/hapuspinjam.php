<?php
include 'config/controller.php';

if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID peminjaman tidak ditemukan!');
        document.location.href = 'bukuyangdipinjam.php';
    </script>";
    exit;
}

$id = intval($_GET['id']);

if (delete_peminjaman($id) < 0) {
    echo "<script>
        alert('❌ Gagal menghapus data!');
        document.location.href = 'bukudipinjam.php';
    </script>";
} else {
    echo "<script>
        alert('🗑️ Data peminjaman berhasil dihapus!');
        document.location.href = 'bukudipinjam.php';
    </script>";
}
?>
