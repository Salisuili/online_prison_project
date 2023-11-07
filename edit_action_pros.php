<?php
require_once('req\database.php');
$id = $_GET['id'];

if(isset($_POST['submit'])){
	
	$name = $_POST['name'];
    $active = $_POST['status'];
    
	if($active == "Active"){
		$status = 1;
	}elseif($active === "Inactive"){
		$status	= 0;
	}
    $query = "UPDATE `action_list` SET `name` = '$name', `status` = '$status' WHERE `id` = '$id'";
             
	$result = $conn->query($query);
	if($result){
		
		$_SESSION['message'] = "Record Updated";
		header('Location:actions.php');
	}else{
		$_SESSION['message'] = "Unable to Updated Record";
		header('Location:actions.php');
	}

}
?>