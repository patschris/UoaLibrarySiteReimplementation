<?php
	include 'db_connection.php';
	if (!empty($q1)) { 	// show books' results	
		$results = mysqli_query($conn,$qc1) or die("Query failed qc1");
		$books = 0;
		while ($row = mysqli_fetch_object($results))
			$books = $row -> c; // books' counter
		echo  '<div class="materialList">';
		if ($books == 1)
			echo '<p><b>Βιβλία - '.$books.' αποτέλεσμα</b></p>';
		else
			echo '<p><b>Βιβλία - '.$books.' αποτελέσματα</b></p>';
		echo '<ul class="list-group">';
		if ($books > 0) {
			mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
			mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
			$results = mysqli_query($conn,$q1) or die("Query failed q1");
			while ($row = mysqli_fetch_object($results)) {
				echo '<li class="list-group-item"><a href="resultDetails.php?id='.$row -> Id.'">'.$row -> Title.'</a>';
				echo '<br><b>Συγγραφέας: </b>'.$row -> Author;
				echo '<br><b>ISBN: </b>'.$row -> Isbn; 
				echo '</li>';
			}
		}
		else {
			echo '<li class="list-group-item">Δε βρέθηκαν βιβλία</li></ul>';
		}
		echo '</ul></div>';
	}
	else {
		echo '<p><b>Βιβλία - 0 αποτελέσματα</b></p>';
		echo '<ul class="materialList">';
		echo '<li>Δε βρέθηκαν βιβλία</li></ul>';
	}
	mysqli_close($conn);
?>