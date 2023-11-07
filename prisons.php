<?php 
require_once('req/Navbar.php');
$_SESSION['message']='';
if(isset($_POST['delete'])){
	$delId = $_GET['id'];
	$query = "DELETE FROM `prison_list` WHERE id = '$delId'";
	$result = $conn->query($query);
	if($result){
        $_SESSION['message'] = "Record Deleted Successfully";
	}else{
		$_SESSION['message'] = "Unable to Delete Record";
    }
}

if(isset($_POST['submit'])){
$pname = $_POST['pname'];
$query = "INSERT INTO `prison_list`(`name`) VALUES ('$pname')";
$result = $conn->query($query);
if($result){
	$_SESSION['message'] = "Prison Added";
	header('Location:prisons.php');
}else{
	$_SESSION['message'] = "Unable to Add Prison";
	header('Location:prisons.php');
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
  <a href="#" class="w3-button w3-white w3-hover-white"><b>List of Prison</b></a> 
  <a href="#" class="w3-button w3-green right" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><b>+</b>Create New</a>
  
</div>
<div class="w3-card table">
			<table id="list" class="w3-table w3-striped w3-bordered w3-hoverable">
				<colgroup>
					<col width="10%">
					<col width="30%">
					<col width="35%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="w3-light-grey">
						<th class="w3-center">#</th>
						<th class="w3-center">Date Created</th>
						<th class="w3-center">Name</th>
						<th class="w3-center">Status</th>
						<th class="w3-center">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
						$qry = $conn->query("SELECT * from `prison_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?> 
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class=""><?= $row['name'] ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="w3-text-blue">Active</span>
                                <?php else: ?>
                                    <span class="w3-text-red">Inactive</span>
                                <?php endif; ?>
                            </td>
					<td>
					<div class="dropdown">
						<a class="w3-center" href="javascript:void(0)" >&nbsp;&nbsp;Action&nbsp;↓</a>
						<div class="dropdown-content">
						<a href="edit_prison.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-light-grey">Edit</a>
						<form action="prisons.php?id=<?= $row['id']?>" method="POST">
						<button name='delete' class='w3-button w3-text-red'style='margin-left:5px;width:100%;text-align:left;'>Delete</button>
						</form>
						</div>
					</div>
					</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
	</div>
	</div>


	<!--  MODEL HERE  -->

	<div id="id01" class="modal"> 
		<form class="modal-content animate" action="prisons.php" method="POST"> 
			<h2><center>Prison Registration</center></h2>
		<div class="w3-row" class="sob">
 
			<label>Name</label></br>
			<input type="text" name="pname" required> </br>

	    </div></br></br>

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
