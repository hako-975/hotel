<?php 
	require_once 'koneksi.php';

  // jika sudah login pindahkan ke index admin
  if (isset($_SESSION['id_user'])) 
  {
    header("Location: index_admin.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include css -->
    <?php include_once 'include/css.php'; ?>

    <title>Covid 19</title>
  </head>
  <body>
    <!-- include navbar -->
    <?php include_once 'include/navbar.php'; ?>
    
    <div class="container">
    	<div class="row my-4">
  		  <div class="col bg-danger p-5 rounded">
  		    <iframe src="https://public.domo.com/cards/bWxVg" width="100%" height="600" marginheight="0" marginwidth="0" frameborder="0"></iframe>
  		  </div>
  		</div>
    </div>

    <!-- include footer -->
    <?php include_once 'include/footer.php'; ?>
    
    <!-- include js -->
    <?php include_once 'include/js.php'; ?>
  </body>
</html>
