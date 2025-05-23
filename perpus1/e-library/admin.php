<!-- admin.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #FFF9C4;"> 
    <nav class="navbar navbar-expand-lg" style="background-color: #AEDFF7;"> 
        <div class="container">
            <a class="navbar-brand text-dark fw-bold" href="#">📚 E-Library - Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-dark" href="#">📖 Buku</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">👨‍💼 Petugas</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">🎓 Siswa</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1 class="fw-bold text-dark">👋 Selamat Datang, Admin! 🎉</h1>
        <p class="lead text-dark">Kelola semua fitur di platform <strong>E-Library</strong> dengan mudah.</p>
        <a href="frmlogin.php" class="btn btn-danger mt-3">🔙 Kembali ke Login</a>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center" style="background-color: #FFD3B6; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">📚 Total Buku</h5>
                        <p class="card-text">250 Buku</p>
                        <a href="#" class="btn btn-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="background-color: #C8E6C9; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">👨‍💼 Total Petugas</h5>
                        <p class="card-text">15 Petugas</p>
                        <a href="#" class="btn btn-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="background-color: #FFECB3; border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">🎓 Total Siswa</h5>
                        <p class="card-text">750 Siswa</p>
                        <a href="#" class="btn btn-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
