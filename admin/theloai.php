<?php

class CategoryEditor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteCategory($categoryName)
    {
        $categoryName = mysqli_real_escape_string($this->conn, $categoryName);

        $checkUsageSql = "SELECT COUNT(*) as count FROM sach WHERE tentl = '$categoryName';";
        $result = $this->getSql($checkUsageSql);
        $usageCount = mysqli_fetch_assoc($result)['count'];

        if ($usageCount == 0) {
            $this->setSql("DELETE FROM theloai WHERE tentl = '$categoryName';");
        }
    }

    public function displayCategories()
{
    $sql = "SELECT * FROM theloai;";
    $categories = $this->getSql($sql);

    echo '<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Thứ Tự</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($categories as $key => $value) {
        echo '<tr>
                <td>' . $key . '</td>
                <td>' . $value['tentl'] . '</td>
                <td><a href="admin.php?pages=themtl&id=' . $value['tentl'] . '" class="btn btn-info">Sửa</a></td>
                <td><a href="#" class="btn btn-danger" onclick="deleteCategory(\'' . $value['tentl'] . '\')">Xóa</a></td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>';
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

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $categoryEditor->deleteCategory($del);
}

$categoryEditor->displayCategories();

?>
<script>
    function deleteCategory(categoryName) {
        var confirmation = confirm('Bạn có chắc chắn muốn xóa thể loại này không?');
        if (confirmation) {
            window.location.href = 'admin.php?pages=theloai&del=' + categoryName;
        }
    }
</script>
