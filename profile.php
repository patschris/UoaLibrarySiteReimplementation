<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/profile.css">
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
	
	$userId = $_SESSION['id'];
	
	include 'db_connection.php';
	
	$q = "select users.*,Username,uoadepartments.Name as UoaName from users,connectioninfo,uoadepartments where users.Id = '$userId' and users.Id = Users_Id and Department = uoadepartments.Id;";
	if (!empty($q)) {
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q) or die("Query failed");
		$row = mysqli_fetch_object($results);
	}
	mysqli_close($conn);
?>

<body>
<div class="container">
  	<div class="row">
	    <div class="col-md-12">
	        <div class="tabbable">
				<ul class="nav nav-tabs">
	            	<li class="active"><a href="#profile" data-toggle="tab">Το προφίλ μου</a></li>
	            	<li><a href="#bookList" data-toggle="tab">Λίστα δανεισμένων βιβλίων</a></li>
	            	<li><a href="#extendRentForms" data-toggle="tab">Αιτήσεις επέκτασης δανεισμών</a></li>
	          	</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<table class="profileTable">
							<tr>
								<th rowspan="8">
									<?php 
										if (empty( $row -> Image ))	echo '<img src="images/photo.jpg" id="image" />';
										else echo '<img src="data:image/jpeg;base64,'.base64_encode( $row -> Image ).'" id="image" />';
									?>
								</th>
								<th>Όνομα:</th>
								<td><?php echo $row -> Name?></td>
							</tr>
							<tr>
								<th>Επώνυμο:</th>
								<td><?php echo $row -> Surname?></td>
							</tr>
							<tr>
								<th>Ημερομηνία γέννησης:</th>
								<td><?php echo $row -> Birthday?></td>
							</tr>
							<tr>
								<th>Email:</th>
								<td><?php echo $row -> Email?></td>
							</tr>
							<tr>
								<th>Αριθμός μητρώου:</th>
								<td><?php echo $row -> RegistrationNumber?></td>
							</tr>
							<tr>
								<th>Τμήμα:</th>
								<td><?php echo $row -> UoaName?></td>
							</tr>
							<tr>
								<th>Εξάμηνο φοίτησης:</th>
								<td><?php echo $row -> Semester?></td>
							</tr>
							<tr>
								<th>Ιδιότητα:</th>
								<td><?php echo $row -> Position?></td>
							</tr>
						</table>
		            </div>
		            <div class="tab-pane" id="bookList">
						<?php include 'bookListRent.php';?>
		            </div>
		            <div class="tab-pane" id="extendRentForms">
						<?php include 'extendRentForms.php';?>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

<?php include "footer.php"; ?>