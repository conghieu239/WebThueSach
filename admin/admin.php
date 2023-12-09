<?php 
include ("../conn.php");
include ("admin_funs.php");

if (!isset($_SESSION)) { 
    session_start();
}

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] < 1) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <title>ADMIN</title>
</head>
<body>

    

        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg text-white navbar-light bg-secondary fixed-top">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="admin.php">Trang Chủ</a>

                <!-- Navbar links -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav  mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="admin.php?pages=thanhvien">List Thành Viên</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSach" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sách
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownSach">
                                <a class="dropdown-item" href="admin.php?pages=sach">List Sách</a>
                                <a class="dropdown-item" href="admin.php?pages=themsach">Thêm Sách</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTheLoai" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thể Loại
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownTheLoai">
                                <a class="dropdown-item" href="admin.php?pages=theloai">List Thể Loại</a>
                                <a class="dropdown-item" href="admin.php?pages=themtl">Thêm Thể Loại</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDanhNgon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Danh Ngôn
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownDanhNgon">
                                <a class="dropdown-item" href="admin.php?pages=danhngon">List Danh Ngôn</a>
                                <a class="dropdown-item" href="admin.php?pages=themdn">Thêm Danh Ngôn</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php?pages=listthue">List Thuê Sách</a>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        <a class="comment mr-2">
                            <?php
                                if (isset($_SESSION['user'])) {
                                    echo "Xin Chào: ".$_SESSION['user'];
                                }
                            ?>
                        </a>
                        <a class="out text-warning" href="out.php">Thoát</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container ">
            <?php
                if (isset($_GET['pages'])) {
                    require(root.'admin/'.$_GET['pages'].'.php');
                }
            ?>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
