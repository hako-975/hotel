<?php 
	require_once 'koneksi.php';

	session_destroy();
	header("Location: login_admin.php");
	exit;
 ?>