<?php

if (!function_exists('theloai')) {
    function theloai($connect) {
        $sql = "SELECT * FROM theloai";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

if (!function_exists('chitiettl')) {
    function chitiettl($connect, $id) {
        $sql = "SELECT * FROM sach s WHERE s.tentl LIKE '%" . $id . "%';";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

if (!function_exists('sachdathue')) {
    function sachdathue($connect, $username) {
        $sql = "SELECT * FROM thuesach s WHERE s.username LIKE '%" . $username . "%' ORDER BY id DESC;";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

if (!function_exists('danhngon')) {
    function danhngon($connect) {
        $sql = "SELECT * FROM danhngon";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

if (!function_exists('sach')) {
    function sach($connect) {
        $sql = "SELECT * FROM sach;";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

if (!function_exists('chitietsach')) {
    function chitietsach($connect, $id) {
        $sql = "SELECT * FROM sach s WHERE s.id = " . $id . ";";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            echo "Loi truy van";
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

?>
