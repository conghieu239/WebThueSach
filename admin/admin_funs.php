<?php 	

function getsql($connect, $sql){
	
	$resul = mysqli_query($connect, $sql);
	if (!$resul) {
		echo "Loi truy van";
	}
	$data = array();
	while ($row = mysqli_fetch_assoc($resul)) {
		$data[] = $row;
	}
	return $data;
}


function setsql($connect, $sql){

	$resul = mysqli_query($connect, $sql);
	if (!$resul) {
		echo "Loi truy van";
	}

}

?>
