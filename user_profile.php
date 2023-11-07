<?php 
require_once('req/Navbar.php');
$userEmail = $_SESSION['userEmail'];

	$query = "SELECT * FROM `user` WHERE `email` = $userEmail";
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
<h3>User Profile</h3>
</div>
			<div class="w3-blue" style="width:90%;margin-left:5%;margin-right:5%;">
        <h3 style="margin-left:10px;"><img class="w3-circle" src="<?= $row['avatar'] ?>" alt="pic" style="width:60px; height:60px;"> Profile Details</h3>
        <div class="w3-container w3-text-black w3-padding w3-white">
            <h4>First Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= ucfirst($row['firstname']) ?></h4>
            <h4>Other Names: &nbsp;&nbsp;&nbsp;&nbsp;<?= ucfirst($row['middlename']) . " " . ucfirst($row['lastname'])?></h4>
            <h4>User Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['username'] ?></h4>
            <h4>Email Address: &nbsp;&nbsp;&nbsp;&nbsp;<?= $row['email'] ?></h4>
            <h4>Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********</h4>
            <center><a href="edit_profile.php" class="btn w3-button w3-red">Edit Profile</a></center>
        </div>
    </div> 
    
    
    <?php require_once('req\footer.php');?>