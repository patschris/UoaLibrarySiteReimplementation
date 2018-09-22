<?php
	include 'db_connection.php';
	$libraryId = $_SESSION['libraryId'];
	$q3 = "select * from services where Id = '$libraryId'";
	if (!empty($q3)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results3 = mysqli_query($conn,$q3) or die("Query failed");
		$row3 = mysqli_fetch_object($results3);
	}
	mysqli_close($conn);
?>

<h4><u>Πολιτική δανεισμού</u></h4>
<p><?php echo $row3 -> RentingPolicy?></p>

<br><br>

<?php if ($row3 -> Disabilities != null)
	echo '<h4><u>Προσβασιμότητα για άτομα με αναπηρία</u> <img src="images/disabilities.png" height="25px" width="30px" border="1px"></h4>
		<p>'.$row3 -> Disabilities.'</p><br><br>';
?>

<h4><u>Άλλες υπηρεσίες</u></h4>
<p><?php echo $row3 -> GeneralPolicy?></p>