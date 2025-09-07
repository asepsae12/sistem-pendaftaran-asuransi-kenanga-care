<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pendaftaran Peserta - Kenanga Care</title>
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
                padding: 0;
            }
            
            .report-header {
                padding: 15px 0 !important;
            }
            
            .table-responsive {
                overflow: visible !important;
            }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #343a40;
            background-color: #fff;
            padding: 20px;
            line-height: 1.4;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .report-header {
            text-align: center;
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 3px solid var(--primary);
        }
        
        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
        }
        
        .report-header h1 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.8rem;
        }
        
        .report-header p {
            color: var(--gray);
            margin-bottom: 0;
        }
        
        .report-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background-color: var(--light);
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .section-title {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 12px 15px;
            border-radius: 6px;
            margin: 30px 0 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
        }
        
        .table-container {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            font-size: 0.85rem;
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 12px 8px;
            border: none;
            text-align: left;
            position: sticky;
            top: 0;
            vertical-align: middle;
        }
        
        .table tbody td {
            padding: 10px 8px;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            color: white;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--light-gray);
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .empty-data {
            text-align: center;
            padding: 30px;
            color: var(--gray);
            font-style: italic;
        }
        
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .badge-secondary {
            background-color: var(--gray);
            color: white;
        }
        
        @media (max-width: 992px) {
            .table {
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 8px 6px;
            }
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            
            .report-meta {
                flex-direction: column;
                gap: 10px;
            }
        }
        
        .column-highlight {
            background-color: rgba(67, 97, 238, 0.1) !important;
            font-weight: 600;
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
        <div class="report-header">
            <div class="logo">
                <i class="fas fa-hospital-user"></i>
            </div>
            <h1>Laporan Data Pendaftaran</h1>
            <p>Kenanga Care - Sistem Pendaftaran Peserta Asuransi</p>
        </div>
        
        <div class="report-meta">
            <div>
                <strong>Tanggal Dicetak:</strong> <?php echo date('d/m/Y H:i:s'); ?>
            </div>
            <div>
                <strong>Jumlah Peserta:</strong> 
                <?php 
                $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_pendaftaran");
                $total = mysqli_fetch_assoc($count);
                echo $total['total']; 
                ?>
            </div>
        </div>
        
        <div class="section-title">
            <i class="fas fa-user-circle"></i> Data Utama Peserta
        </div>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pendaftaran</th>
                            <th>Keterangan</th>
                            <th>Perusahaan</th>
                            <th>No. Kartu</th>
                            <th>Nama Peserta</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jabatan</th>
                            <th>JK</th>
                            <th>Status</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $list_peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran");
                        if(mysqli_num_rows($list_peserta) > 0) {
                            while($row = mysqli_fetch_array($list_peserta)) { 
                        ?>
                        <tr>
                            <td class="column-highlight"><?php echo $no++ ?></td>
                            <td><strong><?php echo $row['id_pendaftaran'] ?></strong></td>
                            <td><?php echo $row['history_card'] ?></td>
                            <td><?php echo $row['nm_perusahaan'] ?></td>
                            <td><?php echo $row['no_kartu'] ?></td>
                            <td><strong><?php echo $row['nama_peserta'] ?></strong></td>
                            <td><?php echo $row['tmp_lahir'] ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['tgl_lahir'])) ?></td>
                            <td><?php echo $row['jabatan'] ?></td>
                            <td>
                                <span class="badge <?php echo $row['jk'] == 'Laki-Laki' ? 'badge-primary' : 'badge-secondary'; ?>">
                                    <?php echo $row['jk'] == 'Laki-Laki' ? 'L' : 'P'; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-secondary">
                                    <?php echo $row['status'] ?>
                                </span>
                            </td>
                            <td><?php echo $row['telepon'] ?></td>
                            <td><?php echo strlen($row['almt_peserta']) > 20 ? substr($row['almt_peserta'], 0, 20) . '...' : $row['almt_peserta']; ?></td>
                        </tr>
                        <?php 
                            }
                        } else { 
                        ?>
                        <tr>
                            <td colspan="13" class="empty-data">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                Tidak ada data peserta
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="section-title">
            <i class="fas fa-users"></i> Data Keluarga Peserta
        </div>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Pendaftaran</th>
                            <th>Suami/Istri</th>
                            <th>JK</th>
                            <th>Tgl Lahir</th>
                            <th>Anak 1</th>
                            <th>JK</th>
                            <th>Tgl Lahir</th>
                            <th>Anak 2</th>
                            <th>JK</th>
                            <th>Tgl Lahir</th>
                            <th>Klinik</th>
                            <th>Alamat Klinik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $list_peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran");
                        if(mysqli_num_rows($list_peserta) > 0) {
                            while($row = mysqli_fetch_array($list_peserta)) { 
                        ?>
                        <tr>
                            <td class="column-highlight"><?php echo $no++ ?></td>
                            <td><strong><?php echo $row['id_pendaftaran'] ?></strong></td>
                            <td><?php echo !empty($row['suami_istri']) ? $row['suami_istri'] : '<span class="text-muted">-</span>'; ?></td>
                            <td>
                                <?php if(!empty($row['jk_si'])): ?>
                                <span class="badge <?php echo $row['jk_si'] == 'Laki-Laki' ? 'badge-primary' : 'badge-secondary'; ?>">
                                    <?php echo $row['jk_si'] == 'Laki-Laki' ? 'L' : 'P'; ?>
                                </span>
                                <?php else: ?>
                                <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo !empty($row['lahir_si']) ? date('d/m/Y', strtotime($row['lahir_si'])) : '<span class="text-muted">-</span>'; ?></td>
                            <td><?php echo !empty($row['anak_satu']) ? $row['anak_satu'] : '<span class="text-muted">-</span>'; ?></td>
                            <td>
                                <?php if(!empty($row['jk_as'])): ?>
                                <span class="badge <?php echo $row['jk_as'] == 'Laki-Laki' ? 'badge-primary' : 'badge-secondary'; ?>">
                                    <?php echo $row['jk_as'] == 'Laki-Laki' ? 'L' : 'P'; ?>
                                </span>
                                <?php else: ?>
                                <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo !empty($row['lahir_as']) ? date('d/m/Y', strtotime($row['lahir_as'])) : '<span class="text-muted">-</span>'; ?></td>
                            <td><?php echo !empty($row['anak_dua']) ? $row['anak_dua'] : '<span class="text-muted">-</span>'; ?></td>
                            <td>
                                <?php if(!empty($row['jk_ad'])): ?>
                                <span class="badge <?php echo $row['jk_ad'] == 'Laki-Laki' ? 'badge-primary' : 'badge-secondary'; ?>">
                                    <?php echo $row['jk_ad'] == 'Laki-Laki' ? 'L' : 'P'; ?>
                                </span>
                                <?php else: ?>
                                <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo !empty($row['lahir_ad']) ? date('d/m/Y', strtotime($row['lahir_ad'])) : '<span class="text-muted">-</span>'; ?></td>
                            <td><?php echo !empty($row['nm_klinik']) ? $row['nm_klinik'] : '<span class="text-muted">-</span>'; ?></td>
                            <td><?php echo !empty($row['almt_klinik']) ? (strlen($row['almt_klinik']) > 15 ? substr($row['almt_klinik'], 0, 15) . '...' : $row['almt_klinik']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <?php 
                            }
                        } else { 
                        ?>
                        <tr>
                            <td colspan="13" class="empty-data">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                Tidak ada data keluarga peserta
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="footer no-print">
            <p>&copy; <?php echo date('Y'); ?> Kenanga Care - Sistem Pendaftaran Peserta Asuransi</p>
        </div>
        
        <div class="action-buttons no-print">
            <a href="javascript:window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Laporan
            </a>
            <a href="data-peserta.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Data Peserta
            </a>
        </div>
    </div>
</body>
</html>