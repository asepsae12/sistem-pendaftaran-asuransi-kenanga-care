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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Peserta - <?php echo $p->nama_peserta; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    @media print {
      @page {
        size: 9cm 6cm;
        margin: 0;
      }
      body {
        margin: 0;
        padding: 0;
        background: #fff;
      }
      .container {
        width: 100% !important;
        padding: 0 !important;
      }
      .no-print {
        display: none !important;
      }
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      margin: 0;
      padding: 20px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .print-controls {
      margin-bottom: 20px;
      background: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      display: flex;
      gap: 10px;
    }

    .btn {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: all 0.3s;
    }

    .btn-primary {
      background: #4361ee;
      color: white;
    }

    .btn-primary:hover {
      background: #3a56d4;
    }

    .btn-secondary {
      background: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      max-width: 1000px;
    }

    .card {
      width: 9cm;
      height: 6cm;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      background: #fff;
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    /* DEPAN */
    .front {
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .front-header {
      background: linear-gradient(90deg, #004080 0%, #0066cc 100%);
      color: #fff;
      padding: 8px 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      height: 25px;
    }

    .front-header h2 {
      margin: 0;
      font-size: 16px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .front-logo {
      position: absolute;
      top: 5px;
      left: 10px;
      width: 30px;
      height: 30px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #004080;
      font-size: 14px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .front-body {
      padding: 15px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .participant-info {
      margin-bottom: 10px;
    }

    .info-row {
      display: flex;
      margin-bottom: 4px;
      font-size: 11px;
    }

    .info-label {
      font-weight: 600;
      color: #004080;
      min-width: 90px;
    }

    .info-value {
      color: #333;
      flex: 1;
    }

    .front-footer {
      background: #004080;
      height: 12px;
      width: 100%;
    }

    .card-id {
      position: absolute;
      bottom: 20px;
      right: 15px;
      font-size: 9px;
      color: #888;
    }

    /* BELAKANG */
    .back {
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .back-header {
      background: linear-gradient(90deg, #004080 0%, #0066cc 100%);
      color: #fff;
      padding: 8px 15px;
      text-align: center;
      height: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .back-header h3 {
      margin: 0;
      font-size: 14px;
      font-weight: 600;
    }

    .back-body {
      padding: 12px 15px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .terms {
      font-size: 9px;
      line-height: 1.4;
    }

    .terms p {
      margin: 0 0 5px 0;
    }

    .terms-number {
      font-weight: bold;
      color: #004080;
    }

    .contact-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 9px;
      color: #004080;
      margin-top: 5px;
    }

    .back-footer {
      background: #004080;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 9px;
    }

    .watermark {
      position: absolute;
      bottom: 15px;
      right: 15px;
      opacity: 0.1;
      font-size: 40px;
      font-weight: bold;
      color: #004080;
      transform: rotate(-15deg);
    }

    @media (max-width: 768px) {
      body {
        padding: 10px;
      }
      
      .container {
        flex-direction: column;
        align-items: center;
      }
      
      .print-controls {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="print-controls no-print">
    <button class="btn btn-primary" onclick="window.print()">
      <i class="fas fa-print"></i> Cetak Kartu
    </button>
    <button class="btn btn-secondary" onclick="window.history.back()">
      <i class="fas fa-arrow-left"></i> Kembali
    </button>
  </div>

  <div class="container">
    <!-- DEPAN -->
    <div class="card">
      <div class="front">
        <div class="front-header">
          <div class="front-logo">KM</div>
          <h2>KENANGA MEDICARE</h2>
        </div>
        <div class="front-body">
          <div class="participant-info">
            <div class="info-row">
              <span class="info-label">Nama Peserta</span>
              <span class="info-value">: <?php echo $p->nama_peserta; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">No. Kartu</span>
              <span class="info-value">: <?php echo $p->no_kartu; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Jenis Kelamin</span>
              <span class="info-value">: <?php echo $p->jk; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Perusahaan</span>
              <span class="info-value">: <?php echo $p->nm_perusahaan; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Tgl Lahir</span>
              <span class="info-value">: <?php echo $p->tmp_lahir; ?>, <?php echo $p->tgl_lahir; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Provider</span>
              <span class="info-value">: ALL PROVIDER</span>
            </div>
            <div class="info-row">
              <span class="info-label">Rawat Inap</span>
              <span class="info-value">: Tidak Dijamin</span>
            </div>
          </div>
          <div class="card-id">ID: <?php echo $p->id_pendaftaran; ?></div>
        </div>
        <div class="front-footer"></div>
      </div>
    </div>

    <!-- BELAKANG -->
    <div class="card">
      <div class="back">
        <div class="back-header">
          <h3>INFORMASI & KETENTUAN</h3>
        </div>
        <div class="back-body">
          <div class="terms">
            <p><span class="terms-number">1.</span> Kartu ini hanya berlaku untuk pemegang yang namanya tercantum.</p>
            <p><span class="terms-number">2.</span> Kartu tidak dapat dipindahtangankan.</p>
            <p><span class="terms-number">3.</span> Wajib ditunjukkan saat melakukan pelayanan medis.</p>
            <p><span class="terms-number">4.</span> Kehilangan kartu harus segera dilaporkan.</p>
            <p><span class="terms-number">5.</span> Syarat dan ketentuan mengikuti polis asuransi.</p>
          </div>
          <div class="contact-info">
            <span><i class="fas fa-phone"></i> (021) 1234-5678</span>
            <span><i class="fas fa-globe"></i> www.kenangamedicare.co.id</span>
          </div>
        </div>
        <div class="back-footer">
          LAYANAN 24 JAM | CALL CENTER
        </div>
        <div class="watermark">KM</div>
      </div>
    </div>
  </div>

  <script>
    // Fungsi untuk menangani pencetakan
    document.addEventListener('keydown', function(e) {
      // Ctrl+P untuk mencetak
      if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        window.print();
      }
    });
  </script>
</body>
</html>