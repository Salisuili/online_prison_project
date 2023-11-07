<?php require_once('req/Navbar.php');
$_SESSION['message']='';
if(isset($_POST['delete'])){
	$delId = $_GET['id'];
	$query = "DELETE FROM `inmate_list` WHERE id = '$delId'";
	$result = $conn->query($query);
	if($result){
        $_SESSION['message'] = "Record Deleted Successfully";
	}else{
		$_SESSION['message'] = "Unable to Delete Record";
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
</style>

<?php

?>

<div class="w3-card container">
<div class="w3-bar">
  <a href="#" class="w3-button w3-white w3-hover-white"><b>List of Inmates</b></a> 
  
  <a href="#" class="w3-button w3-green right" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><b>+</b>Create New</a>
  
</div>
<?php if(!$_SESSION['message']=='') { echo "<p style='color:green;'>{$_SESSION['message']}</p>"; } ?>
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
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Code</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *,concat(lastname,', ', firstname, coalesce(concat(' ', middlename), '')) as `name` from `inmate_list` order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class=""><?= $row['code'] ?></td>
							<td class=""><?= $row['name'] ?></td>
							<td class="text-center">
                            <?php if(isset($row['date_to']) && !empty($row['date_to']) && strtotime($row['date_to']) <= strtotime(date('Y-m-d'))): ?>
                                    <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Released</span>
                            <?php else: ?>
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
                                <?php endif; ?>
                             <?php endif; ?>
                            </td>
							<td>
					<div class="dropdown">
						<a class="w3-center" href="javascript:void(0)" >&nbsp;&nbsp;Action&nbsp;↓</a>
						<div class="dropdown-content">
						<a href="view_inmate.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-grey" name='view'>View</a>
						<a href="edit_inmate.php?id=<?= $row['id']?>" class="logbtn w3-button w3-hover-grey" name='edit'>Edit</a>
						<form action="inmates.php?id=<?= $row['id']?>" method="POST">
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
	
		<form class="modal-content animate" action="inmates_pros.php" method="POST" enctype="multipart/form-data"> 
			<h2><center>Inmate Registration</center></h2>
			
		<div class="w3-row" class="sob">
			<div class="w3-col s6" class="sub"> 
			<label>Code</label></br>
			<input type="text" name="code" required> </br>
			<label>Prison & Cell Block</label> </br>
			<select name='cell' required>
			<?php 
                $cells = $conn->query("SELECT c.*, p.name as `prison` FROM `cell_list` c inner join prison_list p on c.prison_id = p.id where c.delete_flag = 0 and c.`status` = 1 order by c.`name` asc ");
                while($row = $cells->fetch_assoc()):
            ?>
            <option value="<?= $row['id'] ?>" <?= isset($cell_id) && $cell_id == $row['id'] ? 'selected' : '' ?>><?= $row['prison'] . " - " . $row['name'] ?></option>
            <?php endwhile; ?>
			</select>
			</br> 
			<label>First Name</label></br>
			<input type="text" name="fname" required> </br>

			<label>Middle Name</label></br>
			<input type="text" placeholder="Optional" name="mname">
			</br>
			<label>Last Name</label></br>
			<input type="text" name="lname" required></br>

			<label>Date of Birth</label></br>
			<input type="date" name="dob" required placeholder='yyyy-mm-dd'>
			</br>
			<label>Sex</label> </br>
			<select name='sex' required>
				<option> Male </option>
				<option> Female </option>
			</select></br>

			<label>Marital Status</label> </br>
			<select name='marital_status' required>
				<option> Single </option>
				<option> Married </option>
				<option> Widow </option>
			</select>
			</br>
			<label>Complexion</label></br>
			<input type="text" name="complexion" required></br>

			<label>Eye Color</label></br>
			<input type="text" name="eye" required>
	</div>
	<div class="w3-col s6" class="sub">
			<label>Address</label></br>
			<input type="text" name="address" required></br>
			<h3>Case Details</h3>
			
			<label>Crime Comitted</label> </br>
			<select name='crime' required>
			
			<?php 
            $crimes = $conn->query("SELECT * FROM `crime_list` where delete_flag = 0 and `status` = 1 order by `name` asc ");
             while($row = $crimes->fetch_assoc()):
            ?>
            <option><?= $row['name'] ?></option>
            <?php endwhile; ?>

			</select>
			</br>
			<label>Sentence</label></br>
			<input type="text" name="sentence" required></br>

			<label>Time Serve Start</label></br>
			<input type="date" name="tss" required placeholder='yyyy-mm-dd'></br>
			</br>
			<label>Time Serve Ends</label></br>
			<input type="date" name="tse" required placeholder='yyyy-mm-dd'></br>
			</br>
			<h3>Emergency Contact Details</h3>

			<label>Full Name</label></br>
			<input type="text" name="fullname" required></br>

			<label>Relation</label></br>
			<input type="text" name="relation" required></br>
			</br>
			<label>Contact</label></br>
			<input type="text" name="contact" required>
			</br>
			 

		</div>
</br>
</br>
		<h3>Image</h3>
			
			<label>Inmate Image</label>
			<input type="file" name="img" placeholder="Choose File" required></br></br>

			<center><button type="submit" name='submit'>Register</button></center>
		</div>
		
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
