<?php
include "config/controller.php";

if (isset($_POST['tambah'])) {
    if (create_kategori($_POST) > 0) {
        echo "<script>
            alert('✅ Data berhasil ditambahkan!');
            document.location.href = 'kategori.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Data gagal ditambahkan!');
            document.location.href = 'kategori.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }
        .container {
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">📚 Tambah Kategori Buku</h2>

        <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="id" class="form-label">ID Kategori</label>
                <input type="text" class="form-control" id="id" name="ID" required>
            </div>
        
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="tambah" class="btn btn-primary">💾 Simpan</button>
                <a href="kategori.php" class="btn btn-secondary">↩️ Kembali</a>
            </div>
        </form>
    </div>

    <!-- AJAX Script -->
  <script>
    $(document).ready(function () {
      $("#tambahKategoriForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
    url: "",
    type: "POST",
    data: formData,  // langsung serialize aja
    success: function(response) {
        if (response.trim().startsWith("success")) {
            alert("✅ Kategori berhasil ditambahkan!");
            window.location.href = "buku.php";
        } else {
            alert("❌ Gagal menambahkan buku. " + response);
        }
    },
    error: function() {
        alert("⚠️ Terjadi kesalahan dengan AJAX!");
    }
});

    });
  </script>
</body>
</html>
