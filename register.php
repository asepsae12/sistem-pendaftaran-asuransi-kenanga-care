<?php 
	session_start();
	include 'koneksi.php';

	if(isset($_POST['register'])){
		$username = $_POST['user'];
		$password = MD5($_POST['pass']);
		$nama = $_POST['nama'];

		// Cek apakah username sudah ada
		$cek = mysqli_query($koneksi, "SELECT * FROM tb_peserta WHERE username = '$username'");
		if(mysqli_num_rows($cek) > 0){
			echo '<script>alert("Username sudah terdaftar")</script>';
		}else{
			// Simpan data peserta baru
			$query = mysqli_query($koneksi, "INSERT INTO tb_peserta (username, password, nm_peserta) VALUES ('$username', '$password', '$nama')");
			if($query){
				echo '<script>alert("Registrasi berhasil")</script>';
				echo '<script>window.location="index.php"</script>';
			}else{
				echo '<script>alert("Registrasi gagal")</script>';
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrasi</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body class="bg-primary">
	<section class="main-register">
		<div class="box-register">
			<form action="" method="post">
				<div class="box rounded-4">
					<h2 class="text-primary" style="padding-top: 0;">Registrasi Peserta</h2>
					<div class="m-0" style="padding: 10px 20px">
						<label for="username" class="form-label">Username</label>
						<input type="text" name='user' class="form-control" id="username" placeholder="username" required>
					</div>
					<div class="mb-3" style="padding: 5px 20px;">
						<label for="password" class="form-label">Password</label>
						<input type="password" name='pass' class="form-control" id="password" placeholder="Password" required>
					</div>
					<div class="mb-3" style="padding: 5px 20px;">
						<label for="nama" class="form-label">Nama Lengkap</label>
						<input type="text" name='nama' class="form-control" id="nama" placeholder="Nama Lengkap" required>
					</div>
					<div class="d-grid gap-2 mb-3" style="padding: 0 20px;">
						<button class="btn btn-primary" name="register" type="submit">Registrasi</button>
					</div>
				</div>
			</form>
		</div>
	</section>
</body>
</html>
