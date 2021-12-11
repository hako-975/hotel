<?php 
	require_once 'koneksi.php';

  // jika sudah login pindahkan ke index admin
  if (isset($_SESSION['id_user'])) 
  {
    header("Location: index_admin.php");
    exit;
  }

  $jenis_kamar = mysqli_query($koneksi, "SELECT * FROM jenis_kamar ORDER BY harga_jenis_kamar ASC");
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Hotel</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar.php'; ?>
    
  	<section>
      <div class="container bg-danger justify-content-center my-5 p-5 rounded">
        <div class="row my-2">
          <div class="col text-light text-center">
            <h3><i class="fas fa-fw fa-tags"></i> Daftar Harga</h3>
          </div>
        </div>
        <div class="row my-2 justify-content-center text-center">
          <?php foreach ($jenis_kamar as $djk): ?>
            <div class="col-sm-4 my-2">
              <ul class="list-group">
                <li class="list-group-item active" aria-current="true"><h5 class="my-auto"><?= $djk['jenis_kamar']; ?></h5></li>
                <li class="list-group-item"><img class="img-fluid" src="assets/img/img_jenis_kamar/<?= $djk['foto_jenis_kamar']; ?>" alt="1.jpg"></li>
                <li class="list-group-item">Rp. <?= number_format($djk['harga_jenis_kamar']); ?></li>
              </ul>
            </div>
          <?php endforeach ?>
        </div>
      </div> 
    </section>
    
    <!-- include footer -->
    <?php include_once 'include/footer.php'; ?>

    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>