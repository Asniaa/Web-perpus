<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_perpus1";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// log activities
function log_activity($user_id, $activity) {
    global $conn;
    $query = "INSERT INTO aktivitas_log (user_id, aktivitas) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $activity);
    $stmt->execute();
    $stmt->close();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['status'];
        
        log_activity($user['id'], "Login ke sistem");

        switch ($user['status']) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'petugas':
                header("Location: petugas.php");
                break;
            case 'siswa':
                header("Location: siswa.php");
                break;
            default:
                $error = "Role tidak dikenali.";
        }
        exit();
    } else {
        $error = "Username atau password salah.";
        
        if (!empty($username)) {
            $sql = "SELECT id FROM login WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if ($user) {
                log_activity($user['id'], "Percobaan login gagal (password salah)");
            } else {
                
                $query = "INSERT INTO aktivitas_log (user_id, aktivitas) VALUES (0, ?)";
                $stmt = $conn->prepare($query);
                $activity = "Percobaan login dengan username tidak dikenal: $username";
                $stmt->bind_param("s", $activity);
                $stmt->execute();
            }
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f0f4f8;
      background-image: url('https://i.pinimg.com/736x/7a/11/34/7a11345392fc0525099fd9c7ba64e2fd.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-box h2 {
      font-weight: 600;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 20px;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .password-field {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: #555;
    }

    .btn-login {
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .logo {
      width: 80px;
      margin-bottom: 10px;
      transition: transform 0.3s;
    }

    .logo:hover {
      transform: rotate(10deg);
    }

    .footer-text {
      font-size: 13px;
      color: #888;
      margin-top: 20px;
    }

    .error-text {
      color: #e74c3c;
      font-size: 14px;
      margin-bottom: 15px;
      animation: shake 0.5s;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
  </style>
</head>
<body>
  <div class="login-box text-center">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3mvzZWQlCdZ3E_D7Px1LGxNYUiByDaSbrTQ&s" class="logo" alt="Logo Perpus">
    <h2>Login Perpustakaan Seven</h2>

    <?php if ($error): ?>
      <div class="error-text"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
      </div>
      <div class="mb-4 password-field">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
      </div>
      <button type="submit" class="btn btn-login w-100 mb-3">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </button>
    </form>

    <div class="footer-text">&copy; <?= date('Y') ?> Perpustakaan Digital. All rights reserved.</div>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
    });

    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.02)';
      });
      input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
      });
    });
  </script>
</body>
</html>