<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

$siswa = select("SELECT * FROM siswa");
$_SESSION['siswa_data'] = $siswa;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
  <h2 class="text-center fw-bold mb-4">🧑‍🎓 Daftar Siswa</h2>

  <div class="d-flex justify-content-between mb-3">
    <a href="tambahsiswa.php" class="btn btn-dark">➕ Tambah Siswa</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead class="table-secondary">
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($siswa)): ?>
          <?php $no = 1; ?>
          <?php foreach ($siswa as $row): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['id']; ?></td>
              <td class="text-start"><?= $row['nama']; ?></td>
              <td><?= $row['kelas']; ?></td>
              <td class="text-start"><?= $row['alamat']; ?></td>
              <td>
                <a href="updatesiswa.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Ubah</a>
                <a href="deletesiswa.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6">Tidak ada data siswa.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
