<?php $page = "Buku";
  include('inc/header.php');
  include('inc/sidebar.php');?>

  <section class="main">
    <h1>Buku</h1>
    <hr>
    <?php 
        if(isset($_GET['act'])AND $_GET['act']=='tambah'){
          echo "
            <h3>Tambah Data</h3>
            <form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
            <p><input type='text' name='buku' placeholder='nama buku' required></p>
            <p><textarea name='keterangan' cols='50' rows='10' placeholder='keterangan' required='true'></textarea></p>
            <p>
              Kategori: <select name='id_kategori'>
          
          ";
          $kategori = mysqli_query($connect, "SELECT * FROM kategori");
          while($opsi=mysqli_fetch_array($kategori)){
            echo "<option class='form-control' value='$opsi[id_kategori]'>$opsi[nama_kategori]</option>";
          }
          echo "
            </select>
          </p>
          <p><input type='file' name='gambar'></p>
          <p>
          stok : <select name='stok'>
          <option value='1'>ada</option>
          <option value='2'>kosong</option>
          </select>
          </p>
          <p><input type='submit' name='proses' value='Simpan' class='btn btn-danger'></p>
          </form>
          <hr>
          ";
        }elseif (isset($_GET['act'])AND $_GET['act']=='proses_tambah') {
          if($_POST['nama_buku'] = null){
          echo "Data gagal ditambahkan";
          }else{
          if($_FILES['gambar']['error'] !=0){
          $tambah = mysqli_query($connect, "INSERT into buku (nama_buku, keterangan, id_kategori, stock)
              values ('$_POST[buku]', '$_POST[keterangan]', '$_POST[id_kategori]', '$_POST[stok]')");
          }else{
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];
            $destination = 'uploads/buku/'.$filename;

            if(move_uploaded_file($tmp_file, $destination)){
              $gambar = $filename;
            }
            $tambah = mysqli_query($connect, "INSERT into buku (nama_buku, keterangan, id_kategori, gambar, stock)
              values ('$_POST[buku]', '$_POST[keterangan]', '$_POST[id_kategori]', '$gambar', '$_POST[stok]')");
          }
          if($tambah){
            echo "Data berhasil ditambahkan";
          }else{
            echo "Data gagal ditambahkan";
          }
          echo "<hr>";
        }
        }elseif(isset($_GET['act']) AND $_GET['act']=='edit'){
          $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM buku WHERE id_buku = '$_GET[id]'"));
          echo "
            <h3>Edit Data</h3>
            <form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
            <input type = 'hidden' name='id' value='$isi[id_buku]'>
            <p><input type='text' name='nama_buku' value='$isi[nama_buku]' placeholder='Nama buku'></p>
            <p><textarea name='Keterangan' cols='50' rows='10' placeholder='keterangan'>$isi[keterangan]</textarea></p>
            <p>
              Kategori: <select name='id_kategori'>

          ";
            $kategori = mysqli_query($connect, "SELECT * FROM kategori");
            while($opsi = mysqli_fetch_array($kategori)){
              echo "<option value='$opsi[id_kategori]'>
            $opsi[kategori]</option>";
        }
        echo "
          </select>
          <p>
          stok : <select name='stok'>
          <option value='1'>ada</option>
          <option value='2'>kosong</option>
          </select>
          </p>
          </p>
          <img src='uploads/buku/$isi[gambar]' alt='$isi [nama_buku]'><br>
          <input type='file'  name='gambar'>
          </p>
          <p><input type='submit' name='proses' value='simpan' class='btn btn-danger'></p>
          </form>
          <hr>
        ";
      }elseif (isset($_GET['act'])AND $_GET['act']=='proses_edit'){
          if($_FILES['gambar']['error'] !=0){
            $edit = mysqli_query($connect, "UPDATE buku SET nama_buku = '$_POST[nama_buku]', keterangan = '$_POST[Keterangan]', id_kategori = '$_POST[id_kategori]', stock = '$_POST[stok]' where id_buku = '$_POST[id]'");
          }else{
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];

            $destination = 'uploads/buku/' . $filename;

            if(move_uploaded_file($tmp_file, $destination)){
              $gambar = $filename;
            }
            $edit = mysqli_query($connect, "UPDATE buku set nama_buku = '$_POST[nama_buku]', keterangan = '$_POST[keterangan]', id_kategori= '$_POST[id_kategori]', gambar = '$gambar', stock = '$_POST[stok]'  where id_buku = '$_POST[id]'");
          }
          if($edit){
            echo "Data Berhasil Diedit";
          }else{
            echo "Data Gagal Diedit";
          }
          echo "<hr>";
        }elseif(isset($_GET['act']) AND $_GET['act']=='hapus'){
          $hapus = mysqli_query($connect, "DELETE from buku where id_buku = '$_GET[id]'");

          if($hapus){
            echo "Data Berhasil Dihapus";
          }else{
            echo "Data Gagal Dihapus";
          }
          echo "<hr>";
        }
      ?>
    <a href="?act=tambah">
      <button type="button" class="btn btn-success">Tambah</button>
    </a>

  <table class="tabel" style="background-color: #FFFFFF;">
    <thead>
      <th>ID</th>
      <th>Nama Buku</th>
      <th>Gambar</th>
      <th>Kategori</th>
      <th>Stok</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </thead>
    <tbody>
      <?php
      $i = 0;
        $query = mysqli_query($connect, "SELECT alt.id_buku, alt.nama_buku, alt.gambar, wil.id_Kategori, wil.nama_kategori, alt.keterangan, alt.stock from
          buku alt, kategori wil where alt.id_kategori = wil.id_kategori");
        if(mysqli_num_rows($query)>0){
          while($data = mysqli_fetch_array($query)){
            
            $i++;
            echo "
              <tr>
                <td>".$i."</td>
                <td>$data[nama_buku]</td>
                <td><img src='uploads/buku/$data[gambar]' width='200px'></td>
                <td>$data[nama_kategori]</td>
                <td>";
                if($data['stock'] == 1){
                    echo "Ada";
                  }else{
                    echo "Kosong";
                    }
                    echo "</td>
                <td>$data[keterangan]</td>
                <td>
                  <a href='?act=edit&id=$data[id_buku]'>
                  <button type='button' class='btn kuning'>Edit</button>
                  </a>
                <a href='?act=hapus&id=$data[id_buku]' OnClick=\"return confirm('Anda yakin ingin menghapus data ?');\")>
                  <button type='button' class='btn merah'>Hapus</button>
                  </a>
                </td>
              </tr>
            ";
          }
        }else{
          echo "
            <tr>
              <td colspan='7'>Tidak ada data.</td>
            </tr>
          ";
          }
    ?>

      
  </tbody>
  </table>
    </section>
<?php include('inc/footer.php');?>