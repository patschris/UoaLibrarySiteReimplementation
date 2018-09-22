<?php 
	include 'db_connection.php';
	$q3 = "select *,material.Id as materialId from material,rent where Users = '$userId' and rent.Material = material.Id and rent.Extend = 1;";
?>

<div>
	<ul class="list-group" id="bookListRent">
		<?php	
			if (!empty($q3)) {
				mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
				mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
				$results3 = mysqli_query($conn,$q3) or die("Query failed");
				
				if (mysqli_num_rows($results3)==0) {
					echo '<div class="noResults"><p>Δεν υπάρχουν αιτήσεις επέκτασης.</p></div>';
				}
				else{ 
					while($row3 = mysqli_fetch_object($results3)){?>
							<li class="list-group-item">
								<?php
									if ($row3 -> Type == '1')
										echo '<a href="resultDetails.php?id='.$row3 -> materialId.'"><h4><b>'.$row3 -> Title.', '.$row3 -> Author.'</b></h4></a>';
									else 
										echo '<a href="resultDetails.php?id='.$row3 -> materialId.'"><h4><b>'.$row3 -> Title.', '.$row3 -> Publisher.'</b></h4></a>';?>
								<table class="tableDetails">
									<tr>
									<td>
									<?php 
										if ($row3 -> Type == '1')
											echo '<b>ISBN: </b>'.$row3 -> Isbn;
										else
											echo '<b>ISSN: </b>'.$row3 -> Issn;
									?>
									</td>
									<td>Ημερομηνία δανεισμού: <?php echo $row3 -> Start?></td>
									<td>&nbsp;</td>
									</tr>
									<tr>
									<td>&nbsp;</td>
									<td><font color="red">Ημερομηνία επιστροφής: <?php echo $row3 -> End?></font></td>
									</tr>	
								</table>
							</li>
			<?php
					}
				}
			}
			mysqli_close($conn);?>
	</ul>
</div>