<?php

class BookEditor
{
    private $conn;
    private $message;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->message = '';
    }

    public function editBook($id)
    {
        if (isset($_POST['edit'])) {
            $ten = trim($_POST['name']);
            $tacgia = trim($_POST['tacgia']);
            $namxb = trim($_POST['namxb']);
            $theloai = trim($_POST['theloai']);
            $gioithieu = trim($_POST['gioithieu']);
            $noidung = trim($_POST['noidung']);
            $hinhanh = trim($_POST['hinhanh']);

            if (empty($ten) || empty($tacgia) || empty($namxb) || empty($theloai) || empty($gioithieu) || empty($noidung) || empty($hinhanh)) {
                $this->message = 'Vui lòng điền đầy đủ thông tin.';
            } else {
                if ($this->categoryExists($theloai)) {
                    $sql = "UPDATE sach SET ten = '$ten', hinhanh = '$hinhanh', noidung = '$noidung', tentl = '$theloai', tacgia = '$tacgia', namxb = '$namxb', gioithieu = '$gioithieu' WHERE id = $id;";
                    $result = $this->setSql($sql);

                    if ($result) {
                        $this->message = 'Sửa thông tin sách thành công.';
                    } else {
                        $this->message = 'Đã xảy ra lỗi khi sửa thông tin sách.';
                    }
                } else {
                    $this->message = 'Thể loại không tồn tại.';
                }
            }
        }

        $sql = "SELECT * FROM sach WHERE id = $id;";
        $suasach = $this->getSql($sql);

        foreach ($suasach as $key1 => $value) {
            echo '<form class="sp" action="" method="POST">
                    <h3>Sửa Thông Tin Sách</h3>
                    <div class="content">
                        <div class="form-group">
                            <label>Tên Sách:</label>
                            <input type="text" class="form-control" name="name" value="'.$value['ten'].'">
                        </div>
                        <div class="form-group">
                            <label>Tác Giả:</label>
                            <input type="text" class="form-control" name="tacgia" value="'.$value['tacgia'].'">
                        </div>
                        <div class="form-group">
                            <label>Năm xuất bản:</label>
                            <input type="text" class="form-control" name="namxb" value="'.$value['namxb'].'">
                        </div>
                        <div class="form-group">
                            <label>Thể Loại:</label>
                            <input type="text" class="form-control" name="theloai" value="'.$value['tentl'].'">
                        </div>
                        <div class="form-group">
                            <label>Giới Thiệu:</label>
                            <textarea class="form-control" name="gioithieu" rows="4">'.$value['gioithieu'].'</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung:</label>
                            <textarea class="form-control" name="noidung" rows="4">'.$value['noidung'].'</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình Ảnh:</label>
                            <input type="text" class="form-control" name="hinhanh" value="'.$value['hinhanh'].'">
                        </div>
                        <div class="text-danger">'.$this->message.'</div>
                    </div><br>
                    <input type="submit" class="btn btn-primary" name="edit" value="Sửa">
                </form>';
        }
    }

    public function addBook()
    {
        if (isset($_POST['add'])) {
            $ten = trim($_POST['name']);
            $tacgia = trim($_POST['tacgia']);
            $namxb = trim($_POST['namxb']);
            $theloai = trim($_POST['theloai']);
            $gioithieu = trim($_POST['gioithieu']);
            $noidung = trim($_POST['noidung']);
            $hinhanh = trim($_POST['hinhanh']);

            if (empty($ten) || empty($tacgia) || empty($namxb) || empty($theloai) || empty($gioithieu) || empty($noidung) || empty($hinhanh)) {
                $this->message = 'Vui lòng điền đầy đủ thông tin.';
            } else {
                if ($this->categoryExists($theloai)) {
                    $sql = "INSERT INTO sach(ten, hinhanh, noidung, tentl, tacgia, namxb, gioithieu) VALUES ('$ten', '$hinhanh', '$noidung', '$theloai', '$tacgia', '$namxb', '$gioithieu');";
                    $result = $this->setSql($sql);

                    if ($result) {
                        $this->message = 'Thêm sách thành công.';
                    } else {
                        $this->message = 'Đã xảy ra lỗi khi thêm sách.';
                    }
                } else {
                    $this->message = 'Thể loại không tồn tại.';
                }
            }
        }

        echo '<form class="sp" action="" method="POST">
            <h3>Thêm Thông Tin Sách</h3>
            <div class="content">
                <div class="form-group">
                    <label>Tên Sách:</label>
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <label>Tác Giả:</label>
                    <input type="text" class="form-control" name="tacgia" value="">
                </div>
                <div class="form-group">
                    <label>Năm xuất bản:</label>
                    <input type="text" class="form-control" name="namxb" value="">
                </div>
                <div class="form-group">
                    <label>Thể Loại:</label>
                    <input type="text" class="form-control" name="theloai" value="">
                </div>
                <div class="form-group">
                    <label>Giới Thiệu:</label>
                    <textarea class="form-control" name="gioithieu" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Nội Dung:</label>
                    <textarea class="form-control" name="noidung" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Hình Ảnh:</label>
                    <input type="text" class="form-control" name="hinhanh" value="">
                </div>
                <div class="text-danger">'.$this->message.'</div>
            </div><br>
            <input type="submit" class="btn btn-success" name="add" value="Thêm">
        </form>';
    }

    private function setSql($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    private function getSql($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    private function categoryExists($categoryName)
    {
        $categoryName = mysqli_real_escape_string($this->conn, $categoryName);
        $sql = "SELECT * FROM theloai WHERE tentl = '$categoryName';";
        $result = $this->getSql($sql);

        return mysqli_num_rows($result) > 0;
    }
}

// Main code
require_once("../conn.php");

$bookEditor = new BookEditor($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bookEditor->editBook($id);
} else {
    $bookEditor->addBook();
}

?>
