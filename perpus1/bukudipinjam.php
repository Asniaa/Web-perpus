<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Ambil data peminjaman dari database
$peminjaman = select("
    SELECT peminjaman.id, siswa.nama AS nama_siswa, buku.judul_buku, peminjaman.jumlah_buku, 
           peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
    FROM peminjaman
    JOIN siswa ON peminjaman.id_siswa = siswa.id
    JOIN buku ON peminjaman.id_buku = buku.id
");

$_SESSION['peminjaman_data'] = $peminjaman;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Peminjaman Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #fff3e0, #e1f5fe);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: #1976d2;
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: white !important;
      font-weight: 600;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }
    .btn-info {
      background-color: #64b5f6;
      border: none;
    }
    .btn-danger {
      background-color: #e57373;
      border: none;
    }
    footer {
      background-color: #0d47a1;
      color: white;
      padding: 15px 0;
      margin-top: auto;
    }
  </style>
</head>
<body>

  <!-- Konten Utama -->
  <div class="container">
    <h2 class="text-center fw-bold mb-4">📖 Daftar Buku yang Dipinjam</h2>

    <div class="d-flex justify-content-between mb-3">
      <a href="tambahpinjam.php" class="btn btn-dark">➕ Tambah Peminjaman</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Judul Buku</th>
            <th>Jumlah Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($peminjaman)) : ?>
            <?php foreach ($peminjaman as $i => $pinjam) : ?>
              <tr>
                <td><?= $i + 1; ?></td>
                <td><?= htmlspecialchars($pinjam['nama_siswa']); ?></td>
                <td class="text-start"><?= htmlspecialchars($pinjam['judul_buku']); ?></td>
                <td><?= htmlspecialchars($pinjam['jumlah_buku']); ?></td>
                <td><?= htmlspecialchars($pinjam['tanggal_pinjam']); ?></td>
                <td><?= htmlspecialchars($pinjam['tanggal_kembali']); ?></td>
                <td>
                  <a href="ubahpinjam.php?id=<?= $pinjam['id']; ?>" class="btn btn-info btn-sm">Ubah</a>
                  <a href="hapuspinjam.php?id=<?= $pinjam['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
