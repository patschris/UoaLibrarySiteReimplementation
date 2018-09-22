<?php
	session_start(); // Starting Session
	$error = '';
	// database connection
	include 'db_connection.php';	
	if (empty($_POST['username']) || empty($_POST['password'])) {
		echo "Username or Password is invalid";
	}
	else {
		$username=$_POST['username'];
		$password=$_POST['password'];
	}
	mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
	mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
	$results = mysqli_query($conn,"select * from connectioninfo where Password='$password' AND Username='$username'");
	if ( $results == false ) {
		echo " Query failed!";
	}
	else {
		while ($row = mysqli_fetch_object($results)) {
			$_SESSION['id'] = $row -> Users_Id;
			$_SESSION['username'] = $username;
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	mysqli_close($conn);
?>
	

