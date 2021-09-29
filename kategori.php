<?php $page= "KATEGORI"; 
	 include("inc/header.php");
	 if(!isset($_GET['Kategori'])){
	 ?>


<section id="main-content" class="clearfix">
	<div class="container">
		<h2>Produk</h2>
		<hr>
		
		<div id="listings">
			<?php
				
				if(!isset($_GET['kategori'])){
					$query = mysqli_query($connect, "SELECT * from buku");
				}else{
					$query = mysqli_query($connect, "SELECT * from buku where id_kategori = '$_GET[kategori]'");
				}
				while($data = mysqli_fetch_array($query)){
					if($data['stock']==1){
						$stok ="<span class='instock'>Stok Tersedia</span>";
					}else{
						$stok = "<span class='outofstock'>Stok Habis</span>";
					}
					echo "
						<div class='product'>
	<a href='detail_buku.php?id=$data[id_buku]'>
		<img src='admin/uploads/buku/$data[gambar]' alt='$data[nama_buku]' class='feature' width='150px' height='190px'>
	</a>
	<h3><a href='product_detail.php?id=$data[id_buku]'>$data[nama_buku]</a></h3>
	<p>$data[keterangan]</p>
	<h5>Ketersediaan: $stok</h5>
	<p>
		<a href='cart.php?id=$data[id_buku]' class='cart-btn'>
			<img src='img/blue-cart.gif' alt='Add to Cart'>PINJAM
		</a>
	</p>
</div>
					";
				}
			?>
	</div>
</div>
<?php }?>
<?php include("inc/footer.php"); ?>