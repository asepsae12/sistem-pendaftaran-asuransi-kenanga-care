<?php 
session_start();
include 'koneksi.php';
if($_SESSION['stat_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '".$_GET['id']."' ");
$p = mysqli_fetch_object($peserta);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Peserta | Admin Page</title>
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
        
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .btn-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .detail-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
        }
        
        .detail-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .detail-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
        }
        
        .detail-body {
            padding: 1.5rem;
        }
        
        .info-group {
            margin-bottom: 1.5rem;
        }
        
        .info-group:last-child {
            margin-bottom: 0;
        }
        
        .info-group h4 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }
        
        .info-value {
            font-weight: 500;
            color: var(--dark);
            padding: 0.5rem 0;
        }
        
        .empty-value {
            color: var(--gray) !important;
            font-style: italic;
        }
        
        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .info-row {
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
        
        .badge-id {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-left: 1rem;
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
                    <a class="nav-link" href="beranda.php">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="data-peserta.php">
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
    <h2>Detail Peserta</h2>
    
    <div class="action-buttons">
        <a href="cetak.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary btn-action">
            <i class="fas fa-print"></i> Cetak Bukti Pendaftaran
        </a>
        <a href="cetak-kartu.php?id=<?php echo $_GET['id'] ?>" class="btn btn-info btn-action">
            <i class="fas fa-id-card"></i> Cetak Kartu
        </a>
        <a href="data-peserta.php" class="btn btn-secondary btn-action">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Peserta
        </a>
    </div>
    
    <div class="detail-card">
        <div class="detail-header">
            <h3>Informasi Peserta <span class="badge-id">ID: <?php echo $p->id_pendaftaran ?></span></h3>
            <p>Data lengkap peserta program</p>
        </div>
        
        <div class="detail-body">
            <div class="info-group">
                <h4>Data Pribadi</h4>
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Nama Perusahaan</span>
                        <span class="info-value"><?php echo !empty($p->nm_perusahaan) ? $p->nm_perusahaan : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nama Peserta</span>
                        <span class="info-value"><?php echo $p->nama_peserta ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value"><?php echo $p->jk ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tempat, Tanggal Lahir</span>
                        <span class="info-value"><?php echo $p->tmp_lahir ?>, <?php echo $p->tgl_lahir ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Jabatan</span>
                        <span class="info-value"><?php echo !empty($p->jabatan) ? $p->jabatan : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value"><?php echo $p->status ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">No. Telepon</span>
                        <span class="info-value"><?php echo !empty($p->telepon) ? $p->telepon : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Alamat</span>
                        <span class="info-value"><?php echo !empty($p->almt_peserta) ? $p->almt_peserta : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">History Card</span>
                        <span class="info-value"><?php echo !empty($p->history_card) ? $p->history_card : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">No. Kartu KC</span>
                        <span class="info-value"><?php echo !empty($p->no_kartu) ? $p->no_kartu : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
            </div>
            
            <div class="info-group">
                <h4>Data Keluarga</h4>
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Nama Suami/Istri</span>
                        <span class="info-value"><?php echo !empty($p->suami_istri) ? $p->suami_istri : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value"><?php echo !empty($p->jk_si) ? $p->jk_si : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value"><?php echo !empty($p->lahir_si) ? $p->lahir_si : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Anak Pertama</span>
                        <span class="info-value"><?php echo !empty($p->anak_satu) ? $p->anak_satu : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value"><?php echo !empty($p->jk_as) ? $p->jk_as : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value"><?php echo !empty($p->lahir_as) ? $p->lahir_as : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Anak Kedua</span>
                        <span class="info-value"><?php echo !empty($p->anak_dua) ? $p->anak_dua : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value"><?php echo !empty($p->jk_ad) ? $p->jk_ad : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value"><?php echo !empty($p->lahir_ad) ? $p->lahir_ad : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
            </div>
            
            <div class="info-group">
                <h4>Data Klinik Provider</h4>
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Nama Klinik</span>
                        <span class="info-value"><?php echo !empty($p->nm_klinik) ? $p->nm_klinik : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Alamat Klinik</span>
                        <span class="info-value"><?php echo !empty($p->almt_klinik) ? $p->almt_klinik : '<span class="empty-value">Tidak diisi</span>' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Sistem Pendaftaran Peserta. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>