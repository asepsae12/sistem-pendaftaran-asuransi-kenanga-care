<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil - PSB Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #28a745;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .success-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
            animation: scaleUp 0.5s ease-out;
        }
        
        @keyframes scaleUp {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }
        
        h2 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
        }
        
        h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--success);
            border-radius: 2px;
        }
        
        .code-container {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .code-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        
        .code-value {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: 'Courier New', monospace;
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
            color: white;
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .info-text {
            color: var(--gray);
            margin-top: 20px;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        @media (max-width: 576px) {
            .success-container {
                padding: 30px 20px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .code-value {
                font-size: 1.5rem;
            }
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--primary);
            opacity: 0;
            animation: confetti 5s ease-in-out infinite;
        }
        
        @keyframes confetti {
            0% {
                opacity: 1;
                transform: translateY(0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(100vh) rotate(720deg);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <!-- Confetti elements -->
    <div class="confetti" style="left: 10%; animation-delay: 0s; background: #4361ee;"></div>
    <div class="confetti" style="left: 20%; animation-delay: 1s; background: #4cc9f0;"></div>
    <div class="confetti" style="left: 30%; animation-delay: 0.5s; background: #28a745;"></div>
    <div class="confetti" style="left: 40%; animation-delay: 2s; background: #ffc107;"></div>
    <div class="confetti" style="left: 50%; animation-delay: 1.5s; background: #dc3545;"></div>
    <div class="confetti" style="left: 60%; animation-delay: 0.8s; background: #6f42c1;"></div>
    <div class="confetti" style="left: 70%; animation-delay: 2.5s; background: #fd7e14;"></div>
    <div class="confetti" style="left: 80%; animation-delay: 1.2s; background: #20c997;"></div>
    <div class="confetti" style="left: 90%; animation-delay: 3s; background: #6610f2;"></div>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h2>Pendaftaran Berhasil!</h2>
        
        <p>Selamat! Pendaftaran Anda telah berhasil diproses. Simpan kode pendaftaran berikut untuk keperluan selanjutnya.</p>
        
        <div class="code-container pulse">
            <div class="code-label">Kode Pendaftaran Anda</div>
            <div class="code-value"><?php echo $_GET['id'] ?></div>
        </div>
        
        <div class="button-group">
            <a class="btn btn-primary" href="user-keluar.php">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
             </a>
        </div>
        
        <div class="info-text">
            <i class="fas fa-info-circle"></i> Harap simpan kode pendaftaran Anda dengan aman. 
            Kode ini akan diperlukan untuk melihat status pendaftaran dan proses selanjutnya.
        </div>
    </div>

    <script>
        // Tambahkan efek konfeti tambahan
        document.addEventListener('DOMContentLoaded', function() {
            function createConfetti() {
                for (let i = 0; i < 15; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.animationDelay = Math.random() * 5 + 's';
                    confetti.style.background = `hsl(${Math.random() * 360}, 70%, 60%)`;
                    document.body.appendChild(confetti);
                }
            }
            
            createConfetti();
            
            // Pulsasi berulang untuk container kode
            setInterval(() => {
                document.querySelector('.code-container').classList.add('pulse');
                setTimeout(() => {
                    document.querySelector('.code-container').classList.remove('pulse');
                }, 2000);
            }, 4000);
        });
    </script>
</body>
</html>