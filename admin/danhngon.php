<?php

class DanhNgonManager
{
    private $conn;
    private $message;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->message = '';
    }

    public function displayDanhNgonList()
{
    $sql = "SELECT * FROM danhngon;";
    $danhngon = $this->getSql($sql);

    echo '<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($danhngon as $key => $value) {
        echo '<tr>
                <td>' . $value['iddn'] . '</td>
                <td>' . $value['noidung'] . '</td>
                <td><a href="admin.php?pages=themdn&id=' . $value['iddn'] . '" class="btn btn-info">Sửa</a></td>
                <td><a href="#" class="btn btn-danger" onclick="confirmDelete(' . $value['iddn'] . ');">Xóa</a></td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>';
}



    public function deleteDanhNgon($id)
    {
        $sql = "DELETE FROM danhngon WHERE iddn = $id";
        $this->setSql($sql);
        echo '<script>alert("Xóa thành công.");</script>';
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

$danhNgonManager = new DanhNgonManager($conn);

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $danhNgonManager->deleteDanhNgon($id);
}

?>

<script>
    function confirmDelete(id) {
        if (confirm("Bạn có chắc chắn muốn xóa không?")) {
            window.location.href = 'admin.php?pages=danhngon&del=' + id;
        }
    }
</script>

<?php
$danhNgonManager->displayDanhNgonList();
?>
