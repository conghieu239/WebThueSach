<?php

class SearchBook
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getContent()
    {
        if (isset($_GET['page']) && $_GET['page'] == 'theloai') {
            $content = isset($_GET['id']) ? $_GET['id'] : '';
        } else {
            $content = 'Kết quả tìm kiếm';
        }

        return $content;
    }

    public function getBookData($searchTerm, $start, $perPage)
    {
        $sql = "SELECT *
                FROM sach s
                WHERE s.ten LIKE '%" . $searchTerm . "%'
                LIMIT " . $start . ", " . $perPage . ";";
        $result = mysqli_query($this->conn, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getTotalBooks($searchTerm)
    {
        $sql = "SELECT COUNT(*) AS total
                FROM sach s
                WHERE s.ten LIKE '%" . $searchTerm . "%';";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['total'];
    }
}

class BookView
{
    public function displayContent($content)
    {
        echo '<div class="container">';
        echo '<h2 class="name mt-1">' . $content . '</h2>';
        echo '<div class="row">';
    }

    public function displayBook($value)
    {
        ?>
        <div class="col-md-3 book-item">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo $value['hinhanh']; ?>" alt="Book Image">
                <div class="card-body">
                    <h5 class="card-title"><a href="index.php?page=sach&id=<?php echo $value['id']; ?>"><?php echo $value['ten']; ?></a></h5>
                    <p class="card-text">
                        <span class="author">Tác giả: <?php echo $value['tacgia']; ?></span><br>
                        <span class="publish-year">Năm xuất bản: <?php echo $value['namxb']; ?></span>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    public function closeContent()
    {
        echo '</div>';
        echo '</div>';
    }

    // Inside BookView class, update the displayPagination method
    public function displayPagination($currentPage, $totalPages)
    {
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination justify-content-center">';
        
        // Previous Button
        echo '<li class="page-item ' . ($currentPage == 1 ? 'disabled' : '') . '">';
        echo '<a class="page-link" href="?search=' . $_GET['search'] . '&page_number=' . ($currentPage - 1) . '" aria-label="Previous">';
        echo '<span aria-hidden="true">&laquo;</span>';
        echo '</a></li>';
        
        // Page Links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
            echo '<a class="page-link" href="?search=' . $_GET['search'] . '&page_number=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }

        // Next Button
        echo '<li class="page-item ' . ($currentPage == $totalPages ? 'disabled' : '') . '">';
        echo '<a class="page-link" href="?search=' . $_GET['search'] . '&page_number=' . ($currentPage + 1) . '" aria-label="Next">';
        echo '<span aria-hidden="true">&raquo;</span>';
        echo '</a></li>';
        
        echo '</ul>';
        echo '</nav>';
    }

}

require_once("conn.php");

$searchBook = new SearchBook($conn);
$content = $searchBook->getContent();

$searchTerm = $_GET['search'];
$currentPage = isset($_GET['page_number']) ? $_GET['page_number'] : 1;
$perPage = 8;
$start = ($currentPage - 1) * $perPage;

$data = $searchBook->getBookData($searchTerm, $start, $perPage);
$totalBooks = $searchBook->getTotalBooks($searchTerm);
$totalPages = ceil($totalBooks / $perPage);

$bookView = new BookView();
$bookView->displayContent($content);

foreach ($data as $key => $value) {
    $bookView->displayBook($value);
}

$bookView->closeContent();
$bookView->displayPagination($currentPage, $totalPages);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.hover-book').hover(function () {
            var authorInfo = $(this).find('.author').text();
            var pushlishYear = $(this).find('.publish-year').text();
            $('#author-info').text(authorInfo + ' - ' + pushlishYear);
        }, function () {
            $('#author-info').text('');
        });
    });
</script>
