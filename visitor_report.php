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
  <a href="#" class="w3-button w3-white w3-hover-white"><b>Monthly Visitors Report</b></a> 
  <a href="#" class="w3-button w3-blue right" id="print" style="width:auto;">Print</a>
  
</div>
<div class="w3-card table">
			<table id="list" class="w3-table w3-striped w3-bordered w3-hoverable">
				<colgroup>
                    <col width="10%">
                    <col width="20%">
                    <col width="25%">
                    <col width="25%">
                    <col width="20%">
				</colgroup>
				<thead>
					<tr class="w3-light-grey">
						<th class="w3-center">#</th>
						<th class="w3-center">Date Created</th>
						<th class="w3-center">Inmate</th>
						<th class="w3-center">Visitor</th>
						<th class="w3-center">Contact #</th>
					</tr>
				</thead>
				<tbody>
				<?php 
                            $i = 1;
                            $qry = $conn->query("SELECT v.*, i.code, concat(i.lastname,', ', i.firstname, coalesce(concat(' ', i.middlename), '')) as `inmate` from `visit_list` v inner join inmate_list i on v.inmate_id = i.id where date_format(v.date_created, '%Y-%m') = '{$month}' order by abs(unix_timestamp(v.date_created)) desc ");
                            while($row = $qry->fetch_assoc()):
                               
                            ?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?= date("M d, Y h:i A", strtotime($row['date_created'])) ?></td>
							<td>
                                <div style="line-height:1em">
                                     <div><b><?= $row['inmate'] ?></b></div>
                                    <div>Inmate - <?= $row['code'] ?></div>
                                </div>
                            </td>
							<td class="text-center">
                                <div style="line-height:1em">
                                    <div><b><?= $row['fullname'] ?></b></div>
                                    <div><?= $row['relation'] ?></div>
                                </div>
                            </td>
					        <td><?= $row['contact'] ?></td>
					    </tr>
					<?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                                <tr>
                                    <td class="py-1 text-center" colspan="5">No records found</td>
                                </tr>
                    <?php endif; ?>
				</tbody>
			</table>
	</div>
	</div>

    <script>
document.getElementById("print").addEventListener("click", function() {
  var printWindow = window.open('', '_blank');
  printWindow.document.write('<html><head><title>Prison Management System Monthly Visitors Report</title>');

  printWindow.document.write('<link rel="stylesheet" type="text/css" href="styles/print-styles.css">');
  printWindow.document.write('</head><body>')

  // Add your header content
  var headerContent = '<h1 style="text-align: center;">Prison Management System Monthly Visitors Report</h1>';
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