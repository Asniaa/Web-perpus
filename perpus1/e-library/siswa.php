<!-- siswa.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #E3F2FD;"> <!-- Soft Blue -->
    <nav class="navbar navbar-expand-lg" style="background-color: #BBDEFB;"> <!-- Soft Blue -->
        <div class="container">
            <a class="navbar-brand text-dark fw-bold" href="#">📚 E-Library - Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-dark" href="#">📖 Buku</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1 class="fw-bold text-dark">🎓 Selamat Datang, Siswa! 📚</h1>
        <p class="lead text-dark">Temukan dan baca buku favoritmu di <strong>E-Library</strong> kapan saja.</p>
        <a href="frmlogin.php" class="btn btn-danger mt-3">🔙 Kembali ke Login</a>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center" style="background-color: #C5E1A5; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">📚 Buku Tersedia</h5>
                        <p class="card-text">250 Buku</p>
                        <a href="#" class="btn btn-light">Lihat Buku</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center" style="background-color: #FFCCBC; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">📖 Buku yang Dipinjam</h5>
                        <p class="card-text">5 Buku</p>
                        <a href="#" class="btn btn-light">Cek Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
