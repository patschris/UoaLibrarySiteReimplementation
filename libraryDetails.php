<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/libraryDetails.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>

<style>
body{background-image: url("images/minimal-background-pattern-wordpress-2.jpg");}
</style>

<?php
	session_start();
	if(isset($_SESSION['id'])) include "loggedIn.php";
	else include "login.php";
	include 'menu.php';
	$libraryId=$_GET['id'];
	$_SESSION['libraryId'] = $libraryId;
	include 'db_connection.php';
	$q = "select * from libraries where Id = $libraryId;";
	if (!empty($q)) {
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q) or die("Query failed q");
		$row = mysqli_fetch_object($results);
	
	}
	mysqli_close($conn);
?>

<body>
<div class="container">
  	<div class="row">
	    <div class="col-md-12">
			<h3><?php echo $row -> Name?></h3>
	        <div class="tabbable">
				<ul class="nav nav-tabs">
	            	<li class="active"><a href="#generalInfo" data-toggle="tab">Βασικές πληροφορίες</a></li>
	            	<li><a href="#services" data-toggle="tab">Υπηρεσίες</a></li>
	            	<li><a href="#staff" data-toggle="tab">Προσωπικό</a></li>
	            	<li><a href="#collection" data-toggle="tab">Συλλογή</a></li>
	          	</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="generalInfo">
						<?php include 'generalInfo.php';?>
		            </div>
		            <div class="tab-pane" id="services">
						<?php include 'services.php';?>
		            </div>
		            <div class="tab-pane" id="staff">
						<?php include 'staff.php';?>
		            </div>
		            <div class="tab-pane" id="collection">
						<?php include 'collection.php';?>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
		
<?php include "footer.php";?>