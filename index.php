<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/searchBar.css">
<link rel="stylesheet" type="text/css" href="css/home.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>University of Athens - Libraries</title>
</head>

	<?php 
		include 'sessionFunctions.php';
		if ( is_session_started() === FALSE ) session_start();
		if(isset($_SESSION['id'])) include "loggedIn.php";
		else include "login.php";
		include "menu.php";
		include "searchBar.php";
		include "home.php";
		include "footer.php";
	?>
</html>