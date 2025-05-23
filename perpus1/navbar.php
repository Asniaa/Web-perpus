<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg" style="background-color: #673ab7;">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="#">📚 E-Library</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Semua role bisa akses Beranda -->
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php">🏠 Beranda</a>
        </li>

        <?php if ($_SESSION['role'] === 'admin'): ?>
          <li class="nav-item"><a class="nav-link text-white" href="admin.php">👩 Admin</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="petugas.php">👨‍💼 Petugas</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="siswa.php">🎓 Siswa</a></li>

        <?php elseif ($_SESSION['role'] === 'petugas'): ?>
          <li class="nav-item"><a class="nav-link text-white" href="petugas.php">👨‍💼 Petugas</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="siswa.php">🎓 Siswa</a></li>

        <?php elseif ($_SESSION['role'] === 'siswa'): ?>
          <li class="nav-item"><a class="nav-link text-white" href="siswa.php">🎓 Siswa</a></li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link text-danger fw-semibold" href="logout.php">🚪 Logout</a>
        </li>
      </ul>
      
      <span class="navbar-text text-white fw-semibold">
        Login sebagai: <?= $_SESSION['username'] ?> (<?= ucfirst($_SESSION['role']) ?>)
      </span>
    </div>
  </div>
</nav>
