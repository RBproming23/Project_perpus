<?php $page= "DETAIL BUKU"; ?>
<?php include("inc/header.php");?>

<section id="main-content" class="clearfix">
	<div class="container">
		<hr>
		<?php 
			$query = mysqli_query($connect, "SELECT * from buku where id_buku = $_GET[id]");
			while($data = mysqli_fetch_array($query)){
				if($data['stock']==1){
					$stok = "<span class='instock'>Stock Tersedia</span>";
				}else{
					$stok = "<span class='outofstock'>Stock Habis</span>";
				}
				echo "<div id='product-image'>
	<img src='admin/uploads/buku/$data[gambar]' alt='$data[nama_buku]' width='300px'>
</div>
<div id='product-details'>
	<h1>$data[nama_buku]</h1>
	<p class='code'>Kode Produk: <span>$data[id_buku]</span></p>
	<p>$data[keterangan]</p>
	<hr>
	<form action='cart.php' method='get'>
		<input type='hidden' name='id' value='$data[id_buku]'>
		
		
		<button type='submit' class='secondary-cart-btn'>
			 PINJAM SEKARANG
		</button>
	</form>
</div>

		";
			}
		?>
	</div>
</section>
<?php include("inc/footer.php")?>