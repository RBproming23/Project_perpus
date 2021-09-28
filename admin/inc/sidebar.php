<section class="sidebar text-center">
	<div class="avatar">
		<a href="login_admin.php">
			<img src="img/logo.jpg" alt="Profil">
		</a>
	</div>
	<h1>Hai, <?php echo $_SESSION['nama'];?></h1>
	<hr>
	<p><?php echo date('l, d F Y'); ?></p>
	<hr>

	<ul class="menu">
		<li><a href="buku.php">Buku</a></li>
		<li><a href="kategori.php">Kategori Buku</a></li>
		<li><a href="user.php">User</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
	<span>Author: @magang_codelaris</span>	
</section>