<?php

class BookManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteBook($bookId)
    {
        $bookId = mysqli_real_escape_string($this->conn, $bookId);

        $this->setSql("DELETE FROM sach WHERE id = $bookId");
    }

    public function displayBooks()
{
    $sql = "SELECT * FROM sach;";
    $books = $this->getSql($sql);

    echo '<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tác Giả</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Giới Thiệu</th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($books as $key => $value) {
        echo '<tr>
                <td>' . $value['id'] . '</td>
                <td>' . $value['ten'] . '</td>
                <td>' . $value['tacgia'] . '</td>
                <td>' . $value['tentl'] . '</td>
                <td>' . $value['gioithieu'] . '</td>
                <td>' . $value['noidung'] . '</td>
                <td><img src="' . $value['hinhanh'] . '" alt="Hình Ảnh" style="max-width: 100px;"></td>
                <td><a href="admin.php?pages=themsach&id=' . $value['id'] . '" class="btn btn-info">Sửa</a></td>
                <td><a href="#" class="btn btn-danger" onclick="deleteBook(' . $value['id'] . ')">Xóa</a></td>
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

$bookManager = new BookManager($conn);

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $bookManager->deleteBook($del);
}

$bookManager->displayBooks();

?>
<script>
    function deleteBook(bookId) {
        var confirmation = confirm('Bạn có chắc chắn muốn xóa sách này không?');
        if (confirmation) {
            window.location.href = 'admin.php?pages=sach&del=' + bookId;
        }
    }
</script>
