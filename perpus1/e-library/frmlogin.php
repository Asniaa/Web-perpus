<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data login 
    $users = [
        "admin" => ["password" => "admin123", "role" => "admin"],
        "siswa" => ["password" => "siswa123", "role" => "siswa"],
        "petugas" => ["password" => "petugas123", "role" => "petugas"]
    ];

    // Ambil input dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada di daftar users
    if (isset($users[$username])) {
        if ($users[$username]['password'] === $password) {
            $_SESSION['role'] = $users[$username]['role'];
            $_SESSION['username'] = $username;

            // Redirect sesuai role
            if ($users[$username]['role'] === "admin") {
                header("Location: admin.php");
            } elseif ($users[$username]['role'] === "siswa") {
                header("Location: siswa.php");
            } elseif ($users[$username]['role'] === "petugas") {
                header("Location: petugas.php");
            }
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.href='frmlogin.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='frmlogin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sky Theme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://i.pinimg.com/736x/24/3c/c0/243cc00934264cc161d11de82472e70a.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: rgba(22, 21, 21, 0.7);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 450px;
        }
        .login-container h4 {
            color: #87CEEB;
            font-weight: bold;
            font-size: 24px;
        }
        .btn-sky {
            background-color: #87CEEB;
            border: none;
            border-radius: 30px;
            padding: 14px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 5px 12px rgba(135, 206, 235, 0.6);
        }
        .btn-sky:hover {
            background-color: #4682B4;
            transform: scale(1.15);
            box-shadow: 0px 7px 18px rgba(70, 130, 180, 0.7);
        }
        .input-field {
            border-radius: 25px;
            border: 1px solid #87CEEB;
            padding: 12px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="User Icon" class="mb-3" width="90">
        <h4 class="mb-4">Silahkan Login! 📚</h4>
        <form method="POST">
            <div class="mb-4">
                <input type="text" class="form-control input-field" name="username" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control input-field" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-sky w-100">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
