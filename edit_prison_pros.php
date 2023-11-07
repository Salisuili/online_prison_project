<?php
require_once('req\database.php');
$id = $_GET['id'];
if(isset($_POST['submit'])){
	
	$pname = $_POST['pfname'];
	$active = $_POST['active'];

	if($active == "Active"){
		$status = 1;
	}elseif($active == "Inactive"){
		$status	= 0;
	}
    $query = "UPDATE `prison_list` SET `name` = '$pname', `status` = '$status' WHERE `id` = '$id'";
             
	$result = $conn->query($query);
	if($result){
		
		$_SESSION['message'] = "Record Updated";
		header('Location:prisons.php');
	}else{
		$_SESSION['message'] = "Unable to Updated Record";
		header('Location:prisons.php');
	}

}
?>