<?php
if (isset ( $_POST ['btnSearch'] )) {
	if (isset($_POST['filterByName'])){
		$filterByName = $_POST ["filterByName"];
		session_start();
		$_SESSION["filterByName"] = $filterByName;
		header('Location: filterByName.php');
	}
	else if (isset($_POST['filterByLocation'])){
		$filterByLocation = $_POST ["filterByLocation"];
		session_start();
		$_SESSION["filterByLocation"] = $filterByLocation;
		header('Location: filterByLocation.php');
	}
	else if (isset($_POST['filterByDepartment'])){
		$filterByDepartment = $_POST ["filterByDepartment"];
		if ($filterByDepartment =='0')	{
			header('Location: libraries.php');
			exit;
		}
		else{
			session_start();
			$_SESSION["filterByDepartment"] = $filterByDepartment;
			header('Location: filterByDepartment.php');
		}
	}
}
?>