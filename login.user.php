<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password'])); // gunakan md5 sesuai database

    $cek = $koneksi->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    if ($cek && $cek->num_rows > 0) {
        $row = $cek->fetch_assoc();
        $_SESSION['user'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient( to bottom right, rgba(0,0,0,0.35), rgba(0,0,0,0.55) ), url('user.login.png') no-repeat center center fixed;
            background-size: cover;
        }
        .login-box {
            width: 360px;
            background: rgba(255,255,255,0.18);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            padding: 32px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.35);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 18px;
            color:rgb(64, 153, 201);
            letter-spacing: 0.3px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            margin: 10px 0 14px;
            border: 1px solid rgba(255,255,255,0.35);
            background: rgba(255,255,255,0.25);
            color: #fff;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }
        .login-box input::placeholder {
            color: rgba(255,255,255,0.9);
        }
        .login-box button {
            width: 100%;
            padding: 12px 14px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s ease, filter 0.2s ease;
        }
        .login-box button:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }
        .error {
            color: #ffdddd;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form class="login-box" method="POST" action="">
        <h2>Login User</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <?php if (!empty($error)) { echo "<div class='error'>$error</div>"; } ?>
    </form>
</body>
</html>
