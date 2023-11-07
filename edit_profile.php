<?php 
require_once('req/Navbar.php');
$userEmail = $_SESSION['userEmail'];

	$query = "SELECT * FROM `user` WHERE `email` = $userEmail";
	$result = $conn->query($query);
	if($result){
		$row = $result->fetch_assoc();
    }
    
		if(isset($_POST['submit'])){
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$uname = $_POST['uname'];
			$password = $_POST['password'];
			$utype = $_POST['type'];
            if($utype == "Administrator"){
				$type = 1;
			}elseif($utype == "Staff"){
				$type = 2;
			}
			$prof_pic = $conn->real_escape_string('images/'.$_FILES['img']['name']);
				if(preg_match("!image!", $_FILES['img']['type'])){
					if(move_uploaded_file($_FILES['img']['tmp_name'], $prof_pic)){
                        $query = "UPDATE `users` SET `firstname` = '$fname', `middlename` = '$mname', `lastname` = '$lname', `email` = '$email', `username` = '$uname', `password` = '$password', `avatar` = '$prof_pic', `type` = '$type' WHERE `email` = '$userEmail'";
					$result = $conn->query($query);
    				if($result) {
						$_SESSION['message'] = "Record Updated Successfully!";
						header('Location: users.php');
						exit();
					}else{
						$_SESSION['message'] = "Unable to Update Record!";
						header('Location: users.php');
                        exit();
					}
				}
			
		}
	}
	?>
<div id="id01" class="modal" style="display:block"> 
		<form class="modal-content" action="edit_profile.php" method="POST" enctype="multipart/form-data"> 
			<h2><center>Profile Modification</center></h2>
		<div class="w3-row" class="sob">
            <label>First Name</label></br>
			<input type="text" name="fname" value="<?= $row['firstname'] ?>" required> </br>
            <label>Middle Name</label></br>
			<input type="text" name="mname" value="<?= $row['middlename'] ?>"> </br>
            <label>Last Name</label></br>
			<input type="text" name="lname" value="<?= $row['lastname'] ?>" required> </br>
            <label>Email Address</label></br>
			<input type="text" name="email" value="<?= $row['email'] ?>" required> </br>
            <label>Username</label></br>
			<input type="text" name="uname" value="<?= $row['username'] ?>" required> </br>
            <label>Password</label></br>
			<input type="password" name="password" value="******" required> </br>
            <label>Type</label> </br>
			<select name="type" required>
				<option> Administrator </option>
				<option> Staff </option>
			</select>
			</br>
			
			<h3>Image</h3>
			
			<label>Inmate Image</label>
			<input type="file" name="img" placeholder="Choose File" required></br></br>
	    </div>

		<center><button type="submit" name="submit">Update</button></center>        
        <div class="container">
        <a href="user_profile.php"><button style="width:20%;">Cancel</button></a>
        </div>
		
		</form> 
	</div> 
    </div>
