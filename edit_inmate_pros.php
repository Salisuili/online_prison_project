<?php
require_once("req/database.php");
//print_r($_GET['id']);
$id = $_GET['id'];
if(isset($_POST['submit'])){
	$code = $_POST['code'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$sex = $_POST['sex'];
	$marital_status = $_POST['marital_status'];
	$complexion = $_POST['complexion'];
	$cell = $_POST['cell'];
	$eye = $_POST['eye'];
	$address = $_POST['address'];
	$crime = $_POST['crime'];
	$sentence = $_POST['sentence'];
	$tss = $_POST['tss'];
	$tse = $_POST['tse'];
	$fullname = $_POST['fullname'];
	$relation = $_POST['relation'];
	$contact = $_POST['contact'];
    //print_r($_POST);
    
	$prof_pic = $conn->real_escape_string('images/'.$_FILES['img']['name']);
		if(preg_match("!image!", $_FILES['img']['type'])){
			if(move_uploaded_file($_FILES['img']['tmp_name'], $prof_pic)){
			$query = "UPDATE `inmate_list` SET `code` = '$code', `firstname` = '$fname', `middlename` = '$mname', `lastname` = '$lname', `sex` = '$sex', `dob` = '$dob', `address` = '$address', `marital_status` = '$marital_status', `eye_color` = '$eye', `complexion` = '$complexion', `cell_id` = '$cell', `sentence` = '$sentence', `crime` = '$crime', `date_from` = '$tss', `date_to` = '$tse', `emergency_name` = '$fullname', `emergency_contact` = '$contact', `emergency_relation` = '$relation', `image_path` = '$prof_pic' WHERE `id` = '$id'"; 
            
            if ($conn->query($query) === TRUE) {
				$_SESSION['message'] = "Record Updated Successfully!";
				header('Location: inmates.php');
				exit();
			}else{
				$_SESSION['message'] = "Unable to Update Record!";
				exit();
			}
		}
	
}
}
?>