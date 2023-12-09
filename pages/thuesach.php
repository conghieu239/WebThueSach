<?php

class RentBookForm
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function processRent()
    {
        if (isset($_POST['rent'])) {
            $username = $_POST['username'];
            $bookName = $_POST['bookName'];
            $tenThue = $_POST['name'];
            $birthday = $_POST['birthday'];
            $phone = $_POST['phone'];
            $startDay = $_POST['startDay'];
            $endDay = $_POST['endDay'];

            $result = $this->insertRentInfo($username, $bookName, $tenThue, $birthday, $phone, $startDay, $endDay);

            if (!$result) {
                die("Query failed: " . mysqli_error($this->conn));
            } else {
                echo '<script>alert("Thuê sách thành công! Vui lòng đợi duyệt");</script>';
            }
        }
    }

    private function insertRentInfo($username, $bookName, $tenThue, $birthday, $phone, $startDay, $endDay)
    {
        $sql = "INSERT INTO thuesach(username, bookname, ten, birthday, phone, startday, endday) 
                VALUES ('" . $username . "', '" . $bookName . "', '" . $tenThue . "',  '" . $birthday . "', '" . $phone . "', '" . $startDay . "', '" . $endDay . "');";

        return mysqli_query($this->conn, $sql);
    }
}

// Main code
require_once("conn.php");

$rentBookForm = new RentBookForm($conn);
$rentBookForm->processRent();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    a {
        text-decoration: none;
    }
</style>

<?php
foreach ($ctsach as $key => $value) {
    $ten = $value['ten'];
}

?>

<div class="container mt-5">
    <form class="m-4" action="" method="POST">
        <h4 class="text-center">Thuê sách</h4>
        <input type="hidden" value="<?php echo ($_SESSION['user']) ?>" name="username">
        <div class="mb-3">
            <label for="bookName" class="form-label">Sách thuê:</label>
            <input type="text" name="bookName" class="form-control" id="bookName" aria-describedby="emailHelp" value="<?php echo $ten; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên người thuê:</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="birthday" class="form-label">Ngày sinh:</label>
            <input name="birthday" type="date" class="form-control" id="birthday" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input name="phone" type="number" class="form-control" id="phone" required>
        </div>

        <div class="mb-3">
            <label for="startDay" class="form-label">Ngày thuê:</label>
            <input name="startDay" type="date" class="form-control" id="startDay" required>
        </div>

        <div class="mb-3">
            <label for="endDay" class="form-label">Ngày trả:</label>
            <input name="endDay" type="date" class="form-control" id="endDay" required>
        </div>
        <button type="submit" class="btn btn-primary" name="rent">Thuê sách</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
