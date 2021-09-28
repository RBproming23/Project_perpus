<?php $page = "USER"; 
	include('inc/header.php');	
	include('inc/sidebar.php');
?>
<section class="main" style="background-color: #8B4513;">
	<h1>Manajemen User</h1>
	<hr>
	<?php 
		if(isset($_GET['act'])AND $_GET['act']=='tambah'){
			echo "
				<h3>Tambah Data</h3>
<form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
	<p><input type='text' name='nama' placeholder='Nama' required></p>
	<p><input type='password' name='password' placeholder='Password' required></p>
	<p><textarea name='alamat' cols='50' rows='10' placeholder='Alamat' required='true'></textarea></p>
	<p><input type='text' name='no_telepon' placeholder='Telepon' id='telepon' onkeyup='format_number(this)' required></p>
						<p><input type='file' name='gambar'></p>
	<p><input type='submit' name='proses' value='Simpan' class='btn btn-danger'></p>
</form>
<hr>
			";
		}elseif(isset($_GET['act'])AND $_GET['act']=='proses_tambah'){
			
				if($_FILES['gambar']['error'] !=0){
					$tambah = mysqli_query($connect, "INSERT into admin(username, password, alamat, no_telepon)VALUES('$_POST[nama]', '$_POST[password]', '$_POST[alamat]', '$_POST[no_telepon]')");
					}else{
						$tmp_file = $_FILES['gambar']['tmp_name'];
						$filename = $_FILES['gambar']['name'];
						$filetype = $_FILES['gambar']['type'];
						$filesize = $_FILES['gambar']['size'];
						$destination = 'img/'.$filename;

						if(move_uploaded_file($tmp_file, $destination)){
							$gambar = $filename;
						}
						$tambah = mysqli_query($connect, "INSERT into admin(username, password, alamat, no_telepon, foto)VALUES('$_POST[nama]', '$_POST[password]', '$_POST[alamat]', '$_POST[no_telepon]', '$gambar')");
					}
			if($tambah){
				echo "Data berhasil ditambahkan";
			}else{
				echo "Data gagal ditambahkan";
			}
			echo "<hr>";
		}elseif(isset($_GET['act'])AND $_GET['act']=='edit'){
			$isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * from admin where id_admin = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
<form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='id' value='$isi[id_admin]' required>
	<p><input type='text' name='nama' value='$isi[username]' placeholder='Nama' required></p>
	<p><input type='password' name='password' value='$isi[password]' placeholder='Password' required></p>
	<p><textarea name='alamat' cols='50' rows='10' placeholder='Alamat' required='true'>$isi[alamat]</textarea></p>
	<p><input type='text' name='no_telepon' placeholder='Telepon' id='telepon' onkeyup='format_number(this)' value='$isi[no_telepon]' required></p>
	<img src='img/$isi[foto]' alt='$isi[username]' height='400px' weight='200px'><br>
					<input type='file'  name='gambar'>
	<p><input type='submit' name='proses' value='Simpan' class='btn btn-danger' ></p>
</form>
<hr>
			";
		}elseif(isset($_GET['act'])AND $_GET['act']=='proses_edit'){
			if($_FILES['gambar']['error'] !=0){
						$edit = mysqli_query($connect, "UPDATE admin set username='$_POST[nama]', password='$_POST[password]', alamat='$_POST[alamat]', no_telepon='$_POST[no_telepon]' where id_admin='$_POST[id]'");
					}else{
						$tmp_file = $_FILES['gambar']['tmp_name'];
						$filename = $_FILES['gambar']['name'];
						$filetype = $_FILES['gambar']['type'];
						$filesize = $_FILES['gambar']['size'];

						$destination = 'img/' . $filename;

						if(move_uploaded_file($tmp_file, $destination)){
							$gambar = $filename;
						}
						$edit = mysqli_query($connect, "UPDATE admin set username='$_POST[nama]', password='$_POST[password]', alamat='$_POST[alamat]', no_telepon='$_POST[no_telepon]', foto='$gambar' where id_admin='$_POST[id]'");
					}
			if($edit){
				echo "Data berhasil di update";
			}else{
				echo "Data gagal di update";
			}
			echo "<hr>";
		}elseif(isset($_GET['act'])AND $_GET['act']=='hapus'){
			$hapus = mysqli_query($connect, "DELETE from admin where id_admin ='$_GET[id]'");

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
			<th>Alamat</th>
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