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

  if (isset($_POST['btnUbahJenisKamar'])) 
  {
    $jenis_kamar = htmlspecialchars($_POST['jenis_kamar']);
    $harga_jenis_kamar = htmlspecialchars($_POST['harga_jenis_kamar']);
    $jml_jenis_kamar = htmlspecialchars($_POST['jml_jenis_kamar']);
    
    $is_active_jenis_kamar = 0;

    if (isset($_POST['is_active_jenis_kamar'])) 
    {
      $is_active_jenis_kamar = $_POST['is_active_jenis_kamar'];

      if ($is_active_jenis_kamar == "on") {
        $is_active_jenis_kamar = 1;
      }
      else 
      {
        $is_active_jenis_kamar = 0;
      }
    }


    // is uploaded file    
    if (file_exists($_FILES['foto_jenis_kamar']['tmp_name']) || is_uploaded_file($_FILES['foto_jenis_kamar']['tmp_name'])) 
    {
    
      // img
      $foto_path = $_FILES['foto_jenis_kamar']['tmp_name'];
      $foto_jenis_kamar = time() . $_FILES['foto_jenis_kamar']['name'];
      $foto_size = $_FILES['foto_jenis_kamar']['size'];
      $foto_type = $_FILES['foto_jenis_kamar']['type'];
      $foto_folder = "assets/img/img_jenis_kamar/" . $foto_jenis_kamar;

      // check file error
      if ($_FILES['foto_jenis_kamar']['error'] || !is_uploaded_file($foto_path)) 
      {
        echo $_FILES['foto_jenis_kamar']['error'];
        return false;
      }

      // check file extension
      if (!in_array($foto_type, array('image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg'))) {
        echo "
          <script>
            alert('Ekstensi file foto harus jpg / png!')
            history.back();
          </script>
        ";
        return false;
      }

        // check file size.
      if ($foto_size > 10240000) {
        echo "File harus lebih kecil dari 10 MB.";
        return false;
      }

      // upload file contents
      move_uploaded_file($foto_path, $foto_folder);
    }
    else
    {
      $foto_jenis_kamar = $data_jenis_kamar['foto_jenis_kamar'];
    }

    if (file_exists($_FILES['video_jenis_kamar']['tmp_name']) || is_uploaded_file($_FILES['video_jenis_kamar']['tmp_name'])) 
    {
    
      // img
      $video_path = $_FILES['video_jenis_kamar']['tmp_name'];
      $video_jenis_kamar = time() . $_FILES['video_jenis_kamar']['name'];
      $video_size = $_FILES['video_jenis_kamar']['size'];
      $video_type = $_FILES['video_jenis_kamar']['type'];
      $video_folder = "assets/video/video_jenis_kamar/" . $video_jenis_kamar;

      // check file error
      if ($_FILES['video_jenis_kamar']['error'] || !is_uploaded_file($video_path)) 
      {
        echo $_FILES['video_jenis_kamar']['error'];
        return false;
      }

      // check file extension
      if (!in_array($video_type, array('video/mov', 'video/mp4', 'video/3gp', 'video/ogg'))) {
        echo "
          <script>
            alert('Ekstensi file video harus mp4!')
            history.back();
          </script>
        ";
        return false;
      }

        // check file size.
      if ($video_size > 25600000) {
        echo "
        <script>
          alert('File harus lebih kecil dari 25 MB!')
          history.back();
        </script>
        ";
        return false;
      }

      // upload file contents
      move_uploaded_file($video_path, $video_folder);
    }
    else
    {
      $video_jenis_kamar = $data_jenis_kamar['video_jenis_kamar'];
    }

    $ubahJenisKamar = mysqli_query($koneksi, "UPDATE jenis_kamar SET jenis_kamar = '$jenis_kamar', harga_jenis_kamar = '$harga_jenis_kamar', jml_jenis_kamar = '$jml_jenis_kamar', foto_jenis_kamar = '$foto_jenis_kamar', video_jenis_kamar = '$video_jenis_kamar', is_active_jenis_kamar = '$is_active_jenis_kamar' WHERE id_jenis_kamar = '$id_jenis_kamar'");
    
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

    <title>Ubah Jenis Kamar</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar_admin.php'; ?>
    
    
    <div class="container">
      <div class="row my-2">
        <div class="col">
          <h1>Ubah Jenis Kamar</h1>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-6">
         <form method="post" enctype="multipart/form-data">
           <div class="mb-3">
            <label for="jenis_kamar" class="form-label">Jenis Kamar</label>
            <input type="text" class="form-control" id="jenis_kamar" required name="jenis_kamar" value="<?= $data_jenis_kamar['jenis_kamar']; ?>">
          </div>
          <div class="mb-3">
            <label for="harga_jenis_kamar" class="form-label">Harga Jenis Kamar</label>
            <input type="number" class="form-control" id="harga_jenis_kamar" required name="harga_jenis_kamar" value="<?= $data_jenis_kamar['harga_jenis_kamar']; ?>">
          </div>
          <div class="mb-3">
            <label for="jml_jenis_kamar" class="form-label">Jumlah Jenis Kamar</label>
            <input type="number" class="form-control" id="jml_jenis_kamar" required name="jml_jenis_kamar" value="<?= $data_jenis_kamar['jml_jenis_kamar']; ?>">
          </div>
          <div class="mb-3">
            <label for="foto_jenis_kamar" class="form-label">Foto Jenis Kamar</label>
            <input class="form-control" type="file" id="foto_jenis_kamar" name="foto_jenis_kamar">
            <small class="text-success">(Optional) kosongkan jika tidak ingin mengubah Foto.</small>
          </div>
          <div class="mb-3">
            <label for="video_jenis_kamar" class="form-label">Video Jenis Kamar</label>
            <input class="form-control" type="file" id="video_jenis_kamar" name="video_jenis_kamar">
            <small class="text-success">(Optional) kosongkan jika tidak ingin mengubah Video.</small>
          </div>
          <div class="mb-3 form-check">
            <?php if ($data_jenis_kamar['is_active_jenis_kamar'] == '1'): ?>
              <input type="checkbox" checked class="form-check-input" id="is_active_jenis_kamar" name="is_active_jenis_kamar">
            <?php else: ?>
              <input type="checkbox" class="form-check-input" id="is_active_jenis_kamar" name="is_active_jenis_kamar">
            <?php endif ?>
            <label class="form-check-label" for="is_active_jenis_kamar">Aktif?</label>
          </div>
          <button type="submit" name="btnUbahJenisKamar" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Ubah</button>
         </form>
        </div>
      </div>
    </div>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>