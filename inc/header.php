<?php include('admin/inc/config.php');
	session_start();
?>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<meta name="author" content="SKARIGA">
	<meta name="description" content="PERPUSTAKAAN.Tm .">
	<meta name="keyword" content="Skariga , Perpustakaan">
	<title><?php echo $page . " - SKARIGA PERPUSTAKAAN" ?></title>
	<link rel="icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div id="wrapper">
		<header>
			
			<section id="action-bar">
				<div class="conatiner">
					<div id="logo">
						<a href="index.php"><img src="img/logo.png"></a>
					</div>

					<nav class="dropdown">
						<ul>
							<li>
								<a href="#">Kategori</a>
								<ul>
									<?php
										$query = mysqli_query($connect, "SELECT * from kategori");
										while($data = mysqli_fetch_array($query)){
											echo "<li><a href='kategori.php?kategori=$data[id_kategori]'>$data[nama_kategori]</a></li>";
										}
									?>
								</ul>
							</li>
						</ul>
					</nav>
					<div id="user-menu">
						<nav id="signin" class="dropdown">
							<ul>
								<?php
									if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
								?>
								<li>
									<a href='account.php'><img src="img/user-icon.gif" alt="Sign in" /><?php echo "Profil Saya"; ?><img src="img/down-arrow.gif" alt="Produk" /></a>
							<ul>
								<li><a href="sign_in.php">Profil Saya</a></li>
								<li><a href="sign_out.php">Sign Out</a></li>
							</ul>
						</li>
						<?php
							}else{
						?>
							<li>
								<a href='sign_in.php'><img src='img/user-icon.gif' alt='Sign In'>Sign in<img src='img/down-arrow.gif' alt='Sign In'></a>
								<ul>
									<li><a href='sign_in.php'>Sign In</a></li>
									<li><a href='sign_up.php'>Sign Up</a></li>
								</ul>
							</li>
							<?php
								}
							?>
					</ul>
				</nav>
			</div>
			<div id="view-cart">
				<a href="cart.php">Histori Peminjaman<img src="img/blue-cart.gif" alt="View Cart"> 
				</a>
			</div>
		</div>
	</section>
			</header>
	
