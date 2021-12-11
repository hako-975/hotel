<?php 
	require_once 'koneksi.php';

  // jika sudah login pindahkan ke index admin
  if (isset($_SESSION['id_user'])) 
  {
    header("Location: index_admin.php");
    exit;
  }
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
    
  	<section id="covid19">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 border border-danger p-4 rounded"> 
            <h4 class="text-danger fw-bold">Ingin jalan-jalan? Cek tempatnya dulu! Aman atau enggak?</h4>
            <a class="text-danger" href="covid19.php"><h4>Cek Status Covid-19 di sini</h4></a>
          </div>
        </div>
      </div> 
    </section>

    <section id="wisatawan">
      <div class="container">
        <div class="row">
          <div class="col">
            <h1>Selamat Datang, Wisatawan</h1>
            <p>Selamat Berlibur, hotel solusi cepat mencari hotel murah dan banyak diskon</p>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container my-2">
        <div class="row justify-content-center">
          <div class="col-lg my-3">
            <div class="card">
              <img src="assets/img/img_properties/1.jpg" class="card-img-top" alt="1.jpg">
              <div class="card-body">
                <h5 class="card-title">Kamar tipe Standar</h5>
                <p class="card-text">Tidur dengan sunyi tanpa gangguan suara</p>
                <a href="pesan_kamar.php" class="btn btn-primary">Pesan Sekarang!</a>
              </div>
            </div>
          </div>
          <div class="col-lg my-3">
            <div class="card">
              <img src="assets/img/img_properties/2.jpg" class="card-img-top" alt="2.jpg">
              <div class="card-body">
                <h5 class="card-title">Kamar tipe Deluxe</h5>
                <p class="card-text">Cocok buat pasangan yang baru menikah untuk bulan madu</p>
                <a href="pesan_kamar.php" class="btn btn-primary">Pesan Sekarang!</a>
              </div>
            </div>
          </div>
          <div class="col-lg my-3">
            <div class="card">
              <img src="assets/img/img_properties/3.jpg" class="card-img-top" alt="3.jpg">
              <div class="card-body">
                <h5 class="card-title">Kamar tipe Eksklusif</h5>
                <p class="card-text">Cocok untuk para eksekutif atau liburan keluarga</p>
                <a href="pesan_kamar.php" class="btn btn-primary">Pesan Sekarang!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- include footer -->
    <?php include_once 'include/footer.php'; ?>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>