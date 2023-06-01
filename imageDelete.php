<?php
session_start();
require('db_config.php');


if(isset($_POST) && !empty($_POST['id'])){

	   // select image to delete    
	   $sql_select = "SELECT img_name FROM images WHERE id = ".$_POST['id'];
	   $select_result = $conn->query($sql_select);
	    $row = $select_result->fetch_row();
		$image_name = $row[0];

		// code to unlink(delete)  image physically from folder 
		$unl = unlink("./uploads/".$image_name);

		$sql = "DELETE FROM images WHERE id = ".$_POST['id'];
		$conn->query($sql);


		$_SESSION['success'];
		header("Location: ./image_gallary.php");
}else{
	$_SESSION['error'] = 'Please Select Image or Write title';
	header("Location: ./image_gallary.php");
}


?>