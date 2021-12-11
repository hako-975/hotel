<?php
require_once 'koneksi.php';

// jika belum login pindahkan ke login admin
if (!isset($_SESSION['id_user'])) {
	header("Location: login_admin.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$jenis_kamar = mysqli_query($koneksi, "SELECT * FROM jenis_kamar");
$total_kamar = 0;

foreach ($jenis_kamar as $djk) 
{
	$total_kamar += $djk['jml_jenis_kamar'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- include css -->
	<?php include_once 'include/css.php'; ?>

	<title>Hotel | Admin</title>
</head>

<body>
	<!-- include navbar -->
	<?php include_once 'include/navbar_admin.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col">
				<h3>Selamat Datang, <?= $dataUser['nama_lengkap']; ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-3 fw-bold">Total Kamar</h4>
						<p class="card-text"><span class="bg-danger px-3 py-2 rounded text-light"><?= $total_kamar; ?></span></p>
						<a href="total_kamar.php" class="btn btn-primary"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- include js -->
	<?php include_once 'include/js.php'; ?>
</body>

</html>