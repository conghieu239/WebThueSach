<?php

class MemberManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteMember($username)
    {
        $username = mysqli_real_escape_string($this->conn, $username);

        $this->setSql("DELETE FROM taikhoan WHERE tentk LIKE '%$username%';");
    }

    public function displayMembers()
{
    $sql = "SELECT * FROM taikhoan;";
    $members = $this->getSql($sql);

    echo '<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Thứ Tự</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Pass</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($members as $key => $value) {
        echo '<tr>
                <td>' . $key . '</td>
                <td>' . $value['tentk'] . '</td>
                <td>' . $value['pass'] . '</td>
                <td>' . $value['quyen'] . '</td>
                <td><a href="#" class="btn btn-danger" onclick="deleteMember(\'' . $value['tentk'] . '\')">Xóa</a></td>
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

$memberManager = new MemberManager($conn);

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $memberManager->deleteMember($del);
}

$memberManager->displayMembers();

?>
<script>
    function deleteMember(username) {
        var confirmation = confirm('Bạn có chắc chắn muốn xóa thành viên này không?');
        if (confirmation) {
            window.location.href = 'admin.php?pages=thanhvien&del=' + username;
        }
    }
</script>
