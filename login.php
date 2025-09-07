<?php 
	session_start();

	include 'koneksi.php';

	if(isset($_POST['login'])){

		$cek = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '".$_POST['user']."' AND password = '".MD5($_POST['pass'])."' ");

		if(mysqli_num_rows($cek) > 0){
			$a = mysqli_fetch_object($cek);

			$_SESSION['stat_login'] = true;
			$_SESSION['id_admin'] = $a->id_admin;
			$_SESSION['nama'] = $a->nm_admin;
			echo '<script>window.location="beranda.php"</script>';
		}else{
			echo '<script>alert("Gagal Login")</script>';
		}
	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);" class="bg-primary">
	<section class="main-login">
		<div class="box-login">
			<form action="" method="post">
				<div class="box rounded-4">
					<h2 class="text-primary" style="padding-top: 0;">Login Admin</h2>
					<div class="m-0" style="padding: 10px 20px">
						<label for="exampleFormControlInput1" class="form-label">Usename</label>
						<input type="text" name='user' class="form-control" id="exampleFormControlInput1" placeholder="username">
					</div>
					<div class="mb-3" style="padding: 5px 20px;">
						<label for="exampleFormControlInput1" class="form-label">Password</label>
						<input type="password" name='pass' class="form-control" id="exampleFormControlInput1" placeholder="Password">
					</div>
					<div class="d-grid gap-2 mb-3" style="padding: 0 20px;">
						<button class="btn btn-primary" name="login" type="submit">Login</button>
					</div>

				</div>
			</form>
		</div>
	</section>
</body>
</html>