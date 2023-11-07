<?php
require_once('req/Navbar.php');
$month = isset($_GET['month']) ? $_GET['month'] : date("Y-m");
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
        <form action="" id="filter-form">
			<legend>Filter</legend>
            <h3>Choose Month</h3>
            <div class="form-group">
            <label for="month" class="control-label">Choose Month</label>
            <input type="month" class="form-control form-control-sm rounded-0" name="month" id="month" value="<?= $month ?>" required="required">
            <button style="width:20%; margin-bottom:5px;" class="w3-button w3-blue">Filter</button>
            </div>
           
        </form>
	</div>

<div class="w3-card container">
<div class="w3-bar">
  <a href="#" class="w3-button w3-white w3-hover-white"><b>Monthly Inmate Report</b></a> 
  <a href="#" class="w3-button w3-blue right" id="print" style="width:auto;margin-left:5px;">Print</a>
  <a href="#" class="w3-button w3-green right" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><b>+</b>Create New</a>
  
</div>
<div class="w3-card table">
			<table id="list" class="w3-table w3-striped w3-bordered w3-hoverable">
				<colgroup>
                    <col width="10%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="35%">
				</colgroup>
				<thead>
					<tr class="w3-light-grey">
						<th class="w3-center">#</th>
						<th class="w3-center">Date Created</th>
						<th class="w3-center">Inmate</th>
						<th class="w3-center">Action</th>
						<th class="w3-center">Remarks</th>
					</tr>
				</thead>
				<tbody>
				<?php 
                    $i = 1;
                    $records = $conn->query("SELECT r.*, a.name as `action`, i.code, concat(i.lastname,', ', i.firstname, coalesce(concat(' ', i.middlename), '')) as `inmate` FROM `record_list` r inner join inmate_list i on r.inmate_id = i.id inner join action_list a on r.action_id = a.id where date_format(r.`date`, '%Y-%m') = '{$month}' order by date(r.date) asc, abs(unix_timestamp(r.date_created)) asc");
                    while($row = $records->fetch_assoc()):
                           
                ?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?= date("M d, Y", strtotime($row['date'])) ?></td>
							<td>
                            <div style="line-height:1em">
                                <div><b><?= $row['inmate'] ?></b></div>
                                <div>Inmate - <?= $row['code'] ?></div>
                            </div>
                            </td>
							<td class="text-center"><?= $row['action'] ?></td>
					        <td><?= $row['remarks'] ?></td>
					    </tr>
					<?php endwhile; ?>
                    <?php if($records->num_rows <= 0): ?>
                                <tr>
                                    <td class="text-center" colspan="5">No records found</td>
                                </tr>
                    <?php endif; ?>
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

document.getElementById("print").addEventListener("click", function() {
  var printWindow = window.open('', '_blank');
  printWindow.document.write('<html><head><title>Prison Management System Monthly Inmate Report</title>');

  printWindow.document.write('<link rel="stylesheet" type="text/css" href="styles/print-styles.css">');
  printWindow.document.write('</head><body>')

  // Add your header content
  var headerContent = '<h1 style="text-align: center;">Prison Management System Monthly Inmate Report</h1>';
  printWindow.document.write(headerContent);

  // Copy the table content
  var tableContent = document.getElementById('list').outerHTML;
  printWindow.document.write(tableContent);

  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.print();
});

</script>

<?php require_once('req\footer.php');?>
