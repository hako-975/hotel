<?php
	session_start();
	// mengatur tanggal
	date_default_timezone_set('Asia/Jakarta');

	$host 		= "localhost";
	$username 	= "root";
	$password 	= "";
	$database 	= "hotel";

	$koneksi 	= mysqli_connect($host, $username, $password, $database);
