<?php
	$page = "PEMINJAMAN";
	include ('inc/header.php');
	include ('inc/sidebar.php');
?>
<section class='main'>
	<h1>Manajemen Peminjaman</h1>
	<hr>
	<?php
		if(isset($_GET['act'])AND $_GET['act']=='finalized'){
			$status = mysqli_query($connect,"UPDATE peminjaman SET status = 1 where id_peminjaman = '$_GET[id]'");
			if($status){
				echo "Data Berhasil Disimpan";
			}else{
				echo "Data gagal disimpan";
			}
			echo "<hr>";
		}	echo "<hr>";
		
	?>
	<table class='tabel'>
		<thead>
			<th>ID</th>
			<th>User</th>
			<th>Buku</th>
			<th>Gambar</th>
			<th>Kategori</th>
			<th>Status</th>
			<th>Aksi</th>
		</thead>
		<tbody>
			<?php 
				$query = mysqli_query($connect, "SELECT pem.id_peminjaman, pem.status, b.nama_buku, b.gambar, k.nama_kategori, u.nama_user from peminjaman pem, buku b, kategori k, user u where pem.id_buku = b.id_buku and b.id_kategori = k.id_kategori and u.id_user = pem.id_user");
				if(mysqli_num_rows($query)>0){
					while($data = mysqli_fetch_array($query)){

					if($data['status']==1){
						$status = "<span style='color:green'>Dikembalikan</span>";
						$tombol = "-";
					}else{
						$status = "<span style='color:orange'>Dipinjam</span>";
						$tombol = "<a href='?act=finalized&id=$data[id_peminjaman]'>
								<button type='button' class='btn hijau'>Konfirmasi Pengembalian</button>
								</a>";
					}
					echo "
						<tr>
							<td>$data[id_peminjaman]</td>
							<td>$data[nama_user]</td>
							<td>$data[nama_buku]</td>
							<td>$data[gambar]</td>
							<td>$data[nama_kategori]</td>
							<td>$status</td>
							<td>
								$tombol
							</td>
						</tr>
					";
					}

				}else{
					echo " 
						<tr>
						<td colspan='7'>Tidak Ada Data</td>
						</tr>
					";
				}
			 ?>
		</tbody>
	</table>
</section>
<?php include('inc/footer.php'); ?>