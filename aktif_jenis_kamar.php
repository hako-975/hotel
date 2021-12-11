<?php 
	require_once 'koneksi.php';

	$id_jenis_kamar = $_GET['id_jenis_kamar'];
	$aktifJenisKamar = mysqli_query($koneksi, "UPDATE jenis_kamar SET is_active_jenis_kamar = '1' WHERE id_jenis_kamar = '$id_jenis_kamar'");

	if ($aktifJenisKamar) 
	{
		echo "
        <script>
          alert('Jenis kamar berhasil di aktifkan!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Jenis kamar gagal di aktifkan!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}

 ?>