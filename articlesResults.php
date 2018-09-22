<?php
	include 'db_connection.php';
	if (!empty($q2)) { 	// show articles' results
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$qc2) or die("Query failed");
		$articles = 0;
		while ($row = mysqli_fetch_object($results)) $articles = $row -> c; // articles' counter
		echo  '<div class="materialList">';
		if ($articles == 1) echo '<p><b>Άρθρα - '.$articles.' αποτέλεσμα</b></p>';
		else echo '<p><b>Άρθρα - '.$articles.' αποτελέσματα</b></p>';
		echo '<ul class="list-group">';
		if ($articles > 0) {
			mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
			mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
			$results = mysqli_query($conn,$q2) or die("Query failed");
			while ($row = mysqli_fetch_object($results)) {
				echo '<li class="list-group-item"><a href="resultDetails.php?id='.$row -> Id.'">'.$row -> Title.'</a>';
				echo '<br><b>Εκδόσεις: </b>'.$row -> Publications;
				echo '<br><b>ISSN: </b>'.$row -> Issn;
				echo '</li>';
			}
		}
		else {
			echo '<li class="list-group-item">Δε βρέθηκαν άρθρα</li></ul>';
		}
		echo '</ul></div>';
	}
	else {
		echo '<p><b>Άρθρα - 0 αποτελέσματα</b></p>';
		echo '<ul class="materialList">';
		echo '<li>Δε βρέθηκαν άρθρα</li></ul>';
	}
	mysqli_close($conn);
?>