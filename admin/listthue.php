<?php

class RentalListManager
{
    private $conn;
    private $message;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->message = '';
    }

    public function displayRentalList()
{
    $sql = "SELECT * FROM thuesach;";
    $listthue = $this->getSql($sql);

    echo '<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên người thuê</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Tên sách</th>
                        <th>Ngày thuê</th>
                        <th>Ngày trả</th>
                        <th>Trạng Thái</th>
                        <th>Chuyển trạng thái</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($listthue as $key => $value) {
        echo '<tr>
                <td>' . $value['id'] . '</td>
                <td>' . $value['ten'] . '</td>
                <td>' . $value['birthday'] . '</td>
                <td>' . $value['phone'] . '</td>
                <td>' . $value['bookname'] . '</td>
                <td>' . $value['startday'] . '</td>
                <td>' . $value['endday'] . '</td>
                <td>' . $this->getStatusLabel($value['trangthai']) . '</td>
                <td>
                    <form action="" method="post" class="d-flex">
                        <input name="changeOptionId" type="hidden" value="' . $value['id'] . '">
                        <select class="form-select me-2" name="changeOption">
                            <option value="0" ' . ($value['trangthai'] == 0 ? 'selected' : '') . '>Chờ xác nhận</option>
                            <option value="1" ' . ($value['trangthai'] == 1 ? 'selected' : '') . '>Chưa trả</option>
                            <option value="2" ' . ($value['trangthai'] == 2 ? 'selected' : '') . '>Đã trả</option>
                            <option value="3" ' . ($value['trangthai'] == 3 ? 'selected' : '') . '>Quá hạn</option>
                        </select>
                        <button type="submit" name="changeStatus" class="btn btn-primary">OK</button>
                    </form>
                </td>
                <td>
                    <a href="#" onclick="confirmDelete(' . $value['id'] . ');" class="btn btn-danger">Xóa</a>
                </td>
            </tr>';
    }

    echo '</tbody></table></div>';
}



    public function deleteRental($id)
    {
        $sql = "DELETE FROM thuesach WHERE id = $id";
        $this->setSql($sql);
    }

    public function changeStatus()
{
    if (isset($_POST['changeStatus'])) {
        $trangthai = $_POST['changeOption'];
        $id_tt = $_POST['changeOptionId'];
        $sql1 = "UPDATE thuesach SET trangthai = $trangthai WHERE id = $id_tt";
        $result = $this->setSql($sql1);

        // Sử dụng JavaScript để làm mới trang
        echo '<script>window.location.href = "admin.php?pages=listthue";</script>';
        exit; // Đảm bảo thoát sau khi gửi mã JavaScript
    }
}


    private function getStatusLabel($status)
    {
        switch ($status) {
            case 0:
                return 'Chờ xác nhận';
            case 1:
                return 'Chưa trả';
            case 2:
                return 'Đã trả';
            case 3:
                return 'Quá hạn';
            default:
                return '';
        }
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

$rentalListManager = new RentalListManager($conn);

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $rentalListManager->deleteRental($id);
    echo '<script>alert("Xóa thành công.");</script>';
}

if (isset($_POST['changeStatus'])) {
    $rentalListManager->changeStatus();
}

?>

<script>
    function confirmDelete(id) {
        if (confirm("Bạn có chắc chắn muốn xóa không?")) {
            window.location.href = 'admin.php?pages=listthue&del=' + id;
        }
    }
</script>

<?php
$rentalListManager->displayRentalList();
?>
