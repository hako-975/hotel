<?php 
	require_once 'koneksi.php';

	$id_pemesanan = $_GET['id_pemesanan'];
	$nonaktifPemesanan = mysqli_query($koneksi, "UPDATE pemesanan SET is_active_pemesanan = '0' WHERE id_pemesanan = '$id_pemesanan'");

	if ($nonaktifPemesanan) 
	{
		echo "
        <script>
          alert('Pemesanan berhasil di nonaktifkan!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Pemesanan gagal di nonaktifkan!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}

 ?>