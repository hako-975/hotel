<?php 
	require_once 'koneksi.php';

	$id_pemesanan = $_GET['id_pemesanan'];
	$aktifPemesanan = mysqli_query($koneksi, "UPDATE pemesanan SET breakfast = '1' WHERE id_pemesanan = '$id_pemesanan'");

	if ($aktifPemesanan) 
	{
		echo "
        <script>
          alert('Pemesanan Breakfast berhasil di aktifkan!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Pemesanan Breakfast gagal di aktifkan!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}

 ?>