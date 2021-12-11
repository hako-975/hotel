<?php 
	require_once 'koneksi.php';

	$id_jenis_kamar = $_GET['id_jenis_kamar'];
	$hapusJenisKamar = mysqli_query($koneksi, "DELETE FROM jenis_kamar WHERE id_jenis_kamar = '$id_jenis_kamar'");

	if ($hapusJenisKamar) 
	{
		echo "
        <script>
          alert('Jenis kamar berhasil dihapus!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}
	else
	{
		echo "
        <script>
          alert('Jenis kamar gagal dihapus!')
          window.location.href = 'jenis_kamar.php';
        </script>
        ";
	}

 ?>