<?php
require_once('req/Navbar.php');

if (isset($_POST['submit'])) {
    $inmate_id = $_POST['inmate_id'];
    $fullname = $_POST['fullname'];
    $relationship = $_POST['relationship'];
    $contact = $_POST['contact'];

    $update_query = "UPDATE `visit_list` SET `inmate_id` = '$inmate_id', `fullname` = '$fullname', `relation` = '$relationship', `contact` = '$contact' WHERE `id` = {$_GET['id']}";

    if ($conn->query($update_query) === TRUE) {
		$_SESSION['message'] = "Record Updated Successfully";
        header("Location: visitors.php"); 
        exit;
    } else {
        $_SESSION['message'] = "Error updating record: " . $conn->error;
    }
}

$query = "SELECT * FROM `visit_list` WHERE `id` = {$_GET['id']}";
$result = $conn->query($query);
if ($result) {
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
		<form class="modal-content animate" action="edit_visitor.php?id=<?= $_GET['id']?>" method="POST"> 
			<h2><center>Visitor Details Modification</center></h2>
		<div class="w3-row" class="sob">
 
			<label>Inmate Name</label> </br>
			<select name="inmate_id">
				<?php 
				$inmate_query = "SELECT * FROM `inmate_list`";
				$inmate_result = $conn->query($inmate_query);
				while($inmate_row = $inmate_result->fetch_assoc()):
					$selected = ($inmate_row['id'] == $row['inmate_id']) ? 'selected' : ''; // Check if current inmate ID matches the row's inmate ID
				?>
				<option value="<?= $inmate_row['id'] ?>" <?= $selected ?>>
					<?= ucfirst($inmate_row['firstname']) . " " . $inmate_row['middlename'] . $inmate_row['lastname'] ?>
				</option>
				<?php endwhile; ?>
			</select>

			</br>
			<?php $query = "SELECT * FROM `visit_list` WHERE `id` = {$_GET['id']}";
				$result = $conn->query($query);
				if($result){
					$row = $result->fetch_assoc();
				}
				?>
			<label>Visitor's Full Name</label></br>
			<input type="text" name="fullname" value="<?= $row['fullname']?>" required> </br>

			</br>
			<label>Relationship</label></br>
			<input type="text" name="relationship" value="<?= $row['relation']?>" required></br>

			<label>Contact</label></br>
			<input type="text" name="contact" value="<?= $row['contact']?>" required>
	    </div>

		<center><button type="submit" name="submit"><a href="index.php">Update</a></button></center>        
		
		<div class="container"> 
		<a href="visitors.php"><button type="button" class="cancelbtn">  Cancel  </button> </a>
		</div> 
		</form> 
	</div> 

    <?php require_once('req\footer.php');?>