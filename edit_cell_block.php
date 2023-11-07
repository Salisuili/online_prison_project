<?php 
require_once('req/Navbar.php');

$id = $_GET['id'];

	$query = "SELECT * FROM `cell_list` WHERE `id` = $id";
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
		<form class="modal-content animate" action="edit_cell_block_pros.php?id=<?= $_GET['id']?>" method="POST"> 
			<h2><center>Cell Blocks Details Modification</center></h2>
		<div class="w3-row" class="sob">
 
            <label>Prison</label></br>
			<?php 
			if($row['prison_id']==1){
				$prison = "men prison";
			}elseif($row['prison_id']==2){
				$prison = "women prison";
			}
			?>
			<input type="text" name="prison" value="<?= $prison ?>" required> </br>
            <label>Name</label></br>
			<input type="text" name="cellname" value="<?= $row['name']?>" required> </br>
			</br>
			<label>Status</label></br>
			<select name="status">
                <option>Active</option>
                <option>Inactive</option>
            </select>

	    </div></br></br>

		<center><button type="submit" name="submit">Update</button></center>        
		
		<div class="container"> 
		<a href="cell_blocks.php"><button type="button" class="cancelbtn">  Cancel  </button> </a>
		</div> 
		</form> 
	</div> 

    <?php require_once('req\footer.php');?>