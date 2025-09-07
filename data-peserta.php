<?php 
session_start();
include 'koneksi.php';
if($_SESSION['stat_login'] != true){
    echo '<script>window.location="login.php"</script>';
}
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
        
        .box {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .card-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            flex: 1;
            min-width: 200px;
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
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
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }
        
        .stat-content h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-content p {
            margin: 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 1rem;
            border: none;
            text-align: left;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .table tbody tr {
            transition: all 0.2s;
        }
        
        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.2s;
        }
        
        .action-btn.view {
            background-color: #17a2b8;
        }
        
        .action-btn.edit {
            background-color: #ffc107;
        }
        
        .action-btn.delete {
            background-color: #dc3545;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
            color: white;
        }
        
        .search-box {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .search-box input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }
            
            .box {
                padding: 1.5rem;
            }
            
            .stat-card {
                min-width: 100%;
            }
            
            .top-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                flex-direction: column;
            }
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--light-gray);
        }
        
        .pagination {
            margin-top: 1.5rem;
            justify-content: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
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
    <h2><i class="fas fa-users me-2"></i>Data Peserta</h2>
    
    <div class="card-stats">
        <?php
        $total_peserta = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_pendaftaran");
        $total = mysqli_fetch_assoc($total_peserta);
        
        $perusahaan = mysqli_query($conn, "SELECT COUNT(DISTINCT nm_perusahaan) as perusahaan FROM tb_pendaftaran");
        $jml_perusahaan = mysqli_fetch_assoc($perusahaan);
        ?>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo $total['total']; ?></h3>
                <p>Total Peserta</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo $jml_perusahaan['perusahaan']; ?></h3>
                <p>Jumlah Perusahaan</p>
            </div>
        </div>
    </div>
    
    <div class="box">
        <div class="top-actions">
            <form method="GET" action="" class="search-box">
                <input type="text" name="search" placeholder="Cari berdasarkan nama peserta..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
            </form>
            
            <a href="cetak-peserta.php" target="_blank" class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Cetak Data
            </a>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pendaftaran</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Peserta</th>
                        <th>Jabatan</th>
                        <th>No. Telepon</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $query = "SELECT * FROM tb_pendaftaran WHERE nama_peserta LIKE '%$search%' ORDER BY id_pendaftaran DESC";
                    $list_peserta = mysqli_query($conn, $query);
                    
                    if(mysqli_num_rows($list_peserta) > 0) {
                        while($row = mysqli_fetch_array($list_peserta)) { 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['id_pendaftaran']; ?></td>
                        <td><?php echo $row['nm_perusahaan']; ?></td>
                        <td><?php echo $row['nama_peserta']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><?php echo $row['telepon']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="detail-peserta.php?id=<?php echo $row['id_pendaftaran']; ?>" class="action-btn view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="update.php?id=<?php echo $row['id_pendaftaran']; ?>" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus-peserta.php?id=<?php echo $row['id_pendaftaran']; ?>" class="action-btn delete" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h4>Data tidak ditemukan</h4>
                                <p><?php echo $search ? 'Hasil pencarian untuk "' . htmlspecialchars($search) . '" tidak ditemukan' : 'Belum ada data peserta'; ?></p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <!-- Simple Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menambahkan efek loading saat menghapus data
    document.querySelectorAll('.action-btn.delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if(!confirm('Anda yakin ingin menghapus data peserta ini?')) {
                e.preventDefault();
            }
        });
    });
    
    // Fitur live search (jika diinginkan)
    const searchInput = document.querySelector('input[name="search"]');
    const tableRows = document.querySelectorAll('.table tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const namaPeserta = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            if (namaPeserta.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>