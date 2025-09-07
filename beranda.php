<?php 
session_start();
include 'koneksi.php';
if($_SESSION['stat_login'] != true){
    echo '<script>window.location="beranda.php"</script>';
}

// Query untuk statistik
$total_peserta = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_pendaftaran");
$total_data = mysqli_fetch_assoc($total_peserta);

$perusahaan = mysqli_query($conn, "SELECT COUNT(DISTINCT nm_perusahaan) as perusahaan FROM tb_pendaftaran");
$jml_perusahaan = mysqli_fetch_assoc($perusahaan);

$peserta_baru = mysqli_query($conn, "SELECT COUNT(*) as baru FROM tb_pendaftaran WHERE tgl_daftar >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$peserta_baru_data = mysqli_fetch_assoc($peserta_baru);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        body {
            background-color: #f5f7fb;
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }
        
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 600;
        }
        
        .nav-link {
            padding: 0.5rem 1rem !important;
            border-radius: 4px;
            margin: 0 2px;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .content h2 {
            color: var(--dark);
            margin-bottom: 1.5rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .content h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        .welcome-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.2);
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-box h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }
        
        .welcome-box p {
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
        }
        
        .welcome-box::after {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .welcome-box::before {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }
        
        .icon-primary {
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }
        
        .icon-success {
            background: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }
        
        .icon-warning {
            background: rgba(247, 37, 133, 0.1);
            color: var(--warning);
        }
        
        .icon-info {
            background: rgba(72, 149, 239, 0.1);
            color: var(--info);
        }
        
        .stat-content h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }
        
        .stat-content p {
            margin: 5px 0 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .action-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.2rem;
            background: var(--primary);
            color: white;
        }
        
        .action-card h4 {
            margin: 0 0 0.5rem;
            color: var(--dark);
            font-weight: 600;
        }
        
        .action-card p {
            margin: 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .recent-activities {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .recent-activities h3 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: var(--dark);
            font-weight: 600;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1rem;
            background: var(--light-gray);
            color: var(--gray);
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-content h5 {
            margin: 0 0 0.25rem;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .activity-content p {
            margin: 0;
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        .activity-time {
            color: var(--gray);
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }
            
            .welcome-box {
                padding: 1.5rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
        
        .footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="beranda.php">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="beranda.php">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data-peserta.php">
                        <i class="fas fa-users me-1"></i> Data Peserta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulir.php">
                        <i class="fas fa-edit me-1"></i> Formulir Peserta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="keluar.php">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="content">
    <div class="welcome-box">
        <h3>Halo, <?php echo $_SESSION['nama']; ?>!</h3>
        <p>Selamat datang di Dashboard Admin Sistem Pendaftaran Peserta</p>
    </div>
    
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon icon-primary">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo $total_data['total']; ?></h3>
                <p>Total Peserta</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-info">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo $jml_perusahaan['perusahaan']; ?></h3>
                <p>Jumlah Perusahaan</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-success">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo $peserta_baru_data['baru']; ?></h3>
                <p>Peserta Baru (7 hari)</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-warning">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <h3>100%</h3>
                <p>Sistem Aktif</p>
            </div>
        </div>
    </div>
    
    <div class="quick-actions">
        <div class="action-card" onclick="window.location.href='data-peserta.php'">
            <div class="action-icon">
                <i class="fas fa-users"></i>
            </div>
            <h4>Data Peserta</h4>
            <p>Kelola data peserta yang terdaftar</p>
        </div>
        
        <div class="action-card" onclick="window.location.href='formulir.php'">
            <div class="action-icon">
                <i class="fas fa-edit"></i>
            </div>
            <h4>Tambah Peserta</h4>
            <p>Input data peserta baru</p>
        </div>
        
        <div class="action-card" onclick="window.location.href='cetak-peserta.php'">
            <div class="action-icon">
                <i class="fas fa-print"></i>
            </div>
            <h4>Cetak Data</h4>
            <p>Cetak laporan data peserta</p>
        </div>
        
        <div class="action-card" onclick="window.location.href='keluar.php'">
            <div class="action-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h4>Logout</h4>
            <p>Keluar dari sistem</p>
        </div>
    </div>
    
    <div class="recent-activities">
        <h3><i class="fas fa-history me-2"></i>Aktivitas Terbaru</h3>
        
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-content">
                <h5>Login Berhasil</h5>
                <p>Anda telah berhasil login ke sistem</p>
                <div class="activity-time"><?php echo date('d M Y, H:i'); ?></div>
            </div>
        </div>
        
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="activity-content">
                <h5>Statistik Diperbarui</h5>
                <p>Data statistik telah diperbarui</p>
                <div class="activity-time">Hari ini</div>
            </div>
        </div>
        
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-database"></i>
            </div>
            <div class="activity-content">
                <h5>Sistem Stabil</h5>
                <p>Semua sistem berjalan dengan baik</p>
                <div class="activity-time">Terakhir diperiksa: hari ini</div>
            </div>
        </div>
    </div>
</section>

<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Sistem Pendaftaran Peserta Asuransi. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Animasi untuk elemen stat card saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>

</body>
</html>