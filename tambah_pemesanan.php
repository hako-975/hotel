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

  $jenis_kamar = mysqli_query($koneksi, "SELECT * FROM jenis_kamar ORDER BY harga_jenis_kamar ASC");

  if (isset($_POST['btnTambahPemesanan'])) 
  {
    $no_kamar = 1;
    $diskon = 0;
    $total_pembayaran = 0;
    $nama_pemesanan = htmlspecialchars($_POST['nama_pemesanan']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $nik = htmlspecialchars($_POST['nik']);
    $id_jenis_kamar = htmlspecialchars($_POST['id_jenis_kamar']);
    $tgl_pemesanan = time();
    $durasi_menginap = htmlspecialchars($_POST['durasi_menginap']);
    
    if (isset($_POST['breakfast'])) 
    {
      if ($_POST['breakfast'] == "on") 
      {
        $breakfast = 1;
      }
      else
      {
        $breakfast = 0;
      }
    }
    else 
    {
      $breakfast = 0;
    }

    $getJenisKamar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jenis_kamar WHERE id_jenis_kamar = '$id_jenis_kamar'"));
    $harga = $getJenisKamar['harga_jenis_kamar'] * $durasi_menginap;
    
    if ($durasi_menginap > 3) 
    {
      $diskon = 10;
      $total_pembayaran = $harga - ($harga * $diskon / 100);
    }
    else
    {
      $total_pembayaran = $harga;
    }

    if ($breakfast == 1) 
    {
      $total_pembayaran += 80000;
    }
    

    if (isset($_POST['is_active_pemesanan'])) 
    {
      if ($_POST['is_active_pemesanan'] == "on") 
      {
        $is_active_pemesanan = 1;
      }
      else
      {
        $is_active_pemesanan = 0;
      }
    }
    else 
    {
      $is_active_pemesanan = 0;
    }

    if ($getPembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY no_kamar ASC"))) 
    {
      $lengthKamar = $getJenisKamar['jml_jenis_kamar'];
      for ($i = 1; $i <= $lengthKamar; $i++) 
      {
        // cek apakah kamar $i sudah diisi
        if ($getPembayaran['no_kamar'] != $i) 
        {
          $no_kamar = $i;
          break;
        } 
      }
    }

    $tambahPemesanan = mysqli_query($koneksi, "INSERT INTO pemesanan VALUES ('', '$nama_pemesanan', '$jenis_kelamin', '$nik', '$id_jenis_kamar', '$tgl_pemesanan', '$durasi_menginap', '$breakfast', '$total_pembayaran', '$no_kamar', '$is_active_pemesanan')");
    
    if ($tambahPemesanan) 
    {
      echo "
        <script>
          alert('Data berhasil ditambahkan!')
          window.location.href = 'pemesanan.php';
        </script>
      ";
      exit;
    }
    else
    {
      echo "
        <script>
          alert('Data gagal ditambahkan!')
          window.location.href = 'pemesanan.php';
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

    <title>Tambah Pemesanan</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar_admin.php'; ?>
    
    
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>Tambah Pemesanan</h1>
        </div>
      </div>
      <div class="row">
        <div class="col">
         <form method="post" enctype="multipart/form-data">
           <div class="mb-3">
            <label for="nama_pemesanan" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama_pemesanan" required name="nama_pemesanan">
          </div>
          <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria" id="jenis_kelamin1" checked>
              <label class="form-check-label" for="jenis_kelamin1">
                Pria
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="jenis_kelamin2">
              <label class="form-check-label" for="jenis_kelamin2">
                Wanita
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" class="form-control" id="nik" required name="nik">
          </div>
          <div class="mb-3">
            <label for="id_jenis_kamar" class="form-label">Jenis Kamar</label>
            <select class="form-select" id="id_jenis_kamar" name="id_jenis_kamar">
              <?php foreach ($jenis_kamar as $djk): ?>
                <?php if ($djk['is_active_jenis_kamar'] == '1'): ?>
                  <option value="<?= $djk['id_jenis_kamar']; ?>"><?= $djk['jenis_kamar']; ?> | Harga Rp. <?= $djk['harga_jenis_kamar']; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="durasi_menginap" class="form-label">Durasi Menginap</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="durasi_menginap">Hari</span>
              <input type="number" class="form-control" name="durasi_menginap" required>
            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" checked class="form-check-input" id="breakfast" name="breakfast">
            <label class="form-check-label" for="breakfast">Breakfast?</label>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" checked class="form-check-input" id="is_active_pemesanan" name="is_active_pemesanan">
            <label class="form-check-label" for="is_active_pemesanan">Aktif?</label>
          </div>
          <button type="submit" name="btnTambahPemesanan" class="btn btn-primary">Submit</button>
         </form>
        </div>
      </div>
    </div>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>