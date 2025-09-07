<?php 
include 'koneksi.php';

$peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '".$_GET['id']."'");
$p = mysqli_fetch_object($peserta);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukti Pendaftaran - Kenanga Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #343a40;
            background-color: #fff;
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            
            .no-print {
                display: none !important;
            }
            
            .container {
                width: 100%;
                max-width: 100%;
            }
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary);
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 30px;
        }
        
        .header h1 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .header p {
            color: var(--gray);
            margin-bottom: 0;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .info-label {
            flex: 0 0 200px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .info-separator {
            flex: 0 0 10px;
            text-align: center;
            color: var(--gray);
        }
        
        .info-value {
            flex: 1;
            color: var(--gray);
        }
        
        .badge-id {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--light-gray);
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }
        
        @media (max-width: 768px) {
            .info-row {
                flex-direction: column;
            }
            
            .info-label {
                flex: 0 0 100%;
                margin-bottom: 5px;
            }
            
            .info-separator {
                display: none;
            }
            
            .info-value {
                flex: 0 0 100%;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
        
        .empty-value {
            color: #adb5bd;
            font-style: italic;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-hospital-user"></i>
            </div>
            <h1>Bukti Pendaftaran</h1>
            <p>Kenanga Care - Sistem Pendaftaran Peserta Asuransi</p>
        </div>
        
        <div class="badge-id">
            <i class="fas fa-id-card me-1"></i> ID: <?php echo $p->id_pendaftaran; ?>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Keterangan Peserta Asuransi
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-label">History Card</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->history_card; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Nama Perusahaan</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->nm_perusahaan; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">No. Kartu KC</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->no_kartu; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Nama Peserta</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->nama_peserta; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Tempat, Tanggal Lahir</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->tmp_lahir . ', ' . date('d/m/Y', strtotime($p->tgl_lahir)); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Jabatan</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->jabatan; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->jk; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Status</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->status; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->telepon; ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-separator">:</div>
                    <div class="info-value"><?php echo $p->almt_peserta; ?></div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users"></i> Keluarga Peserta
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-label">Nama Suami/Istri</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->suami_istri) ? $p->suami_istri : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin Suami/Istri</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->jk_si) ? $p->jk_si : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Tanggal Lahir Suami/Istri</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->lahir_si) ? date('d/m/Y', strtotime($p->lahir_si)) : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Nama Anak Pertama</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->anak_satu) ? $p->anak_satu : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin Anak Pertama</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->jk_as) ? $p->jk_as : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Tanggal Lahir Anak Pertama</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->lahir_as) ? date('d/m/Y', strtotime($p->lahir_as)) : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Nama Anak Kedua</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->anak_dua) ? $p->anak_dua : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin Anak Kedua</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->jk_ad) ? $p->jk_ad : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Tanggal Lahir Anak Kedua</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->lahir_ad) ? date('d/m/Y', strtotime($p->lahir_ad)) : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-hospital"></i> Klinik/Provider
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-label">Nama Klinik</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->nm_klinik) ? $p->nm_klinik : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Alamat Klinik</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">
                        <?php echo !empty($p->almt_klinik) ? $p->almt_klinik : '<span class="empty-value">Tidak diisi</span>'; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer no-print">
            <p>Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?></p>
            <p>&copy; <?php echo date('Y'); ?> Kenanga Care - Sistem Pendaftaran Peserta Asuransi</p>
        </div>
        
        <div class="action-buttons no-print">
            <a href="javascript:window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Ulang
            </a>
            <a href="data-peserta.php" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Data Peserta
            </a>
        </div>
    </div>
</body>
</html>