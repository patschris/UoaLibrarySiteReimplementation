<?php
if (isset ( $_POST ['resultDetails'] )) {
	
	session_start();
	
	$materialId = $_SESSION['materialId'];
	$userId = $_SESSION['id'];
	
	include 'db_connection.php';
	
	$today = date('d/m/Y', strtotime("today"));
	$returnDay  = date('d/m/Y', strtotime("+7 Days"));
	
	$q = "insert into rent (Material, Users, Start, End) VALUES ('$materialId', '$userId', '$today', '$returnDay');";
 
	if (!empty($q)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q) or die("Query failed");
	}
	
	mysqli_close($conn);
	
	include 'db_connection.php';
	
	$q2 = "update material set Counter = Counter - 1 where Id = '$materialId'";
	
	if (!empty($q2)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$results = mysqli_query($conn,$q2) or die("Query failed");
	}
	
	mysqli_close($conn);
	
	include 'sessionFunctions.php';
 	goback();
}