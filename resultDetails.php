<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/resultDetails.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/searchBar.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
body{
background-image: url("images/minimal-background-pattern-wordpress-2.jpg");
   
}
</style>
<script>
function btnRent() {
    alert("Πρέπει να συνδεθείτε πρώτα");
}

function btnAlreadyRent(){
	alert("Το έχετε δανειστεί ήδη");
}
</script>

<?php
	include 'sessionFunctions.php';
	if ( is_session_started() === FALSE ) session_start();
	if(isset($_SESSION['id'])){
		include "loggedIn.php";
		$userId = $_SESSION['id'];
	}
	else {
		include "login.php";
	}
	include 'menu.php';
	include 'searchBar.php';
	
	$materialId=$_GET['id'];
	$_SESSION['materialId'] = $materialId;
	
	include 'db_connection.php';
	
	$q = "select * from material where Id = $materialId;";
	if (!empty($q)) {
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q) or die("Query failed");
		$row = mysqli_fetch_object($results);
	}
	$materialName = $row -> Title;
	$materialLibrary = "";
?>

<body>
	<div class="container" id="resultDetails">
		<table id="tableResult">
			<tr>
				<td rowspan="6"> 
					<?php	if (empty( $row -> Image ))	echo '<img src="images/no_image_available.jpeg" id="image" />';
						else echo '<img src="data:image/jpeg;base64,'.base64_encode( $row -> Image ).'" id="image" />';?>
				</td>
				<td><h4><b><?php echo $row -> Title ?></b></h4></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><?php if (empty( $row -> Author )) echo 'Εκδόσεις:'.$row -> Publisher;
	    				else echo 'Συγγραφέας: '.$row -> Author;?>
	    		</td>
	    		<td>&nbsp;</td>
	    	</tr>
			<tr>
				<td><?php if (empty( $row -> ISBN )) echo 'ISSN:'.$row -> Issn;
	    				else echo 'ISBN:'.$row -> Isbn;?>
	    		</td>
	    		<td>&nbsp;</td>
	    	</tr>
	    	
			<tr><td>Αριθμός σελίδων: <?php echo $row -> Pages ?></td><td>&nbsp;</td></tr>
			<tr><td>
			<?php 
				if ( $row -> Counter > 0){
	    			include 'db_connection.php';
	    			$q1 = "select Name from libraries,eamuser44.material where libraries.Id = material.Library and material.Id =".$row -> Id.";";
	    		
		    		if (!empty($q1)) {
		    			mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		    			mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		    			$results1 = mysqli_query($conn,$q1) or die("Query failed q1");
		    			$row1 = mysqli_fetch_object($results1);
		    			
		    			$materialLibrary = $row1 -> Name;
		    			
		    			echo '<font color="#004000"><b>Διαθέσιμο: </b></font>'.$materialLibrary;
						mysqli_close($conn);
		    		}
				}
				else {
					echo '<font color="#b30000"><b>Μη διαθέσιμο</b></font>';
				}
	    	?>
			
			</td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td>
			<td class="buttons">
				<div class="input-group">
					<span class="input-group-btn">
						<?php if ($row -> Ebook == 1)	echo '<button type="submit" id="btnEbook" class="btn btn-default">Σε ηλεκτρονική μορφή</button>'?>
						<?php 
							if ($row -> Counter > 0){
								if(isset($_SESSION['id'])){
			
									include 'db_connection.php';
									$q2 = "select Id from rent where material = $materialId and Users = $userId ;";
									
									if (!empty($q2)) {
										mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
										mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
										$results2 = mysqli_query($conn,$q2) or die("Query failed");
										$row2 = mysqli_fetch_object($results2);
										
										if (!empty($row2))	echo '<button type="button" class="btn btn-default" id="btnRent" onclick="btnAlreadyRent()">Προσθήκη για δανεισμό</button>';
										else 	echo '<button type="button" class="btn btn-default" id="btnRent" data-dismiss="modal" data-toggle="modal" data-target="#modal_rentMaterial_loggedIn">Προσθήκη για δανεισμό</button>';
										
									}
									mysqli_close($conn);
									
								}
								else { 
									echo '<button type="button" class="btn btn-default" id="btnRent" onclick="btnRent()">Προσθήκη για δανεισμό</button>';
								}
							}
						?>	
					</span>
				</div>
				
				<div class="modal fade" id="modal_rentMaterial_loggedIn" role="dialog">
					<div class="modal-dialog modal-md">
						<form method="post" action="resultDetails_post.php" class="modal-content">
					        <div class="modal-body" align="center">
					          	<p>Θέλετε να προστεθεί στον λογαριασμό σας; <br><b><?php echo $materialName?></b> </p>
					          	<br>
					          	<p>Θα μπορείτε να το παραλάβετε από: <b><?php echo $materialLibrary?></b></p>
					          	<p>Ημερομηνία επιστροφής: <b><?php $d=strtotime("+7 Days");echo date("d/m/Y", $d)?></b> </p>
					        </div>
					        <div class="modal-footer">
					          	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Ακύρωση</button>
						        <button type="submit" name="resultDetails" class="btn btn-warning" >Εντάξει</button>
					        </div>
			      		</form>
				    </div>
			  	</div>
			
			</td></tr>
		</table>
		
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#contents">Περιεχόμενα</a></li>
			<li><a data-toggle="tab" href="#summary">Περίληψη</a></li>
		</ul>
	
		<div class="tab-content">
		    <div id="contents" class="tab-pane fade in active">
		      <h3>Περιεχόμενα</h3>
		      <p><?php echo $row -> Contents ?></p>
		    </div>
		    <div id="summary" class="tab-pane fade">
		      <h3>Περίληψη</h3>
		      <p><?php echo $row -> Summary ?></p>
		    </div>
		</div>
	</div>
</body>
	
<?php include 'footer.php';?>