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

  $jenis_kamar = mysqli_query($koneksi, "SELECT * FROM jenis_kamar ORDER BY jenis_kamar ASC");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Jenis Kamar</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar_admin.php'; ?>
    
    
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col">
          <h3>Daftar Jenis Kamar</h3>
        </div>
        <div class="col text-end">
          <a href="tambah_jenis_kamar.php" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Jenis Kamar</a>  
        </div>
      </div>
      <div class="row my-2">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center" id="table_id">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Jenis Kamar</th>
                  <th>Harga Jenis Kamar</th>
                  <th>Foto Jenis Kamar</th>
                  <th>Video Jenis Kamar</th>
                  <th>Jumlah Jenis Kamar</th>
                  <th>Aktif</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($jenis_kamar as $djk): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $djk['jenis_kamar']; ?></td>
                    <td>Rp. <?= number_format($djk['harga_jenis_kamar']); ?></td>
                    <td>
                      <?php if ($djk['foto_jenis_kamar']): ?>
                        <img height="100" src="assets/img/img_jenis_kamar/<?= $djk['foto_jenis_kamar']; ?>" alt="<?= $djk['foto_jenis_kamar']; ?>">
                      <?php else: ?>
                        <p class="text-muted text-center">Tidak ada gambar.</p>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($djk['video_jenis_kamar']): ?>
                        <video height="100" src="assets/video/video_jenis_kamar/<?= $djk['video_jenis_kamar']; ?>" controls>
                          <source src="movie.mp4" type="video/mp4">
                          <source src="movie.ogg" type="video/ogg">
                          Your browser does not support the video tag.
                        </video>
                      <?php else: ?>
                        <p class="text-muted text-center">Tidak ada video.</p>
                      <?php endif ?>
                    </td>
                    <td><?= $djk['jml_jenis_kamar']; ?></td>
                    <td>
                      <?php if ($djk['is_active_jenis_kamar'] == '1'): ?>
                        <button class="btn btn-sm btn-success"><i class="fas fa-fw fa-check"></i> Aktif</button>
                      <?php else: ?>
                        <a href="aktif_jenis_kamar.php?id_jenis_kamar=<?= $djk['id_jenis_kamar']; ?>" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan jenis kamar <?= $djk['jenis_kamar']; ?>?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-ban"></i> Tidak Aktif</a>
                      <?php endif ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning m-1" href="ubah_jenis_kamar.php?id_jenis_kamar=<?= $djk['id_jenis_kamar']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                      <?php if ($djk['is_active_jenis_kamar'] == '1'): ?>
                        <a class="btn btn-sm btn-danger m-1" href="nonaktif_jenis_kamar.php?id_jenis_kamar=<?= $djk['id_jenis_kamar']; ?>" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan jenis kamar <?= $djk['jenis_kamar']; ?>?')"><i class="fas fa-fw fa-ban"></i> Nonaktifkan</a>
                      <?php else: ?>
                        <a class="btn btn-sm btn-dark m-1" href="hapus_jenis_kamar.php?id_jenis_kamar=<?= $djk['id_jenis_kamar']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus jenis kamar <?= $djk['jenis_kamar']; ?>?')"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody> 
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>