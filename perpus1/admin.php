<?php
session_start();
include 'navbar.php';
include 'config/controller.php';

// Validasi role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: frmlogin.php");
    exit();
}

// Ambil data statistik
$total_buku     = select("SELECT SUM(jumlah_buku) AS total FROM buku")[0]['total'] ?? 0;
$total_kategori = select("SELECT COUNT(*) AS total FROM kategori")[0]['total'] ?? 0;
$total_user     = select("SELECT COUNT(*) AS total FROM login")[0]['total'] ?? 0;
$total_siswa    = select("SELECT COUNT(*) AS total FROM siswa")[0]['total'] ?? 0;
$total_dipinjam = select("SELECT SUM(jumlah_buku) AS total FROM peminjaman")[0]['total'] ?? 0;

// Ambil 5 aktivitas terakhir
$recent_logs = get_recent_logs(5); // Pastikan fungsi ini tersedia di controller.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #f3e5f5, #ede7f6);
            font-family: 'Segoe UI', sans-serif;
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
        .activity-item {
            border-left: 3px solid #673ab7;
            padding-left: 10px;
            margin-bottom: 8px;
        }
        .activity-time {
            font-size: 0.8rem;
            color:rgb(108, 117, 125);
        }
        /* ADDED THIS CSS RULE */
        .bg-purple {
            background-color: #673ab7 !important;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold">Selamat Datang, Admin!</h1>
        <p class="text-muted">Kelola semua fitur **E-Library** dengan mudah dan cepat.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <?php
        $cards = [
            ['📖 Total Buku', "$total_buku Buku", 'buku.php', '#e1bee7'],
            ['📂 Kategori', "$total_kategori Kategori", 'kategori.php', '#d1c4e9'],
            ['👩‍💻 Pengguna', "$total_user Pengguna", 'register.php', '#c5cae9'],
            ['🎓 Siswa', "$total_siswa Siswa", 'datasiswa.php', '#b2dfdb'],
            ['📖 Buku yang Dipinjam', "$total_dipinjam Buku", 'bukudipinjam.php', 'rgb(145, 176, 218)']
        ];

        $delay = 100;
        foreach ($cards as $card) {
            echo "
                <div class='col-md-3' data-aos='zoom-in' data-aos-delay='{$delay}'>
                    <div class='card card-custom text-center' style='background-color: {$card[3]};'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$card[0]}</h5>
                            <p class='card-text'>{$card[1]}</p>
                            <a href='{$card[2]}' class='btn btn-light'>Lihat Detail</a>
                        </div>
                    </div>
                </div>
            ";
            $delay += 100;
        }
        ?>
    </div>

    <div class="row mt-4">
        <div class="col-md-6" data-aos="fade-right">
            <div class="card card-custom shadow-sm">
                <div class="card-header bg-purple text-white">
                    <h5>📜 Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_logs)) : ?>
                        <?php foreach ($recent_logs as $log): ?>
                            <div class="activity-item">
                                <strong><?= ucfirst($log['level']) ?> <?= htmlspecialchars($log['name']) ?></strong>
                                <span class="activity-time"><?= waktu_lalu($log['created_at']) ?></span>
                                <div><?= htmlspecialchars($log['aktivitas']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-muted">Belum ada aktivitas</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left">
            <div class="card card-custom shadow-sm">
                <div class="card-body">
                    <h5 class="section-title">📊 Laporan Ringkas</h5>
                    <canvas id="laporanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-3 mt-5">
    <small>&copy; <?= date('Y') ?> E-Library Seven.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();

    const ctx = document.getElementById('laporanChart').getContext('2d');
    const laporanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Buku', 'Dipinjam', 'Pengguna', 'Siswa'],
            datasets: [{
                label: 'Total Data',
                data: [<?= $total_buku ?>, <?= $total_dipinjam ?>, <?= $total_user ?>, <?= $total_siswa ?>],
                backgroundColor: ['#ce93d8', '#90caf9', '#a5d6a7', '#ffe082']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
</body>
</html>