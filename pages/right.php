<?php

class HomePageView
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function displayRandomQuote()
    {
        $danhNgon = $this->getRandomQuote();
        echo '<div class="container mt-1">
                <div class="card text-center">
                    <div  class="card-header">
                        Danh Ngôn Hay
                    </div>
                    <div class="card-body-2">
                        <p id="noidung2" class="card-text">' . $danhNgon['noidung'] . '</p>
                    </div>
                </div>
            </div>';
    }

    public function displayCategories()
    {
        $theLoai = $this->getCategories();
        echo '<div class="container mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        Thể Loại Sách
                    </div>
                    <div class="card-body-2">';

        foreach ($theLoai as $key => $value) {
            echo '<div class="title">
                    <a href="index.php?page=theloai&id=' . $value['tentl'] . '" class="btn">' . $value['tentl'] . '</a>
                </div>';
        }

        echo '</div></div></div>';
    }

    private function getRandomQuote()
    {
        $danhNgon = danhngon($this->conn);
        $randomIndex = rand(0, count($danhNgon) - 1);

        return $danhNgon[$randomIndex];
    }

    private function getCategories()
    {
        return theloai($this->conn);
    }
}

// Main code
require_once("conn.php");

$homePageView = new HomePageView($conn);
$homePageView->displayRandomQuote();
$homePageView->displayCategories();

?>
