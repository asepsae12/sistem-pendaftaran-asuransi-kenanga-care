<?php 
session_start();
include 'koneksi.php';
if($_SESSION['stat_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran='$id'");
    $data = mysqli_fetch_array($query);
}

if(isset($_POST['update'])){
    $history_card = $_POST['history_card'];
    $nm_perusahaan = $_POST['nm_perusahaan'];
    $no_kartu = $_POST['no_kartu'];
    $nama_peserta = $_POST['nama_peserta'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jabatan = $_POST['jabatan'];
    $jk = $_POST['jk'];
    $status = $_POST['status'];
    $almt_peserta = $_POST['almt_peserta'];
    $telepon = $_POST['telepon'];
    $suami_istri = $_POST['suami_istri'];
    $jk_si = $_POST['jk_si'];
    $lahir_si = $_POST['lahir_si'];
    $anak_satu = $_POST['anak_satu'];
    $jk_as = $_POST['jk_as'];
    $lahir_as = $_POST['lahir_as'];
    $anak_dua = $_POST['anak_dua'];
    $jk_ad = $_POST['jk_ad'];
    $lahir_ad = $_POST['lahir_ad'];

    $update = mysqli_query($conn, "UPDATE tb_pendaftaran SET history_card='$history_card', nm_perusahaan='$nm_perusahaan', no_kartu='$no_kartu', nama_peserta='$nama_peserta', tmp_lahir='$tmp_lahir', tgl_lahir='$tgl_lahir', jabatan='$jabatan', jk='$jk', status='$status', almt_peserta='$almt_peserta', telepon='$telepon', suami_istri='$suami_istri', jk_si='$jk_si', lahir_si='$lahir_si', anak_satu='$anak_satu', jk_as='$jk_as', lahir_as='$lahir_as', anak_dua='$anak_dua', jk_ad='$jk_ad', lahir_ad='$lahir_ad' WHERE id_pendaftaran='$id'");

    if($update){
        echo '<script>alert("Data berhasil diupdate!"); window.location="data-peserta.php";</script>';
    } else {
        echo '<script>alert("Gagal mengupdate data!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Peserta | Kenanga Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        body {
            background-color: #f5f7fb;
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .content {
            padding: 2rem;
            max-width: 1200px;
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
        
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: var(--primary);
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 0.5rem;
            margin: 2rem 0 1.5rem;
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-secondary {
            background: var(--gray);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background-color: var(--light-gray);
            border: 2px solid var(--light-gray);
            border-right: none;
        }
        
        .form-section {
            background-color: rgba(67, 97, 238, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary);
        }
        
        .optional-badge {
            background-color: var(--gray);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-left: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }
        
        .alert-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="beranda.php">
            <i class="fas fa-hospital-user me-2"></i>Kenanga Care
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
                    <a class="nav-link" href="data-peserta.php">
                        <i class="fas fa-users me-1"></i> Data Peserta
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
    <h2><i class="fas fa-user-edit me-2"></i>Edit Data Peserta</h2>
    
    <div class="form-container">
        <?php if(isset($_POST['update']) && $update): ?>
        <div class="alert-message alert-success">
            <i class="fas fa-check-circle me-2"></i> Data berhasil diupdate!
        </div>
        <?php elseif(isset($_POST['update']) && !$update): ?>
        <div class="alert-message alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> Gagal mengupdate data!
        </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>Keterangan Peserta Kenanga Care
                </h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="history_card" class="form-label">Keterangan</label>
                        <select class="form-select" id="history_card" name="history_card" required>
                            <option value="">--Pilih Keterangan--</option>
                            <option value="Daftar Peserta Baru" <?php echo ($data['history_card'] == 'Daftar Peserta Baru') ? 'selected' : ''; ?>>Daftar Peserta Baru</option>
                            <option value="Perpanjangan Masa Berlaku" <?php echo ($data['history_card'] == 'Perpanjangan Masa Berlaku') ? 'selected' : ''; ?>>Perpanjangan Masa Berlaku</option>
                            <option value="Ganti Status" <?php echo ($data['history_card'] == 'Ganti Status') ? 'selected' : ''; ?>>Ganti Status</option>
                            <option value="Tambahan Anak" <?php echo ($data['history_card'] == 'Tambahan Anak') ? 'selected' : ''; ?>>Tambahan Anak</option>
                            <option value="Ganti Klinik Provider" <?php echo ($data['history_card'] == 'Ganti Klinik Provider') ? 'selected' : ''; ?>>Ganti Klinik/Provider</option>
                            <option value="Kartu Hilang" <?php echo ($data['history_card'] == 'Kartu Hilang') ? 'selected' : ''; ?>>Kartu Hilang</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nm_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nm_perusahaan" name="nm_perusahaan" value="<?php echo $data['nm_perusahaan']; ?>" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_kartu" class="form-label">No. Kartu KC</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="<?php echo $data['no_kartu']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama_peserta" class="form-label">Nama Peserta</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="<?php echo $data['nama_peserta']; ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?php echo $data['tmp_lahir']; ?>" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $data['jabatan']; ?>" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" required>
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki" <?php echo ($data['jk'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo ($data['jk'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">--Pilih Status--</option>
                            <option value="Lajang/Single" <?php echo ($data['status'] == 'Lajang/Single') ? 'selected' : ''; ?>>Lajang/Single</option>
                            <option value="Kawin/Keluarga" <?php echo ($data['status'] == 'Kawin/Keluarga') ? 'selected' : ''; ?>>Kawin/Keluarga</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $data['telepon']; ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="almt_peserta" class="form-label">Alamat</label>
                    <textarea class="form-control" id="almt_peserta" name="almt_peserta" rows="2" required><?php echo $data['almt_peserta']; ?></textarea>
                </div>
            </div>
            
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-users me-2"></i>Keterangan Keluarga Peserta
                    <span class="optional-badge">Opsional</span>
                </h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="suami_istri" class="form-label">Nama Suami/Istri</label>
                        <input type="text" class="form-control" id="suami_istri" name="suami_istri" value="<?php echo $data['suami_istri']; ?>">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="jk_si" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk_si" name="jk_si">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki" <?php echo ($data['jk_si'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo ($data['jk_si'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="lahir_si" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="lahir_si" name="lahir_si" value="<?php echo $data['lahir_si']; ?>">
                    </div>
                </div>
                
                <h5 class="mt-4 mb-3">Data Anak</h5>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="anak_satu" class="form-label">Nama Anak Pertama</label>
                        <input type="text" class="form-control" id="anak_satu" name="anak_satu" value="<?php echo $data['anak_satu']; ?>">
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="jk_as" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk_as" name="jk_as">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki" <?php echo ($data['jk_as'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo ($data['jk_as'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="lahir_as" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="lahir_as" name="lahir_as" value="<?php echo $data['lahir_as']; ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="anak_dua" class="form-label">Nama Anak Kedua</label>
                        <input type="text" class="form-control" id="anak_dua" name="anak_dua" value="<?php echo $data['anak_dua']; ?>">
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="jk_ad" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk_ad" name="jk_ad">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki" <?php echo ($data['jk_ad'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo ($data['jk_ad'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="lahir_ad" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="lahir_ad" name="lahir_ad" value="<?php echo $data['lahir_ad']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-end mt-4">
                <a href="data-peserta.php" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" name="update" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menambahkan efek pada form
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi form sebelum submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi!');
            }
        });
        
        // Menghilangkan kelas is-invalid saat user mulai mengisi
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    });
</script>

</body>
</html>