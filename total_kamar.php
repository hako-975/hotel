<?php
require_once 'koneksi.php';

// jika belum login pindahkan ke login admin
if (!isset($_SESSION['id_user'])) {
	header("Location: login_admin.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$jenis_kamar = mysqli_query($koneksi, "SELECT * FROM jenis_kamar ORDER BY jenis_kamar ASC");
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

	<title>Total Kamar</title>
</head>

<body>
	<!-- include navbar -->
	<?php include_once 'include/navbar_admin.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col">
				<h3>Total Kamar: <?= number_format($total_kamar); ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Jenis Kamar</th>
								<th>Jumlah Kamar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($jenis_kamar as $djk): ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $djk['jenis_kamar']; ?></td>
									<td><?= $djk['jml_jenis_kamar']; ?></td>
									<td><a href="ubah_jml_jenis_kamar.php?id_jenis_kamar=<?= $djk['id_jenis_kamar']; ?>" class="btn btn-sm btn-warning m-1">Ubah</a></td>
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