<?php

class BookDetailsView
{
    private $ctsach;


    public function __construct($ctsach)
    {
        $this->ctsach = $ctsach;

    }

    public function displayBookDetails()
    {
        foreach ($this->ctsach as $key => $value) {
            $id = $value['id'];
            $hinhanh = $value['hinhanh'];
            $ten = $value['ten'];
            $tacgia = $value['tacgia'];
            $namxb = $value['namxb'];
            $theloai = $value['tentl'];
            $gioithieu = $value['gioithieu'];

            $this->displayPage($id, $hinhanh, $ten, $tacgia, $namxb, $theloai);
            $this->displayIntroduction($ten, $gioithieu);
        }
    }

    private function displayPage($id, $hinhanh, $ten, $tacgia, $namxb, $theloai)
    {
        ?>
        <div class="container bg-warning-subtle">
            <div class="row">
                <div class="col-md-5 col-7">
                    <img class="img-fluid" src="<?php echo $hinhanh; ?>" alt="Book Image">
                </div>
                <div class="col-md-7 col-7">
                    <h1><?php echo $ten; ?></h1>
                    <p>Tác Giả: <?php echo $tacgia; ?></p>
                    <p>Năm xuất bản: <?php echo $namxb; ?></p>
                    <p>Thể Loại: <a href="index.php?page=theloai&id=<?php echo $theloai; ?>"><?php echo $theloai; ?></a></p>
                    
                    <div class="d-flex">
                        <div class="mt-3">
                            <a href="index.php?page=sach&id=<?php echo $id; ?>&read" class="btn btn-primary">Chi tiết</a>
                        </div>
                        <?php
                        if (!isset($_SESSION['user'])) {
                            echo '<div class="mx-3 my-3"><p style=" line-height:2 ">Vui lòng <a style="color:red" href="admin/login.php">đăng nhập</a> để thuê sách</p></div>';
                        } else {
                            echo '<div class="mx-3 my-3">
                                    <a href="index.php?page=thuesach&id=' . $id . '" class="btn btn-success">Thuê sách</a>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayIntroduction($ten, $gioithieu)
    {
        ?>
        <div class="container mt-5">
            <h1><?php echo $ten; ?></h1>
            <p><?php echo $gioithieu; ?></p>
        </div>
        <?php
    }
}

// Main code
require_once("conn.php");
require_once("func.php");

$bookDetailsView = new BookDetailsView($ctsach);
$bookDetailsView->displayBookDetails();
?>
