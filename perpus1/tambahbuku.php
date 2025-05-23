<?php
// tambahbuku.php

// Pastikan file controller.php (atau app.php) sudah memuat fungsi select()
include "config/app.php"; // Atau "config/controller.php" jika nama filenya berbeda

// Ambil daftar kategori dari database
$kategoris = select("SELECT id, nama FROM kategori ORDER BY nama ASC");

if (isset($_POST['tambah'])) {
    // Panggil fungsi create_buku dengan data dari form
    $result = create_buku($_POST); // create_buku sekarang mengembalikan -1 jika gagal

    if ($result < 0) {
        echo "<script>
            alert('❌ Data buku gagal ditambahkan! Pastikan kategori yang dipilih valid.');
            document.location.href='tambahbuku.php';
        </script>";
    } else {
        echo "<script>
            alert('✅ Data buku berhasil ditambahkan!');
            document.location.href='buku.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #e8f5e9);
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">📚 Tambah Data Buku</h2>

        <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select class="form-select" id="id_kategori" name="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategoris as $kategori) : ?>
                        <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
            </div>

            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" required>
            </div>

            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required min="1900" max="<?= date('Y'); ?>">
            </div>

            <div class="mb-3">
                <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" required min="1">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">URL Gambar</label>
                <input type="text" class="form-control" id="gambar" name="gambar">
                <small class="form-text text-muted">Opsional: Masukkan URL gambar buku.</small>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="tambah" class="btn btn-primary">💾 Simpan</button>
                <a href="admin.php" class="btn btn-secondary">↩️ Kembali</a>
            </div>
        </form>
    </div>

</body>
</html>