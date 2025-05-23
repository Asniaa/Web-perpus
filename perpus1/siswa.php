<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Ambil data dari database
$total_buku = select("SELECT SUM(jumlah_buku) AS total FROM buku")[0]['total'] ?? 0;
$total_kategori = select("SELECT COUNT(*) AS total FROM kategori")[0]['total'] ?? 0;
// Jika ingin menampilkan total siswa, bisa diambil juga, tapi ini halaman siswa, bisa dihilangkan jika tidak perlu
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Landing Page Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body {
      background: linear-gradient(to right, #f3e5f5, #ede7f6);
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
    .card-custom {
      border-radius: 16px;
      transition: all 0.3s ease;
    }
    .card-custom:hover {
      transform: scale(1.03);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    footer {
      background-color: #311b92;
      color: white;
      padding: 15px 0;
    }
    .btn-light {
      background-color: #ede7f6;
      color: #4527a0;
      font-weight: 600;
    }
  </style>
</head>
<body>

<main class="container py-5">
  <div class="text-center mb-5" data-aos="fade-down">
    <h1 class="fw-bold text-dark">Selamat Datang, Siswa!</h1>
    <p class="lead text-dark">Temukan dan baca buku favoritmu di <strong>E-Library</strong> kapan saja.</p>
  </div>

  <div class="row g-4 justify-content-center">
    <?php
      // Buat array cards dinamis seperti contoh petugas
      $cards = [
        ['📚 Buku Tersedia', "$total_buku Buku", 'bukusiswa.php', '#C5E1A5'],
        ['📂 Kategori', "$total_kategori Kategori", 'kategori.php', '#C8E6C9']
      ];
      $delay = 100;
      foreach ($cards as $card) {
          echo "<div class='col-md-4 col-sm-6' data-aos='zoom-in' data-aos-delay='{$delay}'>
                  <div class='card text-center card-custom' style='background-color: {$card[3]};'>
                    <div class='card-body'>
                      <h5 class='card-title'>{$card[0]}</h5>
                      <p class='card-text'>{$card[1]}</p>
                      <a href='{$card[2]}' class='btn btn-light'>Lihat Detail</a>
                    </div>
                  </div>
                </div>";
          $delay += 100;
      }
    ?>
  </div>
</main>

<footer class="text-center">
  <small>&copy; <?= date('Y') ?> E-Library Seven.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
