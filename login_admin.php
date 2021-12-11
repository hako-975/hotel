<?php 
	require_once 'koneksi.php';

	// jika sudah login pindahkan ke index admin
	if (isset($_SESSION['id_user'])) 
	{
		header("Location: index_admin.php");
		exit;
	}

	if (isset($_POST['loginAdmin'])) 
	{
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		// check username
		if ($dataUser = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'"))) 
		{
			// check password
			if (password_verify($password, $dataUser['password'])) 
			{
				$_SESSION['id_user'] = $dataUser['id_user'];
				header("Location: index.php");
				exit;
			}
			else
			{
				echo "password salah";
				exit;
			}
		}
		else
		{
			echo "username salah";
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- include css -->
	<?php include_once 'include/css.php'; ?>

	<title>Login Admin</title>
</head>
<body>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 bg-danger rounded p-5 text-light">
				<h3>Login Admin</h3>
				<form method="post">
					<div class="mb-3">
					    <label for="username" class="form-label">Username</label>
					    <input type="text" class="form-control" id="username" name="username">
				  	</div>
					<div class="mb-3">
					    <label for="password" class="form-label">Password</label>
					    <input type="password" class="form-control" id="password" name="password">
					</div>
					<button type="submit" name="loginAdmin" class="btn btn-primary">Submit</button>
					<br><br>
					<a href="index.php" class="text-light">Kembali ke beranda</a>
				</form>
			</div>
		</div>
	</div>
	
	<!-- include js -->
	<?php include_once 'include/js.php'; ?>
</body>
</html>
