<?php
    //Koneksi Database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dblatihan";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

    if(isset($_POST['bsimpan']))
    {


      if($_GET['hal']=="edit")
      {
        $edit = mysqli_query($koneksi,"UPDATE tmhs set 
                                        nim = '$_POST[tnim]',
                                        nama = '$_POST[tnama]',
                                        alamat = '$_POST[talamat]',
                                        prodi = '$_POST[tprodi]'
                                      WHERE id_mhs = '$_GET[id]'
                                                                   
                                     ");
if($edit)
{
echo "<script>
alert('edit data suksess!');
document.location='index.php';
</script>";
}
else
{
echo "<script>
alert('edit data GAGAL!!');
document.location='index.php';
</script>";
}

      }else
      {
        $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
        VALUES ('$_POST[tNIM]', '$_POST[tNAMA]', '$_POST[tALAMAT]', '$_POST[tPRODI]')
      ");
if($simpan)
{
echo "<script>
alert('simpan data suksess!');
document.location='index.php';
</script>";
}
else
{
echo "<script>
alert('simpan data GAGAL!!');
document.location='index.php';
</script>";
}
      }


     
    }

    //pengujian jika tombol edit dan haous di klik
    if(isset($_GET['hal']))
    {
      if($_GET['hal']== "edit")
      {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
          $vnim = $data['nim'];
          $vnama = $data['nama'];
          $valamat = $data['alamat'];
          $vprodi = $data['prodi'];
        }
      }
      else if ($_GET['hal'] == "hapus")
      {
        //persiapan hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
        if($hapus){
          echo "<script>
alert('hapus data sukses!!');
document.location='index.php';
</script>";
        }
      }
    
    }
?>

< !DOCTYPE <html>
<html>
<head>
    <title>CRUD 2022 & MySQL + Bootstrap 5</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<divclass="container">
    
    <h1 class="text-center">CRUD Framework</h1>
    <h2 class="text-center">@Ngodingpintar</h2>

    <!-- Awal Card Form -->
    <div class="card mt-3">
      <div class="card-header bg-primary text-white ">
        Form Input Data Mahasiswa
      </div>
      <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="tNIM" value="<?=@$vnim?>" class="form-control" placeholder="Input NIM Anda Disini!" required>
            </div>
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" name="tNAMA" value="<?=@$vnama?>" class="form-control" placeholder="Input NAMA Anda Disini!" required>
            </div>
            <div class="form-group">
                <label>ALAMAT</label>
                <textarea class="form-control" name="tALAMAT" placeholder="Input ALAMAT Anda Disini!"><?=@$valamat?></textarea>
            </div>
            <div class="form-group">
                <label>PRODI</label>
                <select class="form-control" name="tPRODI">
                    <option value="<?=@$vprodi?>"><?=@$vprodi?></option>
                    <option value="S1-TeknikInformatika">S1-TeknikInformatika</option>
                    <option value="S1-IlmuKomunikasi">S1-IlmuKomunikasi</option>
                    <option value="S1-Psikologi">S1-Psikologi</option>
                </select>
            </div>

            <button type="submit" class="btn-success" name="bsimpan">simpan</button>
            <button type="reset" class="btn-danger" name="breset">reset</button>
        </form>
     
      </div>
    </div>
    <!-- Akhir Card Form -->

    <!-- Awal Card tabel -->
       <div class="card mt-3">
      <div class="card-header bg-success text-white ">
        Daftar Mahasiswa
      </div>
      <div class="card-body">
        
        <table class="table table-bordered table-striped">
            <tr>
                <th>No.</th>
                <th>Nim</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Program studi</th>
                <th>Aksi</th>
            </tr>
            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
                while($data = mysqli_fetch_array($tampil)) :
            
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$data['nim']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['alamat']?></td>
                <td><?=$data['prodi']?></td>
                <td>
                  <a href="index.php?hal=edit&id==<?=$data['id_mhs']?>" class="btn btn-warning"> Edit </a>
                  <a href="index.php?hal=hapus&id==<?=$data['id_mhs']?>" 
                     onclick="return confirm('apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>
        <?php endwhile;?>
        </table>

      </div>
    </div>
    <!-- Akhir Card Tabel -->

</div>

<script type="text/javascript" src="js/bootstrap.mi n.js"></script>
</body>
</html>