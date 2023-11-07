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
<div id="id01" class="modal2" > 
		<form class="inmate animate" action=""> 
			<h2><center>Inmate Details</center></h2>
			<div>
			<Center><img src="<?= $row['image_path'] ?>" class="w3-circle" style="width:100px;height:100px;border:10px" alt="profile pic"></Center>
			</div>
		<div class="w3-row" class="container" class="sob">
			<div class="w3-col s6" class="sub"> 
			<b>Code</b></br>
			<p><?= $row['code'] ?></p>
			<b>Prison & Cell Block</b> </br>
			<p><?= $row['cell_id'] ?></p>
			</br>
			<b>First Name</b></br>
			<p><?= $row['firstname'] ?></p> </br>

			<b>Middle Name</b></br>
			<p><?= $row['middlename'] ?></p>
			</br>
			<b>Last Name</b></br>
			<p><?= $row['lastname'] ?></p></br>

			<b>Date of Birht</b></br>
			<p><?= $row['dob'] ?></p>
			</br>
			<b>Sex</b> </br>
			<p><?= $row['sex'] ?></p></br>

			<b>Marital Status</b> </br>
			<p><?= $row['marital_status'] ?></p>
			</br>
			<b>Complexion</b></br>
			<p><?= $row['complexion'] ?></p></br>

			<b>Eye Color</b></br>
			<p><?= $row['eye_color'] ?></p>
			<b>Address</b></br>
			<p><?= $row['address'] ?></p></br>
	</div>
	<div class="w3-col s6" class="sub">
			
			<h3>Case Details</h3>
						
			<b>Crime Comitted</b> </br>
			
			<p><?= $row['crime'] ?></p>
			
			</br>
			
			<b>Sentence</b></br>
			<p><?= $row['sentence'] ?></p></br>

			<b>Time Serve Start</b></br>
			<p><?= $row['date_from'] ?></p></br>
			</br>
			<b>Time Serve Ends</b></br>
			<p><?= $row['date_to'] ?></p></br>
			</br>
			<h3>Emergency Contact Details</h3>

			<b>Full Name</b></br>
			<p><?= $row['emergency_name'] ?></p></br>

			<b>Relation</b></br>
			<p><?= $row['emergency_relation'] ?></p></br>
			</br>
			<b>Contact</b></br>
			<p><?= $row['emergency_contact'] ?></p>
			</br>
			 

		</div>
</br>
</br>
		</div>
		
		 
		</form> 
    </div> 
    
    <?php require_once('req\footer.php');?>