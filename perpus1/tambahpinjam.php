<?php
session_start();
include 'config/controller.php';

// Ambil data siswa dan buku 
$siswa = select("SELECT * FROM siswa");
$buku = select("SELECT * FROM buku");

if (isset($_POST['tambah'])) {
    if (create_peminjaman($_POST) < 0) {
        echo "<script>
            alert('❌ Gagal menambahkan data peminjaman!');
        </script>";
    } else {
        echo "<script>
            alert('✅ Data peminjaman berhasil ditambahkan!');
            document.location.href = 'bukudipinjam.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #e1f5fe, #fff8e1);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: #0288d1;
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: white !important;
      font-weight: 600;
    }
    footer {
      background-color: #01579b;
      color: white;
      padding: 15px 0;
      margin-top: auto;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">📚 E-Library Seven</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="admin.php">👨‍💼 Admin</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php">🏠 Beranda</a></li>
      <li class="nav-item"><a class="nav-link text-danger fw-bold" href="logout.php">🚪 Logout</a></li>
    </ul>
  </div>
</nav>

<!-- Form Tambah Peminjaman -->
<div class="container">
  <h2 class="text-center fw-bold mb-4">➕ Tambah Data Peminjaman</h2>

  <form method="POST" class="bg-light p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="id_siswa" class="form-label">Nama Siswa</label>
      <select name="id_siswa" id="id_siswa" class="form-select" required>
        <option value="" disabled selected>-- Pilih Siswa --</option>
        <?php foreach ($siswa as $s) : ?>
          <option value="<?= $s['id']; ?>"><?= htmlspecialchars($s['nama']); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="id_buku" class="form-label">Judul Buku</label>
      <select name="id_buku" id="id_buku" class="form-select" required>
        <option value="" disabled selected>-- Pilih Buku --</option>
        <?php foreach ($buku as $b) : ?>
          <option value="<?= $b['id']; ?>"><?= htmlspecialchars($b['judul_buku']); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
      <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control" min="1" value="1" required>
    </div>

    <div class="mb-3">
      <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
      <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
      <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
    </div>

    <!-- Status field removed -->

    <div class="d-flex justify-content-between">
      <button type="submit" name="tambah" class="btn btn-success">💾 Simpan</button>
      <a href="bukudipinjam.php" class="btn btn-secondary">↩️ Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
