<?php 
include 'koneksi.php';
if(isset($_POST['submit'])){

    $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_pendaftaran, 5)) AS id FROM tb_pendaftaran");
    $d = mysqli_fetch_object($getMaxId);
    $generateId = 'P'.date('Y').sprintf("%05s", $d->id + 1);

    $insert = mysqli_query($conn, "INSERT INTO tb_pendaftaran VALUES (
        '".$generateId."',
        '".date('Y-m-d')."',
        '".$_POST['history_card']."',
        '".$_POST['nm_perusahaan']."',
        '".$_POST['no_kartu']."',
        '".$_POST['nama_peserta']."',
        '".$_POST['tmp_lahir']."',
        '".$_POST['tgl_lahir']."', 
        '".$_POST['jabatan']."',
        '".$_POST['jk']."',
        '".$_POST['status']."',
        '".$_POST['telepon']."',
        '".$_POST['alamat']."',
        '".$_POST['suami_istri']."',
        '".$_POST['jk_si']."',
        '".$_POST['lahir_si']."',
        '".$_POST['anak_satu']."',
        '".$_POST['jk_as']."',
        '".$_POST['lahir_as']."',
        '".$_POST['anak_dua']."',
        '".$_POST['jk_ad']."',
        '".$_POST['lahir_ad']."',
        '".$_POST['nm_klinik']."',
        '".$_POST['almt_klinik']."'
    )");

    if($insert){
        echo '<script>window.location="berhasil.php?id='.$generateId.'"</script>';
    }else{
        echo 'Error'.mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Peserta Baru - Kenanga Care</title>
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
            --success: #4cc9f0;
        }
        
        body {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: #343a40;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        
        .header h2 {
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header p {
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .form-section {
            padding: 25px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .form-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 8px;
            color: var(--primary);
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .form-select {
            padding: 12px 15px;
            border-radius: 8px;
        }
        
        .btn-submit {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 14px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .optional-badge {
            background-color: var(--light-gray);
            color: var(--gray);
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 4px;
            margin-left: 8px;
        }
        
        .progress-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            max-width: 1000px;
            margin: 0 auto 30px;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 20px;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--light-gray);
            transform: translateY(-50%);
            z-index: 1;
        }
        
        .progress-bar {
            position: absolute;
            top: 50%;
            left: 0;
            height: 4px;
            background: var(--primary);
            transform: translateY(-50%);
            z-index: 2;
            transition: width 0.5s;
            width: 0%;
        }
        
        .step {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            border: 3px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--gray);
            position: relative;
            z-index: 3;
        }
        
        .step.active {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }
        
        .step-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 8px;
            font-size: 0.8rem;
            white-space: nowrap;
            color: var(--gray);
        }
        
        .step.active .step-label {
            color: var(--primary);
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-section {
                padding: 20px 15px;
            }
            
            .progress-steps {
                padding: 0 20px;
            }
            
            .step-label {
                font-size: 0.7rem;
            }
        }
        
        .required-field::after {
            content: '*';
            color: #dc3545;
            margin-left: 4px;
        }
        
        .form-note {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2><i class="fas fa-user-plus me-2"></i>Formulir Pendaftaran Peserta Baru</h2>
        <p>Kenanga Care (KC) - Silakan isi formulir berikut dengan data yang benar dan lengkap</p>
    </div>

    <div class="progress-container">
        <div class="progress-steps">
            <div class="progress-bar" id="progressBar"></div>
            <div class="step active" id="step1">
                <span>1</span>
                <span class="step-label">Keterangan</span>
            </div>
            <div class="step" id="step2">
                <span>2</span>
                <span class="step-label">Data Peserta</span>
            </div>
            <div class="step" id="step3">
                <span>3</span>
                <span class="step-label">Keluarga</span>
            </div>
            <div class="step" id="step4">
                <span>4</span>
                <span class="step-label">Klinik</span>
            </div>
        </div>
    </div>

    <div class="form-container">
        <form action="" method="post" id="registrationForm">
            <!-- Section 1: Keterangan -->
            <div class="form-section">
                <h4 class="section-title"><i class="fas fa-info-circle"></i> Keterangan Untuk</h4>
                <div class="form-group">
                    <label class="form-label required-field"><i class="fas fa-tag"></i> Keterangan</label>
                    <select class="form-select" name="history_card" required>
                        <option value="">-- Pilih Keterangan --</option>
                        <option value="Daftar Peserta Baru">Daftar Peserta Baru</option>
                        <option value="Perpanjangan Masa Berlaku">Perpanjangan Masa Berlaku</option>
                        <option value="Ganti Status">Ganti Status</option>
                        <option value="Tambahan Anak">Tambahan Anak</option>
                        <option value="Ganti Klinik Provider">Ganti Klinik/Provider</option>
                        <option value="Kartu Hilang">Kartu Hilang</option>
                    </select>
                </div>
            </div>

            <!-- Section 2: Data Peserta -->
            <div class="form-section">
                <h4 class="section-title"><i class="fas fa-user-tie"></i> Data Peserta Kenanga Care (KC)</h4>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-building"></i> Nama Perusahaan</label>
                        <input type="text" name="nm_perusahaan" class="form-control" placeholder="Nama Perusahaan" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-address-card"></i> No. Kartu KC</label>
                        <input type="text" name="no_kartu" class="form-control" placeholder="No. Kartu KC" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-user"></i> Nama Peserta</label>
                        <input type="text" name="nama_peserta" class="form-control" placeholder="Nama Lengkap Peserta" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                        <input type="text" name="tmp_lahir" class="form-control" placeholder="Tempat Lahir" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-calendar-alt"></i> Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-briefcase"></i> Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-select" name="jk" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-heart"></i> Status</label>
                        <select class="form-select" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Lajang/Single">Lajang/Single</option>
                            <option value="Kawin/Keluarga">Kawin/Keluarga</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-phone"></i> No. Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="No. Telepon" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required-field"><i class="fas fa-home"></i> Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>
                    </div>
                </div>
            </div>

            <!-- Section 3: Keluarga -->
            <div class="form-section">
                <h4 class="section-title"><i class="fas fa-users"></i> Data Anggota Keluarga Peserta <span class="optional-badge">Opsional</span></h4>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user-friends"></i> Nama Suami/Istri</label>
                        <input type="text" name="suami_istri" class="form-control" placeholder="Nama Suami/Istri">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-select" name="jk_si">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir</label>
                        <input type="date" name="lahir_si" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-child"></i> Nama Anak Pertama</label>
                        <input type="text" name="anak_satu" class="form-control" placeholder="Nama Anak Pertama">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-select" name="jk_as">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir</label>
                        <input type="date" name="lahir_as" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-child"></i> Nama Anak Kedua</label>
                        <input type="text" name="anak_dua" class="form-control" placeholder="Nama Anak Kedua">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-select" name="jk_ad">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir</label>
                        <input type="date" name="lahir_ad" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Section 4: Klinik -->
            <div class="form-section">
                <h4 class="section-title"><i class="fas fa-hospital"></i> Pilihan Klinik (Provider TK.1) <span class="optional-badge">Opsional</span></h4>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-hospital-alt"></i> Nama Klinik</label>
                        <input type="text" name="nm_klinik" class="form-control" placeholder="Nama Klinik">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-map-marked-alt"></i> Alamat Klinik</label>
                        <input type="text" name="almt_klinik" class="form-control" placeholder="Alamat Klinik">
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-submit">
                    <i class="fas fa-paper-plane me-2"></i> Submit Pendaftaran
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Progress bar functionality
        const formSections = document.querySelectorAll('.form-section');
        const progressBar = document.getElementById('progressBar');
        const steps = document.querySelectorAll('.step');
        
        function updateProgress() {
            let currentSection = 0;
            
            formSections.forEach((section, index) => {
                const inputs = section.querySelectorAll('input, select, textarea');
                let allFilled = true;
                
                inputs.forEach(input => {
                    if (input.hasAttribute('required') && !input.value) {
                        allFilled = false;
                    }
                });
                
                if (allFilled && index >= currentSection) {
                    currentSection = index + 1;
                }
            });
            
            // Update progress bar width
            const progressPercentage = (currentSection / formSections.length) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            
            // Update step indicators
            steps.forEach((step, index) => {
                if (index < currentSection) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }
        
        // Add event listeners to all inputs
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('change', updateProgress);
        });
        
        // Initialize progress
        updateProgress();
        
        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            let valid = true;
            
            // Check required fields
            document.querySelectorAll('[required]').forEach(field => {
                if (!field.value) {
                    valid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    </script>
</body>
</html>