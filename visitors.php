<?php 
require_once('req/Navbar.php');

$_SESSION['message']='';
if(isset($_POST['delete'])){
	$delId = $_GET['id'];
	$query = "DELETE FROM `visit_list` WHERE id = '$delId'";
	$result = $conn->query($query);
	if($result){
        $_SESSION['message'] = "Record Deleted Successfully";
	}else{
		$_SESSION['message'] = "Unable to Delete Record";
    }
}
 
if(isset($_POST['submit'])){
	$inmate_id = $_POST['fullname'];
	$vfname = $_POST['vfname'];
	$relationship = $_POST['relationship'];
	$contact = $_POST['contact'];
	
	$query = "INSERT INTO `visit_list`(`inmate_id`, `fullname`, `contact`, `relation`) VALUES('$inmate_id','$vfname','$contact','$relationship')";
	$result = $conn->query($query);
    if($result) {
		$_SESSION['message'] = "Record Registered Successfully!";
		header('Location: visitors.php');
		exit();
		}else{
		$_SESSION['message'] = "Unable to Register Record!";
		header('Location: visitors.php');
        exit();
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
  <a href="#" class="w3-button w3-white w3-hover-white"><b>List of Visitors</b></a> 
  <a href="#" class="w3-button w3-green right" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><b>+</b>Create New</a>
  
</div>
<div class="w3-card table">
			<table id="list" class="w3-table w3-striped w3-bordered w3-hoverable">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="30%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="w3-light-grey">
						<th class="w3-center">#</th>
						<th class="w3-center">Date Created</th>
						<th class="w3-center">Inmate</th>
						<th class="w3-center">Visitor</th>
						<th class="w3-center">Phone</th>
						<th class="w3-center">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
						$qry = $conn->query("SELECT v.*, i.code, concat(i.lastname,', ', i.firstname, coalesce(concat(' ', i.middlename), '')) as `inmate` from `visit_list` v inner join inmate_list i on v.inmate_id = i.id order by abs(unix_timestamp(v.date_created)) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class="">
								<div style="line-height:1em">
									<div><b><?= $row['inmate'] ?></b></div>
									<div>Inmate - <?= $row['code'] ?></div>
								</div>
							</td>
							<td class="">
								<div style="line-height:1em">
									<div><b><?= $row['fullname'] ?></b></div>
									<div><?= $row['relation'] ?></div>
								</div>
							</td>
							<td class="text-center">
                               <?= $row['contact'] ?>
                            </td>
					<td>
					<div class="dropdown">
						<a class="w3-center" href="javascript:void(0)" >&nbsp;&nbsp;Action&nbsp;↓</a>
						<div class="dropdown-content">
						<a href="edit_visitor.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-light-grey">Edit</a>
						<form action="visitors.php?id=<?= $row['id']?>" method="POST">
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
		<form class="modal-content animate" action="visitors.php" method="POST"> 
			<h2><center>Visitor Registration</center></h2>
		<div class="w3-row" class="sob">
 
			<label>Inmate Name</label> </br>
			<select name='fullname' required>
			
			<?php 
				
                $cells = $conn->query("SELECT * FROM `inmate_list`");
                while($row = $cells->fetch_assoc()):
            ?>
            <option value="<?=$row['id']?>"><?= ucfirst($row['firstname'])." ".$row['middlename']." ".$row['lastname'] ?></option>
            <?php endwhile; ?>

			</select>
			</br>
			<label>Visitor's Full Name</label></br>
			<input type="text" name="vfname" required> </br>

			</br>
			<label>Relationship</label></br>
			<input type="text" name="relationship" required></br>

			<label>Contact</label></br>
			<input type="text" name="contact" required>
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
