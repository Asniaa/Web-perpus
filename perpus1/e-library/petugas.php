<!-- petugas.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #F3E5F5;"> <!-- Soft Purple -->
    <nav class="navbar navbar-expand-lg" style="background-color: #D1C4E9;"> <!-- Soft Purple -->
        <div class="container">
            <a class="navbar-brand text-dark fw-bold" href="#">📚 E-Library - Petugas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-dark" href="#">📖 Buku</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">🎓 Siswa</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1 class="fw-bold text-dark">👨‍💼 Selamat Datang, Petugas! 📖</h1>
        <p class="lead text-dark">Kelola data buku dan siswa dengan mudah di <strong>E-Library</strong>.</p>
        <a href="frmlogin.php" class="btn btn-danger mt-3">🔙 Kembali ke Login</a>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center" style="background-color: #B3E5FC; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">📚 Total Buku</h5>
                        <p class="card-text">250 Buku</p>
                        <a href="#" class="btn btn-light">Lihat Buku</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center" style="background-color: #FFCDD2; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">🎓 Total Siswa</h5>
                        <p class="card-text">750 Siswa</p>
                        <a href="#" class="btn btn-light">Lihat Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
