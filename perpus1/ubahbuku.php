<?php
include 'config/controller.php';

// Ambil data buku berdasarkan ID
$id = $_GET['id'];
$buku = select("SELECT * FROM buku WHERE id = '$id'")[0];

if (isset($_POST['submit'])) {
    if (update_buku($_POST) > 0) {
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
  <title>Ubah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #ede7f6, #e1f5fe);
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 700px;
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
    .preview-img {
      max-height: 200px;
      border: 1px solid #ccc;
      padding: 5px;
      object-fit: contain;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">✏️ Ubah Buku</h2>

    <form id="ubahBukuForm" method="POST" class="bg-light p-4 rounded shadow-sm">
      <input type="hidden" name="id" value="<?= $buku['id']; ?>">

      <div class="mb-3">
        <label for="id_kategori" class="form-label">ID Kategori</label>
        <input type="text" name="id_kategori" id="id_kategori" class="form-control" value="<?= $buku['id_kategori']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" id="judul_buku" class="form-control" value="<?= $buku['judul_buku']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="pengarang" class="form-label">Pengarang</label>
        <input type="text" name="pengarang" id="pengarang" class="form-control" value="<?= $buku['pengarang']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
        <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control" value="<?= $buku['jumlah_buku']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="gambar" class="form-label">Link Gambar Buku</label>
        <input type="url" name="gambar" id="gambar" class="form-control" value="<?= $buku['gambar']; ?>" placeholder="https://contoh.com/gambar.jpg">
        <?php if (!empty($buku['gambar'])): ?>
          <img src="<?= $buku['gambar']; ?>" alt="Gambar Buku" class="preview-img mt-2">
        <?php endif; ?>
      </div>

      <div class="d-flex justify-content-between">
        <button type="submit" name="submit" class="btn btn-primary">💾 Simpan</button>
        <a href="buku.php" class="btn btn-secondary">↩️ Batal</a>
      </div>
    </form>
  </div>

  <script>
    $(document).ready(function () {
      $("#ubahBukuForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          url: "",
          type: "POST",
          data: formData + "&submit=true",
          success: function (response) {
            if (response.trim() === "success") {
              alert("✅ Data buku berhasil diubah!");
              window.location.href = "buku.php"
            } else {
              alert("❌ Gagal mengubah data buku.");
            }
          },
          error: function () {
            alert("⚠️ Terjadi kesalahan AJAX!");
          }
        });
      });
    });
  </script>

</body>
</html>
