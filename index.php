<?php $page = "BERANDA";?>
<?php include('inc/header.php');?>

<section id="promo">
	<div class="container">
		<div id="promo-details">
			<h1>Pengeluaran buku terbaru</h1>
			<p>Pinjam buku kami<br>degan tanpa syarat. </p>
	<a href="#" class="default-btn">PINJAM SEKARANG</a>
</div>
<img src="img/motivasi 3.jpg" alt="Promotional Ad" width="200px">
</div>
</section>
<section id="main-content">
    <div class="container">
        <h2>Produk Pilihan</h2>

        <hr>

        <div id="products">             
       
            <?php 
                $query = mysqli_query($connect, "SELECT * from buku");
                if(mysqli_num_rows($query)>0){
                    while($data = mysqli_fetch_array($query)){
                        if($data['stock'] ==1 ){
                            $stok = "<span class='instock'>Stok Tersedia</span>";
                        }else{
                            $stok = "<span class='outofstock'>Stok Habis</span>";
                        }
                        echo "
                            <div class='product'>
    <a href='detail_buku.php?id=$data[id_buku]'>
        <img src='admin/uploads/buku/$data[gambar]' alt='$data[nama_buku]' class='feature' width='150px' height='190px'>
    </a>
    <h3>
        <a href='detail_buku.php?id=$data[id_buku]'>$data[nama_buku]</a>
    </h3>
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
                }else{
                    echo "<h3>Tidak ada data</h3>";
                }
            ?>      
    </div>
    </div>
</section>

<?php include('inc/footer.php');?>