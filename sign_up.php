<?php $page="SIGN UP";?>
<?php include("inc/header.php");
	if(isset($_SESSION['email'])AND isset($_SESSION['password'])){
		header('location:index.php');
	}
	?>
<section id="main-content">
	<div class="container">
		<hr>
		<div id="new-account">
			<h1>Buat Akun Baru</h1>
			<form action="sign_up.php?act=sign_up" method="POST">
				<?php
					if(isset($_GET['act'])AND $_GET['act']=='sign_up'){
							$tambah = mysqli_query($connect, "INSERT INTO user (NIS, nama_user, telepon, username, password, role) values('$_POST[NIS]', '$_POST[nama]', '$_POST[telepon]', '$_POST[username]', md5('$_POST[password]'), 2)");
							if($tambah){
								echo "<h4>Data berhasil disimpan</h4>";
							}else{
								echo "<h4>Data gagal disimpan</h4>";
							}
					}
				?>
				<p>
					<label for="firstname">
						<span class="required-field">*</span>NIS: 
					</label>
					<input type="number" id="firstname" name="NIS" required>
				</p>
				<p>
					<label for="lastname">
						<span clas="required-field">*</span>NAMA: 
					</label>
					<input type="text" id="lastname" name="nama" required>
				</p>
				<p>
					<label for="email">
						<span class="required-field">*</span>username: 
					</label>
					<input type="text" id="email" name="username" required>
				</p>
				<p>
					<label for="password">
						<span class="required-field">*</span>PASSWORD: 
					</label>
					<input type="password" id="password" name="password" required>
				</p>
				<p>
					<label for="telephone">
						<span class="required-field">*</span>TELEPON: 
					</label>
					<input type="number" id="telepon" name="telepon" required>
				</p>
				<p><span class="required-field">*</span>wajib diisi.</p>
				<hr>
				<input type="submit" value="BUAT AKUN" class="secondary-cart-btn">
			</form>
		</div>
	</div>
	
</section>
<?php include("inc/footer.php");?>