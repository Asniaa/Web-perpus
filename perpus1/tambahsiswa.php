<?php
include 'config/controller.php';

if (isset($_POST['submit'])) {
    if (create_siswa($_POST) > 0) {
        echo "success";
        exit;
    } else {
        echo "error";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #ede7f6, #e1f5fe);
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 600px;
    }
    .form-label {
      font-weight: 500;
    }
    .btn-primary {
      background-color: #5e35b1;
      border: none;
    }
    .btn-secondary {
      background-color: #9fa8da;
      border: none;
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">🧑‍🎓 Form Tambah Siswa</h2>

    <form id="tambahSiswaForm" method="POST" class="bg-light p-4 rounded shadow-sm">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="text" name="kelas" id="kelas" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control" required>
      </div>
      <div class="d-flex justify-content-between">
        <button type="submit" name="submit" class="btn btn-primary">➕ Tambah</button>
        <a href="datasiswa.php" class="btn btn-secondary">↩️ Batal</a>
      </div>
    </form>
  </div>

  <!-- AJAX Script -->
  <script>
    $(document).ready(function () {
      $("#tambahSiswaForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          url: "", // Kirim ke file ini sendiri
          type: "POST",
          data: formData + "&submit=true",
          success: function (response) {
            if (response.trim() === "success") {
               alert("✅ siswa berhasil ditambahkan!");
               window.location.href = "datasiswa.php";
            } else {
              alert("❌ Gagal menambahkan siswa. Coba lagi.");
            }
          },
          error: function () {
            alert("⚠️ Terjadi kesalahan dengan AJAX!");
          }
        });
      });
    });
  </script>

</body>
</html>
