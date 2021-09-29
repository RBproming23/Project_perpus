<?php $page = "Kategori Buku";
	include('inc/header.php');
	include('inc/sidebar.php');?>

	<section class="main">
		<h1>Kategori Buku</h1>
		<hr>
		<?php 
		if(isset($_GET['act'])AND $_GET['act']=='tambah'){
			echo"
			<h3>Tambah Data</h3>
			<form name='tambah' action='?act=proses_tambah' method='post'>
				<p><input type='text' name='kategori' placeholder='kategori' required></p>
				<p><input type='submit' name='proses' value='SIMPAN' class='btn btn-danger'></p>
			</form>
			<hr>
			";
		}
		elseif(isset($_GET['act'])AND $_GET['act']=='proses_tambah'){
			$tambah = mysqli_query($connect, "INSERT INTO kategori(nama_kategori) VALUES ('$_POST[kategori]')");
			if($tambah){
				echo "	Data berhasil ditambahkan!";
			}else{
				echo "	Data Gagal Ditambahkan!";
			}
			echo "<hr>";
		}elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
			$isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'"));
			echo"
				<h3>Edit Data</h3>
				<form name='edit' action='?act=proses_edit' method='post'>
					<input type='hidden' name='id' value='$isi[id_kategori]'>
					<p><input type='text' name='kategori' value='$isi[nama_kategori]' placeholder='kategori' required></p>
					<p><input type='submit' name='proses' value ='simpan' class='btn btn-danger'></p>
				</form>
				<hr>";
		}elseif (isset($_GET['act'])AND $_GET['act']=='proses_edit') {
			$edit = mysqli_query($connect, "UPDATE kategori set nama_kategori = '$_POST[kategori]' where id_kategori = '$_POST[id]'");
			if($edit){
				echo "Data berhasil di Edit!";
			}else{
				echo "Data Gagal di Edit";
			}
		}elseif (isset($_GET['act'])AND $_GET['act']== 'hapus') {
			$hapus = mysqli_query($connect, "DELETE FROM kategori where id_kategori ='$_GET[id]'");
			if($hapus){
				echo "Data Berhasil dihapus!";
			}else{
				echo "Data Gagal Dihapus";
			}
			echo "<hr>";
		}
		?>
		<a href="?act=tambah">
			<button type="button" class="btn btn-dark">Tambah</button>
		</a>
		
		<table class="tabel" style="background-color: #FFFFFF;">
			<thead>
				<tr>
					<th>ID</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = mysqli_query($connect, "SELECT * FROM kategori");

				if(mysqli_num_rows($query)>0){
					while($data = mysqli_fetch_array($query)){
						echo"
							<tr>
								<td>$data[id_kategori]</td>
								<td>$data[nama_kategori]</td>
								<td>
									<a href='?act=edit&id=$data[id_kategori]'>
									<button type='button' class='btn kuning'>edit</button>
									</a>
									<a href='?act=hapus&id=$data[id_kategori]' OnClick=\"return confirm('Anda yakin menghapus data ?');\")>
									<button type='button' class='btn merah'>Hapus</button>
									</a>
								</td>
							</tr>
						";
					}
				}else{
					echo "
					<tr>
						<td colspan='3'>Tidak ada data.</td>
					</tr>
					";
				}
				?>
			</tbody>
		</table>
	</section>
<?php include('inc/footer.php');?>