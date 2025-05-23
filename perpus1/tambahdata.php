<?php
include "config/controller.php";

if (isset($_POST['tambah'])) {
    if (create_login($_POST) < 0) {
        echo "<script>
            alert(' ❌ Data gagal ditambahkan! ');
            document.location.href='register.php';
        </script>";
    } else {
        echo "<script>
            alert(' ✅ Data berhasil ditambahkan! ');
            document.location.href='register.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #ede7f6, #e3f2fd);
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">👤 Tambah Data</h2>

        <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="ID" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <input type="text" class="form-control" id="level" name="level" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="tambah" class="btn btn-primary">💾 Simpan</button>
                <a href="admin.php" class="btn btn-secondary">↩️ Kembali</a>
            </div>
        </form>
    </div>

</body>
</html>
