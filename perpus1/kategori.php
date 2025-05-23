<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Ambil data kategori dari database
$list_kategori = select("SELECT * FROM kategori");
$_SESSION['kategori_data'] = $list_kategori;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background: linear-gradient(to right, #ede7f6, #f3e5f5);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: #673ab7;
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: white !important;
      font-weight: 600;
    }
    .table-hover tbody tr:hover {
      background-color: #f5f5f5;
    }
    .btn-info {
      background-color: #64b5f6;
      border: none;
    }
    .btn-secondary {
      background-color: #b39ddb;
      border: none;
    }
    footer {
      background-color: #311b92;
      color: white;
      padding: 15px 0;
      margin-top: auto;
    }
  </style>
</head>
<body>

  <!-- Konten Utama -->
  <div class="container">
    <h2 class="text-center fw-bold mb-4">📂 Daftar Kategori</h2>

    <div class="d-flex justify-content-end mb-3">
      <a href="tambahkategori.php" class="btn btn-dark">➕ Tambah Kategori</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($list_kategori)): ?>
            <?php $no = 1; ?>
            <?php foreach ($list_kategori as $kategori): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td class="text-start"><?= $kategori['nama']; ?></td>
                <td>
                  <a href="ubahkategori.php?id=<?= $kategori['id']; ?>" class="btn btn-info btn-sm">Ubah</a>
                  <a href="hapuskategori.php?id=<?= $kategori['id']; ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">Tidak ada data kategori.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
