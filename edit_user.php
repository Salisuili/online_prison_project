<?php 
require_once('req/Navbar.php');

$id = $_GET['id'];

	$query = "SELECT * FROM `users` WHERE `id` = $id";
	$result = $conn->query($query);
	if($result){
		$row = $result->fetch_assoc();
	}

?>
<style>
    img#cimg{
		max-height: 15em;
		max-width: 100%;
		object-fit: scale-down;
	}

    .inmate{
		width: 90%;
        padding-top: 5%;
        margin-left: 10%;
	}
	.container{
		display: flex;
  		flex-wrap: nowrap;
	}
	.bt1{
		margin-right: 10px;
	}
</style>

<div class="container">
		<div class="bt1">
		<a href="inmates.php"><button type="button" class="cancelbtn">  Back to List </button> </a>
		</div>

</div>

<div id="id01" class="modal" style="display:block"> 
		<form class="modal-content animate" action="edit_user_pros.php?id=<?= $_GET['id']?>" method="POST" enctype="multipart/form-data"> 
			<h2><center>User Modification</center></h2>
		<div class="w3-row" class="sob">
 
            <label>First Name</label></br>
			<input type="text" name="fname" value="<?= $row['firstname']?>" required> </br>
            <label>Middle Name</label></br>
			<input type="text" name="mname" value="<?= $row['middlename']?>"> </br>
            <label>Last Name</label></br>
			<input type="text" name="lname" value="<?= $row['lastname']?>" required> </br>
			<label>Email Address</label></br>
			<input type="text" name="email" value="<?= $row['email']?>" required> </br>
            <label>Username</label></br>
			<input type="text" name="uname" value="<?= $row['username']?>" required> </br>
            <label>Password</label></br>
			<input type="password" name="password" placeholder="Enter New Password" required> </br>
            <label>Type</label> </br> 
			<select name="type">
				<option> Administrator </option>
				<option> Staff </option>
			</select>
			</br>
			
			<h3>Image</h3>
			
			<label>User Image</label>
			<input type="file" name="img" placeholder="Choose File" required></br></br>
	    </div>
        <div>
			<center><button type="submit" name="submit">Update</button></center>
		</div>
		
		<div class="container"> 
		<a href="users.php"><button type="button" class="cancelbtn">  Cancel </button> </a>
		</div> 
		</form> 
	</div> 

    <?php require_once('req\footer.php');?>