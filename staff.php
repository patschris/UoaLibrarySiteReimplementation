<?php
	include 'db_connection.php';

	$libraryId = $_SESSION['libraryId'];

	$q3 = "select * from staff where Library = '$libraryId'";
	
	if (!empty($q3)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results3 = mysqli_query($conn,$q3) or die("Query failed");
		
		echo '<table class="table table-striped">';
		while($row3 = mysqli_fetch_object($results3)){
			echo '<tbody><tr><th><b>'.$row3 -> Name.' '.$row3 -> Surname.'</b></th>';
			if ($row3 -> JobPosition == null) echo '<td>Βιβλιοθηκονόμος</td>';
			else echo '<td>'.$row3 -> JobPosition.'</td>';
			echo '<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>  '.$row3 -> Email.'</td>';
			echo '<td><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>  '.$row3 -> Tel.'</td></tr></tbody>';
		}
		echo '</table>';
	}
	mysqli_close($conn);
?>