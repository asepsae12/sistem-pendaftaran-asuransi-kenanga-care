<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Login - PSB Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --admin-color: #e74a3b;
            --peserta-color: #1cc88a;
            --text-color: #5a5c69;
            --light-bg: #f8f9fc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-color);
        }
        
        .login-choice-container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2a3e9d 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .brand-logo {
            font-size: 2.5rem;
            margin-right: 15px;
        }
        
        .brand-text h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }
        
        .brand-text p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 1rem;
        }
        
        .options-container {
            display: flex;
            flex-wrap: wrap;
            padding: 30px;
        }
        
        .option-card {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            margin: 15px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid transparent;
        }
        
        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .option-card.admin {
            background: linear-gradient(135deg, #fff 0%, #fdf2f2 100%);
            border-color: var(--admin-color);
        }
        
        .option-card.peserta {
            background: linear-gradient(135deg, #fff 0%, #f2fdf9 100%);
            border-color: var(--peserta-color);
        }
        
        .option-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }
        
        .admin .option-icon {
            background-color: var(--admin-color);
            color: white;
        }
        
        .peserta .option-icon {
            background-color: var(--peserta-color);
            color: white;
        }
        
        .option-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-color);
        }
        
        .option-description {
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .btn-login {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        
        .admin .btn-login {
            background-color: var(--admin-color);
            color: white;
        }
        
        .admin .btn-login:hover {
            background-color: transparent;
            border-color: var(--admin-color);
            color: var(--admin-color);
        }
        
        .peserta .btn-login {
            background-color: var(--peserta-color);
            color: white;
        }
        
        .peserta .btn-login:hover {
            background-color: transparent;
            border-color: var(--peserta-color);
            color: var(--peserta-color);
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background-color: var(--light-bg);
            font-size: 0.9rem;
        }
        
        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .option-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .option-card.admin {
            animation-delay: 0.2s;
        }
        
        .option-card.peserta {
            animation-delay: 0.4s;
        }
        
        /* Responsivitas */
        @media (max-width: 768px) {
            .options-container {
                flex-direction: column;
                padding: 20px;
            }
            
            .option-card {
                min-width: 100%;
                margin: 10px 0;
            }
            
            .header {
                padding: 20px;
            }
            
            .brand {
                flex-direction: column;
            }
            
            .brand-logo {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-choice-container">
        <div class="header">
            <div class="brand">
                <div class="brand-text">
                    <h1>PT. Kenanga Care</h1>
                    <p>Sistem Pendaftaran Asuransi Online</p>
                </div>
            </div>
        </div>
        
        <div class="options-container">
            <div class="option-card admin">
                <div class="option-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2 class="option-title">Login sebagai Admin</h2>
                <p class="option-description">
                    Akses panel administrasi untuk mengelola data pendaftaran, 
                    verifikasi berkas.
                </p>
                <a href="login.php" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login Admin
                </a>
            </div>
            
            <div class="option-card peserta">
                <div class="option-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h2 class="option-title">Login sebagai Peserta</h2>
                <p class="option-description">
                    Masuk ke akun peserta untuk melengkapi formulir pendaftaran

                </p>
                <a href="user-login.php" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login Peserta
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Sistem Pendaftaran Peserta Asuransi. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Menambahkan efek interaktif pada kartu
        document.querySelectorAll('.option-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
            
            // Klik pada kartu juga akan mengarahkan ke halaman login
            card.addEventListener('click', (e) => {
                if (e.target.tagName !== 'A') {
                    const link = card.querySelector('a');
                    if (link) {
                        window.location.href = link.href;
                    }
                }
            });
        });
    </script>
</body>
</html>