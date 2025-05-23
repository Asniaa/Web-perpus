<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Ambil data buku dari database
$data_buku = select("SELECT * FROM buku");
$_SESSION['buku_data'] = $data_buku;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Buku (Siswa)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #e1f5fe, #fce4ec);
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
    .card-img-top {
      height: 200px;
      width: 100%;
      object-fit: contain;
      border-bottom: 1px solid #ddd;
      background-color: #f8f9fa;
    }
    .card:hover {
      transform: scale(1.02);
      transition: 0.2s;
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

  <!-- Konten Utama -->
  <div class="container mb-5">
    <h2 class="text-center fw-bold mb-4">📘 Daftar Buku yang Tersedia</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php if (!empty($data_buku)): ?>
        <?php foreach ($data_buku as $buku): ?>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="<?= htmlspecialchars($buku['gambar'] ?? 'https://via.placeholder.com/300x200?text=No+Image'); ?>" class="card-img-top" alt="<?= htmlspecialchars($buku['judul_buku']); ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($buku['judul_buku']); ?></h5>
                <p class="card-text"><strong>Penulis:</strong> <?= htmlspecialchars($buku['pengarang']); ?></p>
                <p class="card-text"><strong>Tahun:</strong> <?= $buku['tahun_terbit']; ?></p>
                <p class="card-text"><strong>Jumlah:</strong> <?= $buku['jumlah_buku']; ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">Tidak ada data buku.</p>
      <?php endif; ?>
    </div>
  </div>

  <footer class="text-center">
    <div class="container">
      <p class="mb-0">📚 E-Library Seven &copy; <?= date('Y'); ?></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
