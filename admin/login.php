<?php
   if (!isset($_SESSION)) 
   { 
   	 session_start();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Login</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="user">Username:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>


<?php

include ("../conn.php");
include ("admin_funs.php");

if (isset($_POST['login'])) 
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$sqli = "SELECT * 
			 FROM taikhoan t
			 WHERE t.tentk = '".$user."' AND t.pass = '".$pass."';";
	
	$re = getsql($conn, $sqli);
	
	foreach ($re as $key => $value) 
	{
		$level = $value['quyen'];
		$idtk = $value['idtk'];
	}

	if (!empty($re)) 
	{
		$_SESSION['user'] = $user;
		$_SESSION['quyen'] = $level;
		$_SESSION['idtk'] = $idtk;


		header('Location: admin.php');
	}
    else {
		echo "<script>
				alert('Sai mật khẩu hoặc tên tài khoản!!!');
			</script>";
    }
}

?>