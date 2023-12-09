<?php 	

if (!isset($_SESSION)) 
{ 
   	session_start();
}

if (isset($_SESSION['user'])) 
{
	unset($_SESSION['user']);
	unset($_SESSION['quyen']);
	unset($_SESSION['idtk']);
	header('Location: ../index.php');
}


 ?>