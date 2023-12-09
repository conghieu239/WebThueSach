<?php

if (!isset($_SESSION)) 
{ 
    session_start();
}

if (!isset($_GET['page'])) {
    $page = '';
} else {
    $page = $_GET['page'];
}

switch ($page) {

    case 'theloai':
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sach = chitiettl($conn, $id);
        }

        include(views."newsach.php");
        break;

    case 'thuesach':

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ctsach = chitietsach($conn, $id);
        }
        include(views."thuesach.php");
        break;

    case 'sachdathue':
            $username = $_SESSION['user'];
            $sachdathue = sachdathue($conn, $username);
            include(views."sachdathue.php");
            break;

    case 'sach':

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $ctsach = chitietsach($conn, $id);

            if (isset($_GET['read'])) {

                if (isset($_SESSION['user'])) {
                    include(views."ctsach.php");
                    break;
                } else {
                    header('Location: admin/login.php');
                }
                
            }
            else {
                include(views."sach.php");
                break;
            }

        }
		else {
			$sach = sach($conn);
			include(views."newsach.php");
			break;
		}

    default:

        $sach = sach($conn);
        include(views."newsach.php");
        break;
}
