<?php
include 'config/controller.php';

if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID siswa tidak ditemukan!');
        document.location.href = 'datasiswa.php';
    </script>";
    exit;
}

$id = intval($_GET['id']); // Hindari SQL Injection
$siswa = select("SELECT * FROM siswa WHERE id = ?", [$id])[0];

if (isset($_POST['ubah'])) {
    if (update_siswa($_POST) > 0) {
        echo "<script>
            alert('✅ Data siswa berhasil diubah!');
            document.location.href = 'datasiswa.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Data siswa gagal diubah!');
        </script>";
        
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ubah Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
    <h2 class="text-center fw-bold mb-4">✏️ Ubah Data Siswa</h2>

    <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= $siswa['id']; ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= htmlspecialchars($siswa['alamat']); ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" name="ubah" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="datasiswa.php" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
