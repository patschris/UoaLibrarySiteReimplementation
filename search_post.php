<?php
if (isset ( $_POST ['search'] )) {
	$general = $_POST ["general"];
	
	$q1=""; $qc1=""; $q2=""; $qc2=""; $q3=""; $qc3="";
	if (!empty($general)) {
		$a="";
		if (!empty($general))
			$a.= "((Title like '%".$general."%') or (Isbn like '%".$general."%') or Issn like ('%".$general."%') or Publisher like ('%".$general."%') or Publications like ('%".$general."%'))";
		
		$q1="select * from material where (";
		$qc1="select count(*) as c from material where (";
		if (!empty($a)) {
			$q1.=$a." and Type='1');";
			$qc1.=$a." and Type='1');";
		}
		$q2="select * from material where (";
		$qc2="select count(*) as c from material where (";
		if (!empty($a)) {
			$q2.=$a." and Type='2');";
			$qc2.=$a." and Type='2');";
		}
		$q3="select * from material where (";
		$qc3="select count(*) as c from material where (";
		if (!empty($a)) {
			$q3.=$a." and Type='3');";
			$qc3.=$a." and Type='3');";
		}
	}
	else {
		$q1 = "select * from material where Type='1';";
		$qc1 = "select count(*) as c from material where Type='1';";
		$q2 = "select * from material where Type='2';";
		$qc2 = "select count(*) as c from material where Type='2';";
		$q3 = "select * from material where Type='3';";
		$qc3 = "select count(*) as c from material where Type='3';";
	}
	include 'searchResults.php';	
	echo '<table class="tableResults"><tr><th class="th">';
	include 'booksResults.php';
	echo '</th><th class="th">';
	include 'articlesResults.php';
	echo '</th><th class="th">';
	include 'magsResults.php';
	echo '</th></tr></table>';
	echo '</div></body>';
	include 'footer.php';
}