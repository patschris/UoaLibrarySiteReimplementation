<link rel="stylesheet" type="text/css" href="css/librariesSearch.css">

<div>
	<h4 class="libTitleSearch"><b>Αναζήτηση βιβλιοθηκών ΕΚΠΑ</b></h4>
	
	<form action="librariesSearch_post.php" class="inputSearch" method="post">
	
		<div class="form-group" id="filterByName">
			<label for="name">άνα όνομα:</label>
				<input type="text" name="filterByName" class="form-control" id="name" placeholder="πχ. Νομική "></input>
		</div>
		
		<div class="form-group" id="filterByAddress">
			<label for="location">άνα περιοχή:</label>
				<input type="text" name="filterByLocation" class="form-control" id="location" placeholder="πχ. Πανεπιστημιούπολη "></input>
		</div>
		
		<div class="form-group">
			<label for="filterByDepartment">άνα τμήμα:</label>
			
			<?php 
				$q2 = "SELECT distinct (uoadepartments.Name) FROM uoadepartments,libraries where libraries.Department = uoadepartments.id;";
		
				include 'db_connection.php';
		
				if (!empty($q2)) { 
					mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
					mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
					$results = mysqli_query($conn,$q2) or die("Query failed");
					echo '<select class="form-control" name="filterByDepartment" id="filterByDepartment">';
					echo '<option value="00"></option>';
					echo '<option value="0">Όλα</option>';
					while ($row = mysqli_fetch_object($results)) {
						echo '<option value="'.$row -> Name.'">'.$row -> Name.'</option>';
						$num ++;
					}
					echo '</select>';
				}
				mysqli_close($conn);
			?>
		</div>
		
	    <div class="form-group">
	    	<button class="btn btn-default " type="submit" name="btnSearch" id="btnSearch" >Αναζήτηση</button>
		</div>
				
	</form>
	
	<script>
		$('#name').on('input', function() {
			if($(this).val().length){
		    	$('#location').prop('disabled', true);
		    	$('#filterByDepartment').prop('disabled', true);
		    }
		    else{
		        $('#location').prop('disabled', false);
		    	$('#filterByDepartment').prop('disabled', false);
		    }
		});

		$('#location').on('input', function() {
			if($(this).val().length){
		    	$('#name').prop('disabled', true);
		    	$('#filterByDepartment').prop('disabled', true);
		    }
		    else{
		        $('#name').prop('disabled', false);
		    	$('#filterByDepartment').prop('disabled', false);
		    }
		});

		$('#filterByDepartment').change(function(){
			if($(this).val().length){
		    	$('#location').prop('disabled', true);
		    	$('#name').prop('disabled', true);
		    }
		    else{
		        $('#location').prop('disabled', false);
		    	$('#name').prop('disabled', false);
		    }
		});
	</script>
	
</div>
