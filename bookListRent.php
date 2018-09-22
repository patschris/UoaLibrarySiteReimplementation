<?php 
	include 'db_connection.php';
	
	$q2 = "select *,material.Id as materialId from material,rent where Users = '$userId' and rent.Material = material.Id and rent.Extend = 0;";
?>

<div>
	<ul class="list-group" id="bookListRent">
		<?php	
			if (!empty($q2)) {
				mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
				mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
				$results2 = mysqli_query($conn,$q2) or die("Query failed");
				
				if (mysqli_num_rows($results2) ==0) {
					echo '<div class="noResults"><p>Δεν έχετε δανειστεί κάτι.</p></div>';
				}
				else {
					while($row2 = mysqli_fetch_object($results2)){?>
							<li class="list-group-item">
								<?php 
									if ($row2 -> Type == '1')
										echo '<a href="resultDetails.php?id='.$row2 -> materialId.'"><h4><b>'.$row2 -> Title.', '.$row2 -> Author.'</b></h4></a>';
									else 
										echo '<a href="resultDetails.php?id='.$row2 -> materialId.'"><h4><b>'.$row2 -> Title.', '.$row2 -> Publisher.'</b></h4></a>';
								?>		
								<table class="tableDetails">
									<tr>
									<td>
									<?php 
										if ($row2 -> Type == '1')
											echo '<b>ISBN: </b>'.$row2 -> Isbn;
										else
											echo '<b>ISSN: </b>'.$row2 -> Issn;
									?>
									</td>
									<td>Ημερομηνία δανεισμού: <?php echo $row2 -> Start?></td>
									<td>&nbsp;</td>
									</tr>
									<tr>
									<td>&nbsp;</td>
									<td><font color="red">Ημερομηνία επιστροφής: <?php echo $row2 -> End?></font></td>
									<td ><button type="button" data-id="<?php echo $row2 -> materialId?>" class="btn btn-default" id="btnExpandRent" data-dismiss="modal" data-toggle="modal" data-target="#modal_rentMaterial_loggedIn">Επέκταση δανεισμού</button></td>
									</tr>	
								</table>
							</li>
			<?php	}
				}
			}
			mysqli_close($conn);?>
	</ul>
	
	<div class="modal fade" id="modal_rentMaterial_loggedIn" role="dialog">
		<div class="modal-dialog modal-sm">
			<form method="post" action="extendRent_post.php" class="modal-content">
		        <div class="modal-body" align="center">
		          	<p>Θέλετε να επεκτείνετε την ημερομηνία επιστροφής;</p>
		          	<input type="hidden" name="bookId" id="bookId" value=""/>
		          	<br>
		          	<button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
			        <button type="submit" name="confirmExtend" class="btn btn-warning" >Εντάξει</button>
		        </div>
      		</form>
	    </div>
  	</div>
</div>