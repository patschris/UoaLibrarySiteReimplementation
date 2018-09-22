<?php
	include 'db_connection.php';
	
	$libraryId = $_SESSION['libraryId'];
	
	$q2 = "select * from generalinfo where Id = '$libraryId'";
	
	if (!empty($q2)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results2 = mysqli_query($conn,$q2) or die("Query failed");
		$row2 = mysqli_fetch_object($results2);
	}
	
	mysqli_close($conn);
?>


<p><?php echo $row2 -> History?></p>
<table class="generalInfo">
	<tr>
		<th align="left"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <u>Διεύθυνση</u></th>
		<th align="left"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <u>Ώρες λειτουργίας</u></th>
	</tr>
	<tr>
		<td rowspan="2"><?php echo $row2 -> Address?> <?php echo $row2 -> ZipCode?></td>
		<td>Χειμερινό ωράριο: <?php echo $row2 -> WorkHoursWinter?></td>
		
	</tr>
	<tr><td>Εαρινό ωράριο: <?php echo $row2 -> WorkHoursSummer?></td></tr>
	<tr>
		<th rowspan="9">
			<input id="lat" type="hidden" name="lat" value="<?php echo $row2 -> PosX?>">
			<input id="lng" type="hidden" name="lng" value="<?php echo $row2 -> PosY?>">
			<script src="js/maps.js"></script>
			<div id="googleMap"></div>
		</th>
		<th align="left">&nbsp;</th>
	</tr>
	<tr><th align="left">&nbsp;</th></tr>
	<tr><th align="left"><u>Επικοινωνία</u></th></tr>
	<tr><td><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo $row2 -> Tel?></td></tr>
	<tr><td><b>fax: </b><?php echo $row2 -> FAX?></td></tr>
	<tr><td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $row2 -> Email?></td></tr>
	<tr><th align="left">&nbsp;</th></tr>
	
	<?php 
		if (!empty($row2 -> Notes))
			echo '<tr><th align="left"><u>Σημειώσεις</u></th></tr>
					<tr><td align="left">'.$row2 -> Notes.'</td></tr>';
		else 
			echo '<tr><th align="left">&nbsp</th></tr>
					<tr><td align="left">&nbsp</td></tr>';
	?>
</table>