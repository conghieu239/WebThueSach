<?php

class BookRental
{
    private $sachdathue;

    public function __construct($sachdathue)
    {
        $this->sachdathue = $sachdathue;
    }

    public function displayBookRentalTable()
    {
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            a {
                text-decoration: none;
            }
        </style>
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên sách</th>
                        <th scope="col">Ngày thuê</th>
                        <th scope="col">Ngày trả</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach ($this->sachdathue as $key => $value) { ?>
                        <tr>
                            <th scope="row"><?php echo ($stt);
                                            $stt++; ?></th>
                            <td><?php echo ($value['bookname']); ?></td>
                            <td><?php echo ($value['startday']); ?></td>
                            <td><?php echo ($value['endday']); ?></td>
                            <td><?php
                                if ($value['trangthai'] == 0) {
                                    echo 'Chờ xác nhận';
                                } elseif ($value['trangthai'] == 1) {
                                    echo 'Chưa trả';
                                } elseif ($value['trangthai'] == 2) {
                                    echo 'Đã trả';
                                } else {
                                    echo '<span style="color:red">Quá hạn</span>';
                                }
                                ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <?php
    }
}

require_once("conn.php");
require_once("func.php");

$username = $_SESSION['user'];

$sachdathue = sachdathue($conn, $username);

$bookRental = new BookRental($sachdathue);
$bookRental->displayBookRentalTable();
?>

