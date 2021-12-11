<?php 
	require_once 'koneksi.php';

  $id_pemesanan = $_GET['id_pemesanan'];
  $detail_pemesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN jenis_kamar ON pemesanan.id_jenis_kamar = jenis_kamar.id_jenis_kamar WHERE id_pemesanan = '$id_pemesanan'"));

  if ($detail_pemesanan == null) 
  {
    header("Location: index.php");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Detail Pemesanan - <?= $detail_pemesanan['nama_pemesanan']; ?></title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar.php'; ?>
    
  	<section>
      <div class="container">
        <div class="row justify-content-center bg-danger p-5 rounded text-light">
          <div class="col"> 
            <table>
            	<tr>
            		<th><h2>No. Kamar</h2></th>
            		<td><h2><?= $detail_pemesanan['no_kamar']; ?></h2></td>
            	</tr>
              <tr>
                <th>Nama Pemesan</th>
                <td>: <?= $detail_pemesanan['nama_pemesanan']; ?></td>
              </tr>
              <tr>
                <th>NIK</th>
                <td>: <?= $detail_pemesanan['nik']; ?></td>
              </tr>
              <tr>
                <th>Jenis kelamin</th>
                <td>: <?= $detail_pemesanan['jenis_kelamin']; ?></td>
              </tr>
              <tr>
                <th>Tipe Kamar</th>
                <td>: <?= $detail_pemesanan['jenis_kamar']; ?></td>
              </tr>
              <tr>
                <th>Durasi Penginapan</th>
                <td>: <?= $detail_pemesanan['durasi_menginap']; ?> Hari</td>
              </tr>
              <?php if ($detail_pemesanan['breakfast'] == '1'): ?>
                <tr>
                  <th>Breakfast</th>
                  <td>: Rp. <?= number_format('80000'); ?></td>
                </tr>
              <?php endif ?>
              <tr>
                <th>Diskon</th>
                <td>: 
                  <?php if ($detail_pemesanan['durasi_menginap'] > 3): ?>
                    10%
                  <?php else: ?>
                    0%
                  <?php endif ?>
                </td>
              </tr>
              <tr>
                <th><h5>Total Pembayaran</h5></th>
                <td><h5>: Rp. <?= number_format($detail_pemesanan['total_pembayaran']); ?></h5></td>
              </tr>
            </table>
          </div>
        </div>
      </div> 
    </section>
    <section>
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col">
            <h4>Foto Kamar</h4>
            <?php if ($detail_pemesanan['foto_jenis_kamar']): ?>
              <img height="400" src="assets/img/img_jenis_kamar/<?= $detail_pemesanan['foto_jenis_kamar']; ?>" alt="<?= $detail_pemesanan['foto_jenis_kamar']; ?>">
            <?php else: ?>
              <p class="text-muted text-center">Tidak ada gambar.</p>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col">
            <h4>Video Kamar</h4>
            <?php if ($detail_pemesanan['video_jenis_kamar']): ?>
              <video src="assets/video/video_jenis_kamar/<?= $detail_pemesanan['video_jenis_kamar']; ?>" controls>
                <source src="movie.mp4" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
              Your browser does not support the video tag.
              </video>
            <?php else: ?>
              <p class="text-muted text-center">Tidak ada video.</p>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>

  
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>