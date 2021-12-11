<?php 
  require_once 'koneksi.php';

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

    if ($breakfast == '1') 
    {
      $hargaBreakfast = 80000 * $durasi_menginap;
      $total_pembayaran += $hargaBreakfast;
    }
    

    $is_active_pemesanan = 1;

    if ($getPembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY no_kamar DESC"))) 
    {
      $lengthKamar = $getJenisKamar['jml_jenis_kamar'];
      $no_kamar = $getPembayaran['no_kamar'] + 1;
    }

    $tambahPemesanan = mysqli_query($koneksi, "INSERT INTO pemesanan VALUES ('', '$nama_pemesanan', '$jenis_kelamin', '$nik', '$id_jenis_kamar', '$tgl_pemesanan', '$durasi_menginap', '$breakfast', '$total_pembayaran', '$no_kamar', '$is_active_pemesanan')");

    $id_pemesanan = mysqli_insert_id($koneksi);
    
    if ($tambahPemesanan) 
    {
      echo "
        <script>
          alert('Data berhasil ditambahkan!')
          window.location.href = 'detail_pemesanan.php?id_pemesanan=$id_pemesanan';
        </script>
      ";
      exit;
    }
    else
    {
      echo "
        <script>
          alert('Data gagal ditambahkan!')
          window.location.href = 'pesan_kamar.php';
        </script>
      ";  
      exit;
    }
  }

  if (isset($_POST['btnCekHarga'])) 
  {
    $no_kamar = 1;
    $diskon = 0;
    $diskonHarga = 0;
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
      $diskonHarga = ($harga * $diskon / 100);
      $total_pembayaran = $harga - $diskonHarga;
    }
    else
    {
      $total_pembayaran = $harga;
    }

    if ($breakfast == '1') 
    {
      $hargaBreakfast = 80000 * $durasi_menginap;
      $total_pembayaran += $hargaBreakfast;
    }
    

    $is_active_pemesanan = 1;

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
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Pesan Kamar</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar.php'; ?>
    
    
    <div class="container my-4">
      <div class="row">
        <div class="col-lg-6 border border-dark p-3 rounded">
         <h3><i class="fas fa-fw fa-concierge-bell"></i> Pesan Kamar</h3>
         <form method="post" enctype="multipart/form-data" name="pesan_kamar" onsubmit="return validateForm()">
           <div class="mb-3">
            <label for="nama_pemesanan" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama_pemesanan" name="nama_pemesanan" value="<?= (isset($nama_pemesanan)) ? $nama_pemesanan : ''; ?>">
          </div>
          <?php if (isset($jenis_kelamin)): ?>
            <div class="mb-3">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <div class="form-check">
                <?php if ($jenis_kelamin == 'pria'): ?>
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria" id="jenis_kelamin1" checked>
                <?php else: ?>
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria" id="jenis_kelamin1">
                <?php endif ?>
                <label class="form-check-label" for="jenis_kelamin1">
                  Pria
                </label>
              </div>
              <div class="form-check">
                <?php if ($jenis_kelamin == 'wanita'): ?>
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="jenis_kelamin2" checked>
                <?php else: ?>
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="jenis_kelamin2">
                <?php endif ?>
                <label class="form-check-label" for="jenis_kelamin2">
                  Wanita
                </label>
              </div>
            </div>
          <?php else: ?>
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
          <?php endif ?>

          <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" class="form-control" id="nik" name="nik" min="1" value="<?= (isset($nik)) ? $nik : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="id_jenis_kamar" class="form-label">Jenis Kamar</label>
            <select class="form-select" id="id_jenis_kamar" name="id_jenis_kamar">
              <?php if (isset($id_jenis_kamar)): ?>
                <option value="<?= $id_jenis_kamar; ?>"><?= $getJenisKamar['jenis_kamar']; ?> | Harga Rp. <?= number_format($getJenisKamar['harga_jenis_kamar']); ?></option>
              <?php endif ?>
              <?php foreach ($jenis_kamar as $djk): ?>
                <?php if ($djk['is_active_jenis_kamar'] == '1'): ?>
                  <option value="<?= $djk['id_jenis_kamar']; ?>"><?= $djk['jenis_kamar']; ?> | Harga Rp. <?= number_format($djk['harga_jenis_kamar']); ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="durasi_menginap" class="form-label">Durasi Menginap</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="durasi_menginap">Hari</span>
              <input type="number" class="form-control" name="durasi_menginap" min="1" value="<?= (isset($durasi_menginap)) ? $durasi_menginap : ''; ?>">
            </div>
          </div>
          <div class="mb-3 form-check">
            <?php if (isset($breakfast)): ?>
              <?php if ($breakfast == '1'): ?>
                <input type="checkbox" checked class="form-check-input" id="breakfast" name="breakfast">
              <?php else: ?>
                <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast">
              <?php endif ?>
            <?php else: ?>
                <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast">
            <?php endif ?>
            <label class="form-check-label" for="breakfast">Breakfast?</label>
          </div>
          <?php if (isset($_POST['btnCekHarga'])): ?>
            <div class="mb-3">
              <label class="form-label">Total Harga Menginap</label>
              <input style="cursor: not-allowed;" disabled class="form-control" type="text" value="Rp. <?= number_format($harga); ?>">
            </div>
            <?php if (isset($breakfast)): ?>
              <?php if ($breakfast == '1'): ?>
                <div class="mb-3">
                  <label class="form-label">Breakfast</label>
                  <input style="cursor: not-allowed;" disabled class="form-control" type="text" value="Rp. <?= number_format($hargaBreakfast); ?>">
                </div>
              <?php endif ?>
            <?php endif ?>
            <div class="row mb-3">
              <div class="col-lg">
                <label class="form-label">Diskon</label>
                <input style="cursor: not-allowed;" disabled type="text" class="form-control" value="<?= $diskon; ?> %">
              </div>
              <div class="col-lg">
                <label class="form-label">Total Diskon</label>
                <input style="cursor: not-allowed;" disabled type="text" class="form-control" value="Rp. -<?= number_format($diskonHarga); ?>">
              </div>
            </div>
            <div class="mb-3">
              <h4>Total Harga</h4>
              <input style="cursor: not-allowed;" disabled class="form-control" type="text" value="Rp. <?= number_format($total_pembayaran); ?>">
            </div>
          <?php endif ?>
          <div class="row">
            <div class="col">
              <button type="submit" name="btnCekHarga" class="btn btn-success"><i class="fas fa-fw fa-money-bill-wave"></i> Cek Harga</button>
            </div>
            <div class="col text-end">
              <button type="submit" name="btnTambahPemesanan" class="btn btn-primary text-end"><i class="fas fa-fw fa-paper-plane"></i> Pesan</button>
            </div>
          </div>
         </form>
        </div>
      </div>
    </div>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
    <script>
      function validateForm() 
      {
        if (document.forms["pesan_kamar"]["nama_pemesanan"].value == '') 
        {
          alert("Nama Pemesan harus diisi!");
          document.forms["pesan_kamar"]["nama_pemesanan"].focus();
          return false;
        }
        
        if (document.forms["pesan_kamar"]["nik"].value == '') 
        {
          alert("NIK harus diisi!");
          document.forms["pesan_kamar"]["nik"].focus();
          return false;
        }

        if (document.forms["pesan_kamar"]["nik"].value.length < 16) {
          alert("NIK harus 16 digit!");
          document.forms["pesan_kamar"]["nik"].focus();
          return false;
        }

        if (document.forms["pesan_kamar"]["durasi_menginap"].value == '') 
        {
          alert("Durasi Menginap harus diisi!");
          document.forms["pesan_kamar"]["durasi_menginap"].focus();
          return false;
        }

      }
    </script>
  </body>
</html>