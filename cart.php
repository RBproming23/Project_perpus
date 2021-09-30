<?php $page="History Peminjaman";?>
<?php include("inc/header.php");
if(!isset($_SESSION['id_user'])){
		header('location:sign_in.php');
	}
?>
<?php 
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		$query_insert = mysqli_query($connect, "INSERT into Peminjaman(id_user, id_buku, status) values
			('$_SESSION[id_user]', '$_GET[id]', 2)");
			if($query_insert){
				echo "Data berhasil ditambahkan";
			}else{
				echo "Data gagal ditambahkan";
			}
			echo "<hr>";
	}

?>
<section id="main-content" class="cleaarfix">
	<div class="container">
		<hr>
		<div id="shopping-cart">
			<h2>History Peminjaman</h2>
			<form action="cart.php?act=checkout" method="post">
				<table border="1">
					<tr>
						<th>#</th>
						<th>Nama Buku</th>
						<th>Gambar</th>
						<th>Kategori</th>
						<th>Status</th>
					</tr>
					
					<?php 
					$query = mysqli_query($connect, "SELECT pem.status, b.nama_buku, b.gambar, k.nama_kategori from peminjaman pem, buku b, kategori k where pem.id_buku = b.id_buku and b.id_kategori = k.id_kategori and pem.id_user = '$_SESSION[id_user]'");
        if(mysqli_num_rows($query)>0){
        	$i = 0;
          while($data = mysqli_fetch_array($query)){  
            $i++;
            echo "
              <tr>
                <td>".$i."</td>
                <td>$data[nama_buku]</td>
                <td><img src='admin/uploads/buku/$data[gambar]' width='500px'></td>
                <td>$data[nama_kategori]</td>
                <td>";
                if($data['status'] == 2){
                    echo "Dipinjam";
                  }else{
                    echo "Dikembalikan";
                    }
                    echo "</td>
              </tr>
            ";
          }
          }						?>
				</table>
			</form>
		</div>
	</div>
</section>
<?php include("inc/footer.php");?>