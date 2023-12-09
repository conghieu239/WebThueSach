<?php
include("conn.php");
include("func.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Thư Viện</title>
</head>

<body style="background-color: white;">
    <div id="main">

        <div id="header">
            <?php include(views . "menu.php"); ?>
        </div><br>

        <div id="content ">
            <div id="line"></div>
            <div id="noidung1">
         <p>   Kết hợp những điều hiểu biết với những kinh nghiệm và kiến thức sẵn có - đó là nguyên tắc cần thiết khi lựa chọn sách.</p>
      </div>
        </div>

        <div id="container" class="container-fluid ">

            <div id="left" class="col-9 col-md-10">
                <?php
                if (isset($_GET['search'])) {
                    include(views . "timkiem.php");
                } else {
                    include(views . "left.php");
                }
                ?>
            </div>

            <?php
            if (!isset($_GET['read'])) {
                echo '<div id="right" class="col-3 col-md-2">';
                include(views . "right.php");
                echo '</div>';
            }
            ?>
        </div>

        <!-- Footer -->
        <br><br><br><br>
        <footer id="main-footer">
        <div class="container">
        <div id="introduction" class="row">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div id="footer-block" class="footer-col">
                    <h4 id="footer-title">Giới thiệu</h4>
                    <div id="footer-content">
                        <p>Khám phá thế giới văn hóa thông qua thư viện đa dạng của chúng tôi. Đặt sách ngay để tận hưởng niềm vui đọc mọi lúc, mọi nơi!</p>
                        <div id="logo-footer">
                            <img src="https://s3.amazonaws.com/cdn.freshdesk.com/data/helpdesk/attachments/production/42008041469/original/Mo9gDy2XMZLppkUw4sWCsYV-lk65HqqgQw.gif?1539077990" alt="Bộ Công Thương" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div id="footer-link" class="footer-col">
                    <h4 id="footer-title">PHÁP LÝ &amp; CÂU HỎI</h4>
                    <div id="toggle-footer" class="footer-content ">
                        <ul>
                            <li class="item"><a href="#" title="Tìm kiếm">Tìm kiếm</a></li>
                            <li class="item"><a href="#" title="Giới thiệu">Giới thiệu</a></li>
                            <li class="item"><a href="#" title="Chính sách đổi trả">Chính sách đổi trả</a></li>
                            <li class="item"><a href="#" title="Chính sách bảo mật">Chính sách bảo mật</a></li>
                            <li class="item"><a href="#" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div id="footer-block" class="footer-col">
                    <h4 id="footer-title">Thông tin liên hệ</h4>
                    <div id="toggle-footer" class="footer-content">
                        <ul>
                            <li><span><b>Address: </b></span> 143 Nguyen Thi Minh Khai, Distric 1, Ho Chi Minh City, Vietnam</li>
                            <li><span><b>Phone:</b></span> (+84) 964837465</li>
                            <li><span><b>Mail:</b></span> thuvien@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div id="footer-block" class="footer-col">
                    <h4 id="footer-title">FANPAGE</h4>
                    <div id="footer-content">
                        <div id="fb-root">
                            <div id="footer-static-content" class="footer-static-content">
                                <div class="fb-page"
                                    data-href="#"
                                    data-tabs="timeline"
                                    data-width="300"
                                    data-height="215"
                                    data-small-header="false"
                                    data-adapt-container-width="true"
                                    data-hide-cover="false"
                                    data-show-facepile="true">
                                    <blockquote cite="#" class="fb-xfbml-parse-ignore">
                                        <a href="#">Thuvien.com</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="main-footer--copyright" class="main-footer--copyright">
        <div class="container">
            <hr>
            <div id="main-footer--border" class="main-footer--border" style="text-align:center;padding-bottom: 15px;">
                <p>Copyright © 2019 <a href="#"> Code learn</a>. <a target="_blank" href="#">Powered by Nhom 2</a></p>
            </div>
        </div>
        </div>
        </footer>

        <!-- End Footer --> 

    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (order matters) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
