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
  $pemesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan INNER JOIN jenis_kamar ON pemesanan.id_jenis_kamar = jenis_kamar.id_jenis_kamar ORDER BY tgl_pemesanan DESC");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Pemesanan</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar_admin.php'; ?>
    
    
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1>Pemesanan</h1>
        </div>
        <div class="col text-end">
          <a href="tambah_pemesanan.php" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pemesanan</a>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center" id="table_id">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pemesan</th>
                  <th>Jenis Kelamin</th>
                  <th>NIK</th>
                  <th>Jenis Kamar</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Durasi Menginap</th>
                  <th>Total Pembayaran</th>
                  <th>No. Kamar</th>
                  <th>Breakfast</th>
                  <th>Aktif</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pemesanan as $dp): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $dp['nama_pemesanan']; ?></td>
                    <td><?= $dp['jenis_kelamin']; ?></td>
                    <td><?= $dp['nik']; ?></td>
                    <td><?= $dp['jenis_kamar']; ?></td>
                    <td><?= date("d-m-Y, H:i", $dp['tgl_pemesanan']); ?></td>
                    <td><?= $dp['durasi_menginap']; ?> Hari</td>
                    <td>Rp. <?= number_format($dp['total_pembayaran']); ?></td>
                    <td><?= $dp['no_kamar']; ?></td>
                    <td>
                      <?php if ($dp['breakfast'] == '1'): ?>
                        <button class="btn btn-sm btn-success"><i class="fas fa-fw fa-check"></i> Ya</button>
                      <?php else: ?>
                        <a href="aktif_breakfast.php?id_pemesanan=<?= $dp['id_pemesanan']; ?>" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan breakfast <?= $dp['nama_pemesanan']; ?>?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> Tidak</a>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($dp['is_active_pemesanan'] == '1'): ?>
                        <button class="btn btn-sm btn-success"><i class="fas fa-fw fa-check"></i> Aktif</button>
                      <?php else: ?>
                        <a href="aktif_pemesanan.php?id_pemesanan=<?= $dp['id_pemesanan']; ?>" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan pemesanan <?= $dp['nama_pemesanan']; ?>?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> Tidak Aktif</a>
                      <?php endif ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning m-1" href="ubah_pemesanan.php?id_pemesanan=<?= $dp['id_pemesanan']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                      <?php if ($dp['is_active_pemesanan'] == '1'): ?>
                        <a class="btn btn-sm btn-danger m-1" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan pemesanan <?= $dp['nama_pemesanan']; ?>?')" href="nonaktif_pemesanan.php?id_pemesanan=<?= $dp['id_pemesanan']; ?>"><i class="fas fa-fw fa-ban"></i> Nonaktifkan</a>
                      <?php else: ?>
                        <a class="btn btn-sm btn-dark m-1" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan <?= $dp['nama_pemesanan']; ?>?')" href="hapus_pemesanan.php?id_pemesanan=<?= $dp['id_pemesanan']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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