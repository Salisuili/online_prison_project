<?php 
  require_once("req\Navbar.php");

  $username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($query);
  if($result){
    $result = $result->fetch_assoc();	
  } 
  $prof_pic = $result['avatar'];
  $username = ucfirst($result['firstname']);

  $prison_list = $cell_block = $crimes = $actions = $current_inmates = $released_inmate = $today_visit = 0;

  $query = "SELECT * FROM `prison_list`";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $prison_list += 1;
      }
    
  $query = "SELECT * FROM `cell_list`";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $cell_block += 1;
      }

  $query = "SELECT * FROM `crime_list`";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $crimes += 1;
      }

  $query = "SELECT * FROM `action_list`";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $actions += 1;
      }

  $query = "SELECT * FROM `inmate_list` WHERE `status` = 1";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $current_inmates += 1;
      }

  $query = "SELECT * FROM `inmate_list` WHERE `status` = 0";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $released_inmate += 1;
      }
    
  $query = "SELECT * FROM `visit_list`";
  $result = $conn->query($query);
  while($row = $result->fetch_assoc()){
    $today_visit += 1;
      }


?>
<main>
			<div class="head-title">
				<div class="left">
					<h1>Online Prison Management Sytem</h1>
					<ul class="breadcrumb">
						Welcome Back &nbsp;&nbsp;<?=  ucfirst($username) ?>
					</ul>
				</div>
				
			</div>
<!--BODY -->
<div class="container">
  <div class="box-container">
  
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $prison_list ?></h2>
		<p>Prison List</p>
      </div>
    </div>
  
    
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $cell_block ?></h2>
		<p>Cell Block</p>
      </div>
    </div>
  
    
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $crimes ?></h2>
		<p>Crimes</p>
      </div>
    </div>
  
    
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $actions ?></h2>
		<p>Actions</p>
      </div>
    </div>
  
    
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $current_inmates ?></h2>
		<p>Current Inmates</p>
      </div>
  </div>
  
  
	<div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $released_inmate ?></h2>
		<p>Released Inmates</p>
      </div>
  </div>
  
	
    <div class="box">
      <div class="box-content">
        <h2 style="margin:0px;"><?= $today_visit ?></h2>
		<p>Today's Visits</p>
      </div>
    </div>
  
<center><div class="container-fluid text-center">
  <img src="img\cover.png" alt="system-cover" id="system-cover" class="img-fluid">
</div>
</center>
  </div>
</div>
</main>

<?php require_once('req\footer.php');?>