<?php 
	require_once 'koneksi.php';

	$id_pemesanan = $_GET['id_pemesanan'];
	$hapusPemesanan = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'");

	if ($hapusPemesanan) 
	{
		echo "
        <script>
          alert('Pemesanan berhasil dihapus!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Pemesanan gagal dihapus!')
          window.location.href = 'pemesanan.php';
        </script>
        ";
	}

 ?>