<?php 
	session_start();
	session_destroy();

	echo '<script>window.location="user-login.php"</script>';
?>