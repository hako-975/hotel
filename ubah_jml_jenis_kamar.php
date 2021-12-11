<?php 
  require_once 'koneksi.php';

  // jika belum login pindahkan ke login admin
  if (!isset($_SESSION['id_user'])) 
  {
    header("Location: login_admin.php");
    exit;
  }

  $id_user = $_SESSION['id_user'];
  $dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

  $id_jenis_kamar = $_GET['id_jenis_kamar'];
  $data_jenis_kamar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jenis_kamar WHERE id_jenis_kamar = '$id_jenis_kamar'"));

  if (isset($_POST['btnUbahJumlahJenisKamar'])) 
  {
    $jml_jenis_kamar = htmlspecialchars($_POST['jml_jenis_kamar']);

    $ubahJenisKamar = mysqli_query($koneksi, "UPDATE jenis_kamar SET jml_jenis_kamar = '$jml_jenis_kamar' WHERE id_jenis_kamar = '$id_jenis_kamar'");
    
    if ($ubahJenisKamar) 
    {
      echo "
        <script>
          alert('Data berhasil diubah!')
          window.location.href = 'jenis_kamar.php';
        </script>
      ";
      exit;
    }
    else
    {
      echo "
        <script>
          alert('Data gagal diubah!')
          window.location.href = 'jenis_kamar.php';
        </script>
      ";  
      exit;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Ubah Jumlah Jenis Kamar</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar_admin.php'; ?>
    
    
    <div class="container">
      <div class="row my-2">
        <div class="col">
          <h1>Ubah Jumlah Jenis Kamar</h1>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-6">
         <form method="post" enctype="multipart/form-data">
           <div class="mb-3">
            <label for="jenis_kamar" class="form-label">Jenis Kamar</label>
            <input style="cursor: not-allowed;" disabled type="text" class="form-control" id="jenis_kamar" required name="jenis_kamar" value="<?= $data_jenis_kamar['jenis_kamar']; ?>">
          </div>
          <div class="mb-3">
            <label for="jml_jenis_kamar" class="form-label">Jumlah Jenis Kamar</label>
            <input type="number" class="form-control" id="jml_jenis_kamar" required name="jml_jenis_kamar" value="<?= $data_jenis_kamar['jml_jenis_kamar']; ?>">
          </div>
          <button type="submit" name="btnUbahJumlahJenisKamar" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Ubah</button>
         </form>
        </div>
      </div>
    </div>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>