<?php 
session_start();
require_once("header.php");
require_once("database.php");

$userEmail = $_SESSION['userEmail'];
    $query = "SELECT * FROM `users` WHERE email = '$userEmail'";
    $result = $conn->query($query);
    if($result->num_rows > 0){
	  $row = $result->fetch_assoc();
	  $name = ucfirst($row['lastname']) . ", " . ucfirst($row['firstname']);
	  $prof_pic = $row['avatar'];
	}

?>
 
<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">PMS</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="home.php">
					<i class='text2 bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="inmates.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Inmate List</span>
				</a>
			</li>
			<li>
				<a href="visitors.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Visitor List</span>
				</a>
			</li>
			
		</ul>


		<?php if($_SESSION['usertype'] == 1): ?>

		<h4 class="master">Master List</h4>
		<ul class="side-menu top">
			<li>
				<a href="prisons.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Prison List</span>
				</a>
			</li>
			<li>
				<a href="cell_blocks.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Cell Block List</span>
				</a>
			</li>
			<li>
				<a href="crimes.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Crime List</span>
				</a>
			</li>
			<li>
				<a href="actions.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Action List</span>
				</a>
			</li>
			<li>
				<a href="report.php" class="bx bxs-cog">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Inmates Report</span>
				</a>
			</li>
			<li>
				<a href="visitor_report.php" class="bx bxs-cog">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Visitor Report</span>
				</a>
			</li>	
			<?php endif; ?>
		</ul>
	</section>
	
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
        
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Search</a>&nbsp;&nbsp;&nbsp;
			
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
            
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label> &nbsp;&nbsp;&nbsp;
        
				<div class="dropdown">
				<a class="adrop" href="javascript:void(0)" > <img src="<?php echo $prof_pic ?>" class="pic w3-circle" alt="pic"> &nbsp;&nbsp;<?php echo $name; ?></a>
						<div class="dropdown-content">
						<a href="user_profile.php"  class="logbtn w3-button w3-hover-light-grey">Profile</a>
						<?php if($_SESSION['usertype'] == 1): ?>
						<a href="users.php"  class="logbtn w3-button w3-hover-light-grey">System Users</a>
						<?php endif; ?>
						<form action="logout.php" methdod="post">
							<input type="submit" name="submit" style="text-align:left"  class="logbtn w3-button w3-hover-light-grey" value="Logout" name="submit">
						</form>
						</div>
				</div>
			
		</nav>