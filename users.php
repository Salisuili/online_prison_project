<?php 
require_once('req/Navbar.php');

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
					$query = "INSERT INTO `users`(`firstname`, `middlename`, `lastname`, `email`, `username`, `password`, `avatar`, `type`) VALUES('$fname','$mname','$lname','$email','$uname','$password','$prof_pic','$type')";
					$result = $conn->query($query);
    				if($result) {
						$_SESSION['message'] = "Record Registered Successfully!";
						header('Location: users.php');
						exit();
					}else{
						$_SESSION['message'] = "Unable to Register Record!";
						header('Location: users.php');
                        exit();
					}
				}
			
		}
	}
	?>
<style>
	#list{
		width:100%;
	}
	.container{
		width: 90%;
		padding-top: 5%;
	}
	.table{
		margin-top: 2%;
		width:100%;
		color:  rgb(98, 120, 120);
	}
	.right{
		float: right;
	}


	/*  Model style  */

	
</style>

<div class="w3-card container">
<div class="w3-bar">
  <a href="#" class="w3-button w3-white w3-hover-white"><b>System Users</b></a> 
  <a href="#" class="w3-button w3-green right" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><b>+</b>Create New</a>
  
</div>
<div class="w3-card table">
			<table id="list" class="w3-table w3-striped w3-bordered w3-hoverable">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="10%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
                    <col width="15%">
				</colgroup>
				<thead>
					<tr class="w3-light-grey">
						<th class="w3-center">#</th>
						<th class="w3-center">Date Created</th>
						<th class="w3-center">Picture</th>
						<th class="w3-center">Name</th>
						<th class="w3-center">Username</th>
						<th class="w3-center">Type</th>
                        <th class="w3-center">Action</th>
					</tr>
				</thead> 
				<?php 
				$_SESSION['message'] = '';
					$i = 1;
						$qry = $conn->query("SELECT *,concat(lastname,', ', firstname, coalesce(concat(' ', middlename), '')) as `name` from `users` order by `name` asc ");
						while($row = $qry->fetch_assoc()):
							
					?>
						<tr>
							<td class="w3-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_added'])) ?></td>
							<td class="w3-center">
							<img src="<?= $row['avatar'] ?>" alt="pic" class="w3-circle" style="width:50px; height:50px">
							</td>
							<td class="w3-center"><?= $row['name'] ?></td>
							<td class="w3-center"><?= $row['username'] ?></td>
							<td class="w3-center">
							<?php if($row['type'] == 1): ?>
                                    <span>Admin</span>
                                <?php else: ?>
                                    <span>Staff</span>
                                <?php endif; ?>
							</td>
					<td>
					<div class="dropdown">
						<a class="w3-center" href="javascript:void(0)" >&nbsp;&nbsp;Action&nbsp;↓</a>
						<div class="dropdown-content">
				
						<a href="edit_user.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-light-grey" name='edit'>Edit</a>
						<a href="delete.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-light-grey" name='del'>Delete</a>
						
						</div>
					</div>

					</td>
					</tr>
					<?php endwhile; ?>
				
			</table>
	</div>
	</div>


	<!--  MODEL HERE  -->

	<div id="id01" class="modal"> 
		<form class="modal-content animate" action="users.php" method="POST" enctype="multipart/form-data"> 
			<h2><center>User Registration</center></h2>
		<div class="w3-row" class="sob">
 
            <label>First Name</label></br>
			<input type="text" name="fname" required> </br>
            <label>Middle Name</label></br>
			<input type="text" name="mname"> </br>
            <label>Last Name</label></br>
			<input type="text" name="lname" required> </br>
            <label>Email Address</label></br>
			<input type="text" name="email" required> </br>
            <label>Username</label></br>
			<input type="text" name="uname" required> </br>
            <label>Password</label></br>
			<input type="password" name="password" required> </br>
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

		<center><button type="submit" name="submit">Register</button></center>        
		
		<div class="container"> 
			<button type="button" onclick="document.getElementById ('id01').style. display='none'" class="cancelbtn"> Cancel</button> 
		</div> 
		</form> 
	</div> 



<script>
			// Get the modal 
var modal = document.getElementById('id01'); 
			// When the user clicks anywhere outside of the modal, close it 
			window.onclick = function(event) { 
			if (event.target == modal) { 
			modal.style.display = "none"; 
			}
	 } 	
				
</script>

<?php require_once('req\footer.php');?>
