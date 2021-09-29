<?php $page = "SIGN IN";?>
<?php include("inc/header.php");
	if(isset($_SESSION['username'])AND isset($_SESSION['password'])){
		header('location:index.php');
	}?>
<section id="signin-form">
	<div class="container">
	<hr>
	<h1>Sign In</h1>
	<form action="sign_in.php?act=sign_in" method="post">
		<?php 
			if(isset($_GET['act'])AND $_GET['act']=='sign_in'){
				$query = mysqli_query($connect, "SELECT * from user where username = '$_POST[username]'AND password=md5('$_POST[password]') and role='2'");
				if(mysqli_num_rows($query)==1){
					$data_member = mysqli_fetch_array($query);
					session_start();
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['password'] = $_POST['password'];
					$_SESSION['id_user'] = $data_member['id_user'];
					header('location:index.php');
				}else{
					echo "<h1>Gagal Login</h1>";
				}
			}
		?>
		<p>
			<input type="text" name="username" placeholder="username">
		</p>
		<p>
			<input type="password" name="password" placeholder="password">
		</p>
		<button type="submit" class="secondary-cart-btn">SIGN IN</button>
	</form>
</div>
</section>
<?php include("inc/footer.php");?>