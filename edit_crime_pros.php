<?php
require_once('req\database.php');
$id = $_GET['id'];

if(isset($_POST['submit'])){
	
	$crime = $_POST['crime'];
	$active = $_POST['status'];
	if($active == "Active"){
		$status = 1;
	}elseif($active === "Inactive"){
		$status	= 0;
	}
    $query = "UPDATE `crime_list` SET `name` = '$crime', `status` = '$status' WHERE `id` = '$id'";
             
	$result = $conn->query($query);
	if($result){
		
		$_SESSION['message'] = "Record Updated";
		header('Location:crimes.php');
	}else{
		$_SESSION['message'] = "Unable to Updated Record";
		header('Location:crimes.php');
	}

}
?>