<?php
$menu = theloai($conn);

if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container">
<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php">
      <img src="https://img.freepik.com/free-vector/hand-drawn-library-logo_23-2149331219.jpg" alt="Bootstrap" width="100" height="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thể loại
          </a>
          <ul class="dropdown-menu">
          <?php 
                    foreach ($menu as $key => $value) {
                        echo '<li><a class="dropdown-item" href="index.php?page=theloai&id='.$value['tentl'].'">'.$value['tentl'].'</a></li>';
                    }
                ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" > <?php
                                if (isset($_SESSION['user'])) {
                                    echo "Xin Chào: ".$_SESSION['user'];
                                }
                            ?></a>
        </li>
        
      </ul>
      <ul class="navbar-nav">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<li class="nav-item"><a class="nav-link active" href="index.php?page=sachdathue">Sách Đã Thuê</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="admin/out.php">Đăng Xuất</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active" href="admin/login.php">Đăng Nhập</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="admin/dangky.php">Đăng Ký</a></li>';
                    }
                ?>
            </ul>

            <form class="d-flex" role="search" action="" method="GET">
        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</div>
