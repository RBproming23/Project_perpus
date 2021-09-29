<?php $page = "USER"; 
	include('inc/header.php');	
	include('inc/sidebar.php');
?>
<section class="main">
	<h1>Manajemen User</h1>
	<hr>
	<?php 
		if(isset($_GET['act'])AND $_GET['act']=='tambah'){
			echo "
				<h3>Tambah Data</h3>
<form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
	<p><input type='number' name='NIS' placeholder='NIS' required></p>
	<p><input type='text' name='nama' placeholder='Nama' required></p>
	<p><input type='text' name='username' placeholder='username' required></p>
	<p><input type='password' name='password' placeholder='Password' required></p>
	<p><input type='text' name='no_telepon' placeholder='Telepon' id='telepon' onkeyup='format_number(this)' required></p>
	<p>role: <select name='role'>
	<option value='1'>admin</option>
	<option value='2'>user</option>
	</select>
	</p>
	<p><input type='submit' name='proses' value='Simpan' class='btn btn-danger'></p>
</form>
<hr>
			";
		}elseif(isset($_GET['act'])AND $_GET['act']=='proses_tambah'){
			
				$tambah = mysqli_query($connect, "INSERT into user(NIS, nama_user,telepon, username, password, role)VALUES('$_POST[NIS]', '$_POST[nama]', '$_POST[no_telepon]', '$_POST[username]',md5('$_POST[password]'),  '$_POST[role]')");
			if($tambah){
				echo "Data berhasil ditambahkan";
			}else{
				echo "Data gagal ditambahkan";
			}
			echo "<hr>";
		}elseif(isset($_GET['act'])AND $_GET['act']=='edit'){
			$isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * from user where id_user = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
<form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='id' value='$isi[id_user]' required>
	<p><input type='number' name='NIS' value='$isi[NIS]' placeholder='NIS' required></p>
	<p><input type='text' name='nama' value='$isi[nama_user]' placeholder='Nama' required></p>
	<p><input type='text' name='username' value='$isi[username]' placeholder='username' required></p>
	<p><input type='password' name='password' value='$isi[password]' placeholder='Password' required></p>
	<p><input type='text' name='no_telepon' placeholder='Telepon' id='telepon' value='$isi[telepon]' required></p>
	<p>role: <select name='role'>
	<option value='1'>admin</option>
	<option value='2'>user</option>
	</select>
	</p>
	<p><input type='submit' name='proses' value='Simpan' class='btn btn-danger' ></p>
</form>
<hr>
			";
		}elseif(isset($_GET['act'])AND $_GET['act']=='proses_edit'){
			$edit = mysqli_query($connect, "UPDATE user set username='$_POST[username]', NIS='$_POST[NIS]', password=md5('$_POST[password]'), nama_user='$_POST[nama]', telepon='$_POST[no_telepon]', role='$_POST[role]' where id_user='$_POST[id]'");
			if($edit){
				echo "Data berhasil di update";
			}else{
				echo "Data gagal di update";
			}
			echo "<hr>";
		}elseif(isset($_GET['act'])AND $_GET['act']=='hapus'){
			$hapus = mysqli_query($connect, "DELETE from user where id_user ='$_GET[id]'");

			if($hapus){
				echo "Data berhasil dihapus";
			}else{
				echo "Data gagal dihapus";
			}
			echo "<hr>";
		}
	?>
	<a href='?act=tambah'>
		<button type="button" class="btn btn-dark">Tambah</button>
	</a>
	<table class="tabel" style="background-color: #FFFFFF;">
		<thead>
			<th>ID</th>
			<th>Nama</th>
			<th>Password</th>
			<th>No telepon</th>
			<th>Aksi</th>
		</thead>
		<tbody>
			<?php 
				$query = mysqli_query($connect, "SELECT * from user");
				if(mysqli_num_rows($query)>0){
					while($data = mysqli_fetch_array($query)){
						echo "
						<tr>
	<td>$data[id_user]</td>
	<td>$data[username]</td>
	<td>$data[password]</td>
	<td>$data[telepon]</td>
	<td>
		<a href='?act=edit&id=$data[id_user]'>
			<button type='button' class='btn kuning'>Edit</button>
		</a>
		<a href='?act=hapus&id=$data[id_user]'>
			<button type='button' class='btn merah' OnClick=\"return confirm('Anda yakin menghapus data ?');\")>Hapus</button>
		</a>
	</td>
</tr>
						
						";

					}
				}else{
					echo "
					<tr>
	<td colspan='4'>Tidak Ada Data.</td>
</tr>
					";
				}
			?>
		</tbody>
	</table>
</section>
<?php include('inc/footer.php');?>