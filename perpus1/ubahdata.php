<?php
include 'config/controller.php';

// Cek apakah ID tersedia dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil data login berdasarkan ID
    $login = select("SELECT * FROM login WHERE id = ?", [$id]);

    if ($login) {
        $login = $login[0];

        // Jika form disubmit
        if (isset($_POST['ubah'])) {
            if (update_login($_POST) > 0) {
                echo "<script>
                    alert('✅ Data berhasil diubah!');
                    document.location.href='register.php';
                </script>";
            } else {
                echo "<script>
                    alert('❌ Data gagal diubah!');
                    document.location.href='register.php';
                </script>";
            }
        }
    } else {
        echo "<script>
            alert('Data tidak ditemukan!');
            document.location.href='register.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak valid!');
        document.location.href='register.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">✏️ Ubah Data Login</h2>

        <form action="" method="POST" class="bg-light p-4 rounded shadow-sm">
            <input type="hidden" name="id" value="<?= $login['id']; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($login['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($login['username']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?= htmlspecialchars($login['password']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <input type="text" class="form-control" id="level" name="level" value="<?= htmlspecialchars($login['level']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($login['status']); ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="ubah" class="btn btn-primary">💾 Simpan Perubahan</button>
                <a href="register.php" class="btn btn-secondary">↩️ Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
