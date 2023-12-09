<?php

class QuotationEditor
{
    private $conn;
    private $message;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->message = '';
    }

    public function editQuotation($id)
{
    if (isset($_POST['add'])) {
        $noidung = trim($_POST['noidung']);

        if (empty($noidung)) {
            $this->message = 'Vui lòng nhập nội dung danh ngôn.';
        } else {
            $existingQuotation = $this->getQuotationByContent($noidung);
            if ($existingQuotation && $existingQuotation['iddn'] != $id) {
                $this->message = 'Nội dung danh ngôn đã tồn tại.';
            } else {
                $sql = "UPDATE danhngon SET noidung ='".$noidung."' WHERE iddn = $id;";
                $danhngon = $this->setSql($sql);

                if ($danhngon) {
                    $this->message = 'Sửa nội dung danh ngôn thành công.';
                } else {
                    $this->message = 'Đã xảy ra lỗi khi sửa nội dung danh ngôn.';
                }
            }
        }
    }

    $sql = "SELECT noidung FROM danhngon WHERE iddn = $id;";
    $suadn = $this->getSql($sql);

    foreach ($suadn as $key => $value) {
        echo '<form class="nhom" action="" method="POST">
                <div class="mb-3">
                    <h2>Sửa Nội Dung Danh Ngôn</h2>
                    <label for="noidung" class="form-label">Nội Dung:</label>
                    <input type="text" class="form-control" id="noidung" name="noidung" value="'.$value['noidung'].'">
                    <small class="text-danger">'.$this->message.'</small>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Sửa</button>
            </form>';
    }
}

public function addQuotation()
{
    if (isset($_POST['add'])) {
        $noidung = trim($_POST['noidung']);

        if (empty($noidung)) {
            $this->message = 'Vui lòng nhập nội dung danh ngôn.';
        } else {
            $existingQuotation = $this->getQuotationByContent($noidung);
            if ($existingQuotation) {
                $this->message = 'Nội dung danh ngôn đã tồn tại.';
            } else {
                $sql = "INSERT INTO danhngon(noidung) VALUES ('".$noidung."')";
                $danhngon = $this->setSql($sql);

                if ($danhngon) {
                    $this->message = 'Thêm danh ngôn thành công.';
                } else {
                    $this->message = 'Đã xảy ra lỗi khi thêm danh ngôn.';
                }
            }
        }
    }

    echo '<form class="nhom" action="" method="POST">
            <div class="mb-3">
                <h2>Thêm Danh Ngôn</h2>
                <label for="noidung" class="form-label">Nội Dung:</label>
                <input type="text" class="form-control" id="noidung" name="noidung" value="">
                <small class="text-danger">'.$this->message.'</small>
            </div>
            <button type="submit" name="add" class="btn btn-success">Thêm</button>
        </form>';
}


    private function getQuotationByContent($content)
    {
        $sql = "SELECT * FROM danhngon WHERE noidung = '".$content."'";
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

$quotationEditor = new QuotationEditor($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $quotationEditor->editQuotation($id);
} else {
    $quotationEditor->addQuotation();
}

?>
