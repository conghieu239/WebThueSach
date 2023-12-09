<body>
    <div class="container book-container">
        <?php
            require_once("conn.php");
            require_once("func.php");

            class BookListView
            {
                private $sach;
                

                public function __construct($sach)
                {
                    $this->sach = $sach;
                 
                }

                public function displayContent($content)
                {
                    echo '<div class="container">';
                    echo '<h2 class="name mt-1">' . $content . '</h2>';
                    echo '<div class="row">';

                    $booksPerPage = 8;
                    $currentPage = isset($_GET['page_number']) ? $_GET['page_number'] : 1;
                    $startIndex = ($currentPage - 1) * $booksPerPage;
                    $endIndex = $startIndex + $booksPerPage - 1;

                    $displayedBooks = array_slice($this->sach, $startIndex, $booksPerPage);

                    foreach ($displayedBooks as $key => $value) {
                         $this->displayBook($value);
                    }



                    echo '</div>';

                    // Hiển thị phân trang
                    $totalBooks = count($this->sach);
                    $totalPages = ceil($totalBooks / $booksPerPage);

                    echo '<ul class="pagination justify-content-center">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                        echo '<a class="page-link" href="?page=' . $content . '&page_number=' . $i . '">' . $i . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';

                    echo '</div>';
                }

                private function displayBook($value)
                {
                    ?>
                    <div class="col-md-3 col-6 book-item">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top book-image" src="<?php echo $value['hinhanh']; ?>" alt="Book Image">
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
            }

            $bookListView = new BookListView($sach);

            if (isset($_GET['page']) && $_GET['page'] == 'theloai') {
                if (isset($_GET['id'])) {
                    $content = $_GET['id'];
                }
            } else {
                $content = 'Tất cả sách';
            }

            $bookListView->displayContent($content);
        ?>
    </div>
</body>
</html>
