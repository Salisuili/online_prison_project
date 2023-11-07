<?php
require_once('req\database.php');
$id = $_GET['id'];

if(isset($_POST['submit'])){
	
    $prison = $_POST['prison'];
    
    if($prison == "men prison"){
		$prison_id = 1;
	}elseif($prison == "women prison"){
		$prison_id	= 0;
    }
    
    $cellname = $_POST['cellname'];
    $active = $_POST['status'];

	if($active === "Active"){
		$status = 1;
	}elseif($active === "Inactive"){
		$status	= 0;
    }
    
    $query = "UPDATE `cell_list` SET `prison_id` = '$prison_id', `name` = '$cellname', `status` = '$status' WHERE `id` = '$id'";             
                        
	$result = $conn->query($query);
    
    if($result){	
		$_SESSION['message'] = "Record Updated";
		header('Location:cell_blocks.php');
	}else{
		$_SESSION['message'] = "Unable to Updated Record";
		header('Location:cell_blocks.php');
	}

}
?>