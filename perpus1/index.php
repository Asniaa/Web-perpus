<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-Library Seven</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-image: url('https://i.pinimg.com/736x/7a/11/34/7a11345392fc0525099fd9c7ba64e2fd.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .overlay {
      background-color: rgba(255, 255, 255, 0.9);
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    header h1 {
      font-weight: 700;
      color: #2c3e50;
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 40px 20px;
    }

    .main-box {
      background-color: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    .main-box h2 {
      font-weight: 600;
      color: #3498db;
      margin-bottom: 10px;
    }

    .main-box p {
      color: #6c757d;
      font-size: 1.1rem;
      margin-bottom: 30px;
    }

    .btn-primary {
      background-color: #3498db;
      border: none;
      font-weight: 600;
      padding: 12px 24px;
      border-radius: 10px;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    footer {
      background-color: #2c3e50;
      color: white;
      padding: 15px 0;
      text-align: center;
      font-size: 0.9rem;
    }

    @media (max-width: 576px) {
      .main-box {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="overlay">
    <!-- Header -->
    <header>
      <h1>E-Library Seven</h1>
    </header>

    <!-- Main Content -->
    <section class="main-content">
      <div class="main-box">
        <h2>📚 Selamat Datang</h2>
        <p>Temukan dan baca koleksi buku digital terbaik dari mana saja, kapan saja.</p>
        <a href="frmlogin.php" class="btn btn-primary">🔐 Login Sekarang</a>
        <a href="tambahdata2.php" class="btn btn-primary">🖥 Registrasi Sekarang</a>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <p>Info Sekolah</p>
      <p>© <?= date('Y') ?> Perpustakaan Seven Digital</p>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
