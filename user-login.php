<?php
session_start();
$koneksi = new mysqli("localhost:3307", "root", "", "db_psb");


// Proses login
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $ambil = $koneksi->query("SELECT * FROM peserta WHERE email_peserta='$email' AND password_peserta='$password'");
    $akunyangcocok = $ambil->num_rows;

    if ($akunyangcocok == 1) {
        $akun = $ambil->fetch_assoc();
        $_SESSION["peserta"] = $akun;
        echo "<script>alert('Anda sukses login');</script>";
        echo "<script>location = 'formulir.php';</script>";
    } else {
        $error = "Email atau password salah!";
    }
}
?>
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan - PSB Online</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #36b9cc;
            --text-color: #5a5c69;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2a3e9d 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .login-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .login-header p {
            margin: 5px 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
        }
        
        .input-icon {
            position: absolute;
            left: 12px;
            top: 42px;
            color: #ccc;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2a3e9d 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert-error.show {
            display: block;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .brand-logo {
            font-size: 2rem;
            margin-bottom: 10px;
            color: white;
        }
        
        @media (max-width: 576px) {
            .login-container {
                margin: 15px;
            }
            
            .login-header, .login-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        <div class="login-header">
            <div class="brand-logo">
                <i class="fa-solid fa-user"></i>
            </div>
            <h3>Login Peserta</h3>
            <p>Pendaftaran Online - Masuk ke akun Anda</p>
        </div>
        
        <div class="login-body">
            <div class="alert-error" id="errorMessage">
                <?php if (isset($error)) echo $error; ?>
            </div>
            
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login" name="login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="login-footer">
                <p>Belum punya akun? <a href="daftar.php">Daftar di sini</a></p>
                <p><a href="#">Lupa password?</a></p>
            </div>
        </div>
    </div>

    <script>
        // Tampilkan pesan error jika ada
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage.textContent.trim() !== '') {
                errorMessage.classList.add('show');
                
                // Sembunyikan pesan error setelah 5 detik
                setTimeout(function() {
                    errorMessage.classList.remove('show');
                }, 5000);
            }
        });
    </script>
</body>
</html>