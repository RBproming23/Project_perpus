<?php include('inc/config.php');
	$nama	  = $_POST['nama'];
	$password = $_POST['password'];
	$nama	  = mysqli_real_escape_string($connect, $nama);
	$password = mysqli_real_escape_string($connect, $password);

	$query = mysqli_query($connect, "SELECT * FROM user WHERE username = '".$nama."' AND password = MD5('".$password."')");

	if(mysqli_num_rows($query)==1){
		session_start();
		  
		$_SESSION['nama'] = $nama;
		$_SESSION['password'] = $password;

		header('location:beranda.php');
	}else{
		header('location:login_admin.php');
	}
?>