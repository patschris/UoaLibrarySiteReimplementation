<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/searchResults.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/searchBar.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
body{
background-image: url("images/minimal-background-pattern-wordpress-2.jpg");
}
</style>
<?php
	session_start();
	if(isset($_SESSION['username'])) include "loggedIn.php";
	else include "login.php";
	include 'menu.php';
	include 'searchBar.php';
?>

<body><div class="advancedSearchResults">
