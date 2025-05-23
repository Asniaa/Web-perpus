<?php
include 'config/controller.php';

// Validasi ID di URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        alert('ID kategori tidak valid!');
        document.location.href = 'kategori.php';
    </script>";
    exit;
}

$id = intval($_GET['id']);

// Ambil data kategori
$data = select("SELECT * FROM kategori WHERE id = ?", [$id]);

if (empty($data)) {
    echo "<script>
        alert('Kategori tidak ditemukan!');
        document.location.href = 'kategori.php';
    </script>";
    exit;
}

$kategori = $data[0];

// Proses ubah jika form dikirim
if (isset($_POST['ubah'])) {
    if (update_kategori($_POST) > 0) {
        echo "<script>
            alert('✅ Kategori berhasil diubah!');
            document.location.href = 'kategori.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Gagal mengubah kategori.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">✏️ Ubah Kategori</h2>
    <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= $kategori['id']; ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control"
                   value="<?= htmlspecialchars($kategori['nama']); ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" name="ubah" class="btn btn-primary">💾 Simpan</button>
            <a href="kategori.php" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
