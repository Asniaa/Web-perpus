<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Ambil data dari database
$total_buku = select("SELECT SUM(jumlah_buku) AS total FROM buku")[0]['total'] ?? 0;
$total_kategori = select("SELECT COUNT(*) AS total FROM kategori")[0]['total'] ?? 0;
$total_siswa = select("SELECT COUNT(*) AS total FROM siswa")[0]['total'] ?? 0;
$total_dipinjam = select("SELECT SUM(jumlah_buku) AS total FROM peminjaman")[0]['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Petugas</title>
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
    .navbar {
        background-color: #673ab7;
    }
    .navbar .nav-link,
    .navbar .navbar-brand {
        color: white !important;
        font-weight: 600;
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
    }
    .section-title {
        font-weight: 700;
        color: #4527a0;
        margin-bottom: 1rem;
    }
    .btn-light {
        background-color: #ede7f6;
        color: #4527a0;
        font-weight: 600;
    }
    </style>
</head>
<body>

<!-- Navbar -->

<main class="container py-5">
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold">Selamat Datang, Petugas!</h1>
        <p class="text-muted">Kelola data buku, kategori, dan siswa melalui dashboard ini.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <?php
        $cards = [
            ['📚 Total Buku', "$total_buku Buku", 'buku.php', '#e3f2fd'],
            ['📂 Kategori', "$total_kategori Kategori", 'kategori.php', '#f1f8e9'],
            ['🎓 Total Siswa', "$total_siswa Siswa", 'datasiswa.php', '#fff3e0'],
            ['📖 Buku yang Dipinjam', "$total_dipinjam Buku", 'bukudipinjam.php', '#D7CCC8']
        ];
        $delay = 100;
        foreach ($cards as $card) {
            echo "<div class='col-md-3 col-sm-6' data-aos='zoom-in' data-aos-delay='{$delay}'>
                    <div class='card text-center card-custom' style='background-color: {$card[3]};'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$card[0]}</h5>
                            <p class='card-text'>{$card[1]}</p>
                            <a href='{$card[2]}' class='btn btn-outline-dark'>Lihat Detail</a>
                        </div>
                    </div>
                  </div>";
            $delay += 100;
        }
        ?>
    </div>
</main>

<footer class="text-center py-3 mt-5">
    <small>&copy; <?= date('Y') ?> E-Library Seven.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
