<?php
use LDAP\Result;
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dang Nhap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="user">Username:</label>
                                <input type="text" class="form-control" name="user" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" class="form-control" name="pass" required>
                            </div>
                            <div class="form-group">
                                <label for="cfpass">Confirm Password:</label>
                                <input type="password" class="form-control" name="cfpass" required>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary" name="signup" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (add these scripts at the end of the body for better performance) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>

<?php
include("../conn.php");
include("admin_funs.php");

if (isset($_POST['signup'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $cfpass = $_POST['cfpass'];
if($pass==$cfpass){
    // Sử dụng giá trị idtk mới trong câu lệnh INSERT
    $sqli2 = "INSERT INTO taikhoan (tentk, pass, quyen) 
        VALUES ('" . $user . "', '" . $pass . "', 0);";
    $req2 = setsql($conn, $sqli2);
    header('Location: login.php');}
    else{
        echo "<script>
                alert('Mật khẩu nhập không đúng');
            </script>";}
}
?>
