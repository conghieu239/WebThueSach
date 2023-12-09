<?php

if (!defined('root')) {
    define('root', __DIR__ . "/");
}

if (!defined('views')) {
    define('views', root . "pages/");
}

$conn = mysqli_connect("localhost", "root", "", "thuvien");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
