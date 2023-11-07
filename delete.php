<?php
require_once('req/database.php');
$_SESSION['message']='';

	$delId = $_GET['id'];
    $table = $_GET['table'];
    
	$query = "DELETE FROM `$table` WHERE id = '$delId'";
	$result = $conn->query($query);
	if($result){
		$_SESSION['message'] = "Record Deleted Successfully";
	}else{
		$_SESSION['message'] = "Unable to Delete Record";
	}
?>