<?php
include 'config.php';

// Jika user sudah login, arahkan langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Logika Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password (menggunakan teks biasa sesuai data contoh sebelumnya)
        // Catatan: Di produksi, gunakan password_verify($password, $row['password'])
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['full_name'] = $row['full_name'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MANDALA Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-mandala { background-color: #2c3e50; color: white; }
        .btn-mandala:hover { background-color: #1a252f; color: white; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container w-100">
        <div class="card p-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-uppercase">Mandala</h2>
                <p class="text-muted">Silakan login untuk mulai belanja</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2 text-center" style="font-size: 14px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn btn-mandala w-100 py-2">Login Sekarang</button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">Belum punya akun? Hubungi Admin.</small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>