<?php

class CategoryEditor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function editCategory($id)
{
    $message = '';

    if (isset($_POST['add'])) {
        $tentl = trim($_POST['name']);

        if (empty($tentl)) {
            $message = 'Vui lòng nhập tên thể loại.';
        } else {
            $existingCategory = $this->getCategoryByName($tentl);
            if ($existingCategory) {
                $message = 'Thể loại đã tồn tại.';
            } else {
                $sql = "UPDATE theloai SET tentl='".$tentl."' WHERE tentl LIKE  '%".$id."%';";
                $theloai = $this->setSql($sql);
                if ($theloai) {
                    $message = 'Sửa thể loại thành công.';
                } else {
                    $message = 'Đã xảy ra lỗi khi sửa thể loại.';
                }
            }
        }
    }

    $sql = "SELECT * FROM theloai WHERE tentl LIKE  '%".$id."%';";
    $suatheloai = $this->getSql($sql);

    foreach ($suatheloai as $key => $value) {
        echo '<form class="nhom" action="" method="POST">
                <div class="mb-3">
                    <h2>Sửa Thông Tin Thể Loại</h2>
                    <label for="name" class="form-label">Tên Thể Loại:</label>
                    <input type="text" class="form-control" id="name" name="name" value="'.$value['tentl'].'">
                    <small class="text-danger">'.$message.'</small>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Sửa</button>
            </form>';
    }
}

public function addCategory()
{
    $message = '';

    if (isset($_POST['add'])) {
        $tentl = trim($_POST['name']);

        if (empty($tentl)) {
            $message = 'Vui lòng nhập tên thể loại.';
        } else {
            $existingCategory = $this->getCategoryByName($tentl);
            if ($existingCategory) {
                $message = 'Thể loại đã tồn tại.';
            } else {
                $sql = "INSERT INTO theloai(tentl) VALUES ('".$tentl."')";
                $theloai = $this->setSql($sql);
                if ($theloai) {
                    $message = 'Thêm thể loại thành công.';
                } else {
                    $message = 'Đã xảy ra lỗi khi thêm thể loại.';
                }
            }
        }
    }

    echo '<form class="nhom" action="" method="POST">
            <div class="mb-3">
                <h2>Thêm Thể Loại</h2>
                <label for="name" class="form-label">Tên Thể Loại:</label>
                <input type="text" class="form-control" id="name" name="name" value="">
                <small class="text-danger">'.$message.'</small>
            </div>
            <button type="submit" name="add" class="btn btn-success">Thêm</button>
        </form>';
}



    private function getCategoryByName($name)
    {
        $sql = "SELECT * FROM theloai WHERE tentl = '".$name."'";
        $result = $this->getSql($sql);
        return mysqli_fetch_assoc($result);
    }

    private function setSql($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    private function getSql($sql)
    {
        return mysqli_query($this->conn, $sql);
    }
}

// Main code
require_once("../conn.php");

$categoryEditor = new CategoryEditor($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryEditor->editCategory($id);
} else {
    $categoryEditor->addCategory();
}

?>
