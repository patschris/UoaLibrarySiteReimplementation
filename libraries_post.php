<?php
	include 'libraries.php';
	include 'librariesSearch.php';
	$q = "select * from Libraries;";
	include 'db_connection.php';
	if (!empty($q)) { 
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q) or die("Query failed");
		echo '<div class="libList"><h4 class="libTitle"><b>Βιβλιοθήκες ΕΚΠΑ</b></h4>';
		echo '<table class="table table-striped">';
		while ($row = mysqli_fetch_object($results)) {
			echo '<tbody><tr><th><b>'.$row -> Name.'</b></th>';
			echo '<th class="open"><p class="openBtn"><b>Ανοιχτά</b></p></th>';
			echo '<th class="more"><a href="libraryDetails.php?id='.$row -> Id.'" class="moreBtn"><b>Περισσότερα</b></a></th></tr></tbody>';
		}
		echo '</table></div>';
	}
	mysqli_close($conn);
	include 'footer.php';
?>


<script>$("#search").on("keyup", function() {
    var value = $(this).val();
    $("table tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);
            console.log($row);
            var id = $row.find("th:first").text();
            if (id.indexOf(value) === -1) $row.hide();
            else $row.show();
        }
    });
});
</script>