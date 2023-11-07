<?php 
require_once('req/Navbar.php');

$id = $_GET['id'];

	$query = "SELECT * FROM `prison_list` WHERE `id` = $id";
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


<div id="id01" class="modal" style="display:block"> 
		<form class="modal-content animate" method="POST" action="edit_prison_pros.php?id=<?= $_GET['id']?>" > 
			<h2><center>Prison Details Modification</center></h2>
		<div class="w3-row" class="sob">
 
			<label>Prison Name</label> </br>
			<input type="text" name="pfname" value="<?= $row['name']?>" required> </br>
			</br>
			
			<label>Status</label></br>
			
			<select name="active">
                <option>Active</option>
                <option>Inactive</option>
            </select>
	    </div></br></br>

		<center><button name="submit" type="submit">Update</button></center>        
		
		<div class="container"> 
		<a href="prisons.php"><button type="button" class="cancelbtn">  Cancel  </button> </a>
		</div> 
		</form> 
	</div> 

    <?php require_once('req\footer.php');?>