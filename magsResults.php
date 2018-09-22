<?php
	include 'db_connection.php';
	if (!empty($q3)) { 	// show magazines' results
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$qc3) or die("Query failed");
		$magazines = 0;
		while ($row = mysqli_fetch_object($results)) $magazines = $row -> c; // magazines' counter

		echo  '<div class="materialList">';

		if ($magazines == 1) echo '<p><b>Περιοδικά - '.$magazines.' αποτέλεσμα</b></p>';
		else echo '<p><b>Περιοδικά - '.$magazines.' αποτελέσματα</b></p>';
		
		echo '<ul class="list-group">';
		if ($magazines > 0) {
			mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
			mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
			$results = mysqli_query($conn,$q3) or die("Query failed");

			while ($row = mysqli_fetch_object($results)) {
				echo '<li class="list-group-item"><a href="resultDetails.php?id='.$row -> Id.'">'.$row -> Title.'</a>';
				echo '<br><b>Εκδόσεις: </b>'.$row -> Publications;
				echo '<br><b>ISSN: </b>'.$row -> Issn;
				echo '</li>';
			}
		}
		else {
			echo '<li class="list-group-item">Δε βρέθηκαν περιοδικά</li></ul>';
		}
		echo '</ul></div>';
	}
	else {
		echo '<p><b>Περιοδικά - 0 αποτελέσματα</b></p>';
		echo '<ul class="materialList">';
		echo '<li>Δε βρέθηκαν περιοδικά</li></ul>';
	}
	mysqli_close($conn);
?>