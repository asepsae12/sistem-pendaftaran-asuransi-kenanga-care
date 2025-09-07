<?php 
$koneksi = new mysqli("localhost:3307", "root", "", "db_psb");

// Proses pendaftaran
if (isset($_POST["daftar"])) {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    $ambil = $koneksi->query("SELECT * FROM peserta WHERE email_peserta='$email'");
    $yangcocok = $ambil->num_rows;
    
    if ($yangcocok == 1) {
        $error = "Pendaftaran gagal, email sudah digunakan";
    } else {
        $koneksi->query("INSERT INTO peserta(email_peserta,password_peserta,nama_peserta,telepon_peserta,alamat_peserta) VALUES ('$email','$password','$nama','$telepon','$alamat') ");
        $success = "Pendaftaran sukses, silahkan login";
        // Redirect setelah 3 detik
        header("refresh:3;url=user-login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - PSB Online</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #36b9cc;
            --success-color: #1cc88a;
            --error-color: #e74a3b;
            --text-color: #5a5c69;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        
        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            margin: 20px;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2a3e9d 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .register-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .register-header p {
            margin: 5px 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .register-body {
            padding: 30px;
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
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2a3e9d 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .alert-message {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid var(--success-color);
        }
        
        .register-footer {
            text-align: center;
            margin-top: 25px;
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        .brand-logo {
            font-size: 2rem;
            margin-bottom: 10px;
            color: white;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .form-col {
            flex: 1;
            padding: 0 10px;
            min-width: 250px;
        }
        
        .password-strength {
            height: 5px;
            background: #eee;
            border-radius: 3px;
            margin-top: 5px;
            position: relative;
            overflow: hidden;
        }
        
        .password-strength::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            border-radius: 3px;
            transition: width 0.3s, background 0.3s;
        }
        
        .password-strength.weak::before {
            width: 33%;
            background: var(--error-color);
        }
        
        .password-strength.medium::before {
            width: 66%;
            background: #f39c12;
        }
        
        .password-strength.strong::before {
            width: 100%;
            background: var(--success-color);
        }
        
        @media (max-width: 768px) {
            .register-container {
                margin: 15px;
            }
            
            .register-header, .register-body {
                padding: 20px;
            }
            
            .form-col {
                flex: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="brand-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h3>Daftar Pelanggan Baru</h3>
            <p>Pendaftaran Online - Buat akun untuk mengakses layanan kami</p>
        </div>
        
        <div class="register-body">
            <?php if (isset($error)): ?>
                <div class="alert-message alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span style="margin-left: 10px;"><?php echo $error; ?></span>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert-message alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span style="margin-left: 10px;"><?php echo $success; ?> Anda akan diarahkan ke halaman login...</span>
                </div>
            <?php endif; ?>
            
            <form method="post" class="form-horizontal">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <i class="fas fa-user input-icon mt-3"></i>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Buat password yang kuat" required>
                            <div class="password-strength" id="passwordStrength"></div>
                            <small class="text-muted">Gunakan kombinasi huruf, angka, dan simbol</small>
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="telepon">Nomor Telepon/HP</label>
                            <i class="fas fa-phone input-icon"></i>
                            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                </div>
                
                <div class="form-group" style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="btn-register" name="daftar">
                        <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Daftar Sekarang
                    </button>
                </div>
            </form>
            
            <div class="register-footer">
                <p>Sudah punya akun? <a href="user-login.php">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        // Validasi kekuatan password
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            
            // Reset class
            strengthBar.classList.remove('weak', 'medium', 'strong');
            
            if (password.length === 0) {
                return;
            }
            
            // Hitung kekuatan password
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Tampilkan indikator kekuatan
            if (strength <= 2) {
                strengthBar.classList.add('weak');
            } else if (strength === 3) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        });
        
        // Validasi nomor telepon
        document.getElementById('telepon').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>