<?php 
require_once('req/Navbar.php');

$id = $_GET['id'];

	$query = "SELECT * FROM `inmate_list` WHERE `id` = $id";
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

<div id="id01" class="modal2"> 
		<form class="inmate animate" action="edit_inmate_pros.php?id=<?= $_GET['id']?>" method="POST" enctype="multipart/form-data"> 
			<h2><center>Inmate Details Modification</center></h2>
			<div>
			<Center><img src="<?= $row['image_path'] ?>" class="w3-circle" style="width:100px;height:100px;border:10px" alt="profile pic"></Center>
			</div>
			<div class="w3-row" class="sob">
			<div class="w3-col s6" class="sub"> 
			
			<label>Code</label></br>
			 
			<input type="text" name="code" value="<?= $row['code'] ?>" required> </br>
			<label>Prison & Cell Block</label> </br>
			<select name="cell">
				<?php 
				$cell_query = "SELECT * FROM `cell_list`";
				$cell_result = $conn->query($cell_query);
				while($cell_row = $cell_result->fetch_assoc()):
					$selected = ($cell_row['id'] == $row['cell_id']) ? 'selected' : '';
				?>
				<option value="<?= $cell_row['id'] ?>" <?= $selected ?>>
					<?= $cell_row['name'] ?>
				</option>
				<?php endwhile; ?>
			</select>

			</br> 
			<?php
			$query = "SELECT * FROM `inmate_list` WHERE `id` = {$_GET['id']}";
			$result = $conn->query($query);
			if($result){
				$row = $result->fetch_assoc();
			}
			?>
			<label>First Name</label></br>
			<input type="text" name="fname" value="<?= $row['firstname'] ?>" required> </br>

			<label>Middle Name</label></br>
			<input type="text" placeholder="Optional" value="<?= $row['middlename'] ?>" name="mname">
			</br>
			<label>Last Name</label></br>
			<input type="text" name="lname" value="<?= $row['lastname'] ?>" required></br>

			<label>Date of Birth</label></br>
			<input type="date" name="dob" value="<?= $row['dob'] ?>" required placeholder='yyyy-mm-dd'>
			</br>
			<label>Sex</label> </br>
			<select name='sex' value="<?= $row['sex'] ?>" required>
				<option> Male </option>
				<option> Female </option>
			</select></br>

			<label>Marital Status</label> </br>
			<select name='marital_status' value="<?= $row['marital_status'] ?>" required>
				<option> Single </option>
				<option> Married </option>
				<option> Widow </option>
			</select>
			</br>
			<label>Complexion</label></br>
			<input type="text" name="complexion" value="<?= $row['complexion'] ?>" required></br>

			<label>Eye Color</label></br>
			<input type="text" name="eye" value="<?= $row['eye_color'] ?>" required>
	</div>
	<div class="w3-col s6" class="sub">
			<label>Address</label></br>
			<input type="text" name="address" value="<?= $row['address'] ?>" required></br>
			<h3>Case Details</h3>
			
			<label>Crime Comitted</label> </br>
			<select name="crime">
				<?php 
				$crime_query = "SELECT * FROM `crime_list`";
				$crime_result = $conn->query($crime_query);
				while($inmate_crime = $crime_result->fetch_assoc()):
					$selected = ($inmate_crime['id'] == $row['crime_id']) ? 'selected' : '';
				?>
				<option <?= $selected ?>>
					<?= $inmate_crime['name'] ?>
				</option>
				<?php endwhile; ?>
			</select>

			</br>
			<?php
			$query = "SELECT * FROM `inmate_list` WHERE `id` = {$_GET['id']}";
			$result = $conn->query($query);
			if($result){
				$row = $result->fetch_assoc();
			}
			?>
			<label>Sentence</label></br>
			<input type="text" name="sentence" value="<?= $row['sentence'] ?>" required></br>

			<label>Time Serve Start</label></br>
			<input type="date" name="tss" value="<?= $row['date_from'] ?>" required placeholder='yyyy-mm-dd'></br>
			</br>
			<label>Time Serve Ends</label></br>
			<input type="date" name="tse" value="<?= $row['date_to'] ?>" required placeholder='yyyy-mm-dd'></br>
			</br>
			<h3>Emergency Contact Details</h3>

			<label>Full Name</label></br>
			<input type="text" name="fullname"  value="<?= $row['emergency_name'] ?>" required></br>

			<label>Relation</label></br>
			<input type="text" name="relation" value="<?= $row['emergency_relation'] ?>" required></br>
			</br>
			<label>Contact</label></br>
			<input type="text" name="contact" value="<?= $row['emergency_contact'] ?>" required>
			</br>
			 

		</div>
</br>
</br>
		<h3>Image</h3>
			
			<label>Inmate Image</label>
			
			<input type="file" name="img" placeholder="Click to change image" required>
			</br></br>

			<center><button type="submit" name='submit'>Update</button></center>
		</div>
		
		<div class="container"> 
		<a href="inmates.php"><button type="button" class="cancelbtn">  Cancel </button> </a>
		</div> 
		</form> 
	</div> 

    <?php require_once('req\footer.php');?>