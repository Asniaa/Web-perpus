<?php
session_start();
include 'config/controller.php';

// Ambil data login dari database
$data_login = select("SELECT * FROM login");
$_SESSION['login_data'] = $data_login;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background: linear-gradient(to right, #f3e5f5, #e8eaf6);
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background-color: #5e35b1;
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
    .btn-secondary {
      background-color: #b39ddb;
      border: none;
    }
    footer {
      background-color: #4527a0;
      color: white;
      padding: 15px 0;
      margin-top: 30px;
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

  <!-- Konten -->
  <div class="container">
    <h2 class="text-center fw-bold mb-4">👥 Daftar Pengguna</h2>

    <div class="d-flex justify-content-end mb-3">
      <a href="tambahdata.php" class="btn btn-dark">➕ Tambah Pengguna</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-danger">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($data_login as $login): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $login['name']; ?></td>
              <td><?= $login['username']; ?></td>
              <td><?= $login['password']; ?></td>
              <td><?= ucfirst($login['level']); ?></td>
              <td><?= ucfirst($login['status']); ?></td>
              <td>
                <a href="ubahdata.php?id=<?= $login['id']; ?>" class="btn btn-info btn-sm">Ubah</a>
                <a href="hapusdata.php?id=<?= $login['id']; ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
