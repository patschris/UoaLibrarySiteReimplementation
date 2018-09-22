<?php
	include 'db_connection.php';
	$libraryId = $_SESSION['libraryId'];
	$q4 = "select * from contents where Id = '$libraryId'";
	if (!empty($q4)) {
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results4 = mysqli_query($conn,$q4) or die("Query failed");
		$row4 = mysqli_fetch_object($results4);
	}
	mysqli_close($conn);
?>

<h4><u>Γνωστικό αντικείμενο</u></h4>
<p><?php echo $row4 -> Info?></p>
<br>
<h4><u>Βιβλία</u></h4>
<p><?php echo $row4 -> Books?></p>
<br>
<h4><u>Περιοδικά</u></h4>
<p><?php echo $row4 -> Magazines?></p>
<br>
<h4><u>Λοιπό υλικό</u></h4>
<p><?php echo $row4 -> Rest?></p>