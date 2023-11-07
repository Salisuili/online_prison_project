<?php 
require_once('req/database.php');
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
            //print_r($_FILES);
			$prof_pic = $conn->real_escape_string('images/'.$_FILES['img']['name']);
				if(preg_match("!image!", $_FILES['img']['type'])){
					if(move_uploaded_file($_FILES['img']['tmp_name'], $prof_pic)){
					$query = "INSERT INTO `inmate_list`(`code`, `firstname`, `middlename`, `lastname`, `sex`, `dob`, `address`, `marital_status`, `eye_color`, `complexion`, `cell_id`, `sentence`,`crime`, `date_from`, `date_to`, `emergency_name`, `emergency_contact`, `emergency_relation`, `image_path`) VALUES('$code','$fname','$mname','$lname','$sex','$dob','$address','$marital_status','$eye','$complexion','$cell','$sentence','$crime','$tss',$tse,'$fullname','$contact','$relation','$prof_pic')";
					$result = $conn->query($query);
    				if($result) {
						$_SESSION['message'] = "Record Registered Successfully!";
						header('Location: inmates.php');
						exit();
					}else{
						$_SESSION['message'] = "Unable to Register Record!";
						header('Location: inmates.php');
                        exit();
					}
				}
			
		}
	}
	?>