<?php 
	require_once 'koneksi.php';

	$id_jenis_kamar = $_GET['id_jenis_kamar'];
	$nonaktifJenisKamar = mysqli_query($koneksi, "UPDATE jenis_kamar SET is_active_jenis_kamar = '0' WHERE id_jenis_kamar = '$id_jenis_kamar'");

	if ($nonaktifJenisKamar) 
	{
		echo "
        <script>
          alert('Jenis Kamar berhasil di nonaktifkan!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Jenis Kamar gagal di nonaktifkan!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}

 ?>