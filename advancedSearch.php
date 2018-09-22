<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" type="text/css" href="css/advancedSearch.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>
body {
    background-image: url("images/minimal-background-pattern-wordpress-2.jpg");
}
</style>

<?php
	session_start();
		if(isset($_SESSION['id'])) include "loggedIn.php";
        else include "login.php";
		include 'menu.php';
?>
	
<body>
<div class="advancedSearch">
	<h4><b>Σύνθετη Αναζήτηση</b></h4>
	<form method="post" action="advancedSearch_post.php" class="form-horizontal">
		<table class="tableAdvancedSearch">
		<tr>
		<td>
		<div class="form-group">
			<label for="control-label"> Γενικός όρος: </label>
		      <input type="text" class="form-control" name="general">
		</div>
		</td>
		<td>
		<div class="form-group">
		    <label for="control-label">Τίτλος:</label>
		    <input type="text" class="form-control" name="title">
		</div>
		</td>
		</tr>
		<tr>
		<td>
		<div class="form-group">
		    <label for="control-label">Συγγραφέας:</label>
		    <input type="text" class="form-control" name="author">
		</div>
		</td>
		<td>
	    <div class="form-group">
	      	<label for="control-label">Εκδόσεις:</label>
	      	<input type="text" class="form-control" name="publications">
	    </div>
	    </td>
	    <tr>
	    <td>
		<div class="form-group">
	      	<label for="control-label">ISBN/ISSN:</label>
	      	<input type="text" class="form-control" name="code">
	    </div>
	    </td>
	    <td>
		<div class="form-group">
		    <label for="form-group">Επιλέξτε τύπο αποτελέσματος:</label>
	    	<select class="form-control" name="materialType">
		        <option value="0">Όλα</option>
		        <option value="1">Βιβλίο</option>
		        <option value="2">Άρθρο</option>
		        <option value="3">Περιοδικό</option>
	    	</select>
      	</div>
      	</td>
      	</tr>
      	<tr>
      	<td>
      	<div class="form-group">
		    <label for="form-group">Επιλογή βιβλιοθήκης:</label>
	    	<select class="form-control" name="library">
		        <option value="0"> Όλες </option>
				<option value="1"> Βιβλιοθήκη Αγγλικής Γλώσσας και Φιλολογίας </option>
				<option value="2"> Βιβλιοθήκη Γαλλικής Γλώσσας και Φιλολογίας </option>
				<option value="3"> Βιβλιοθήκη Επιστημών Υγείας </option>
				<option value="4"> Βιβλιοθήκη Προσχολικής Αγωγής </option>		
				<option value="5"> Βιβλιοθήκη Σχολής Θετικών Επιστημών </option>
				<option value="6"> Βιβλιοθήκη Νομικής </option>	
	    	</select>
      	</div>
      	</td>
      	</tr>
      	</table>
	   	<button type="submit" id="btn_advancedSearch" name="advancedSearch" class="btn btn-warning">Αναζήτηση</button>
  		
  	</form>
</div>
</body>

<?php include "footer.php";?>