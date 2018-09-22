<?php
if (isset ( $_POST ['advancedSearch'] )) {
	$general = $_POST ["general"];
	$title = $_POST ["title"];
	$author = $_POST ["author"];
	$publications = $_POST["publications"];
	$code = $_POST ["code"];
	$type = $_POST ["materialType"];
	$library = $_POST ["library"];
	
	$q = "select * from material ";
	$qc ="select count(*) as c from material ";
	$q1=""; $qc1=""; $q2=""; $qc2=""; $q3=""; $qc3="";
	if (!empty($general) || !empty($title) || !empty($author) || !empty($publications) || !empty($code) || $type!=0 || $library!=0) {
		$q.= "where (";
		$qc.= "where (";
		$a="";
		if (!empty($general)) {
			$a.= "((Title like '%".$general."%') or (Isbn like '%".$general."%') or Issn like ('%".$general."%') or Publisher like ('%".$general."%') or Publications like ('%".$general."%'))";
		}
		if (!empty($title)) {
			if (!empty($a)) $a.=" and ";
			$a.="Title like '%".$title."%'";
		}
		if (!empty($author)) {
			if (!empty($a)) $a.=" and ";
			$a.="Author like '%".$author."%'";
		}
		if (!empty($publications)) {
			if (!empty($a)) $a.=" and ";
			$a.="Publications like '%".$publications."%'";
		}
		if (!empty($code)) {
			if (!empty($a)) $a.=" and ";
			$a.="(Isbn = '".$code."' or Issn='".$code."')";
		}
		if ($type!=0) {
			if (!empty($a)) $a.=" and ";
			$a.="Type = ".$type;
		}
		
		if ($library!=0) {
			if (!empty($a)) $a.=" and ";
			$a.="Library = ".$library;
		}
		if ($type==0) {
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
		$q.=$a.");";	
		$qc.=$a.");";
	}
	else {
		$q1 = "select * from material where Type='1';";
		$qc1 = "select count(*) as c from material where Type='1';";
		$q2 = "select * from material where Type='2';";
		$qc2 = "select count(*) as c from material where Type='2';";
		$q3 = "select * from material where Type='3';";
		$qc3 = "select count(*) as c from material where Type='3';";
	}
	
	if ($type==1) { /*books query*/
		$q1=$q;
		$qc1=$qc;
	}
	else if ($type==2) { /*articles query*/
		$q2=$q;
		$qc2=$qc;
	}
	else if ($type==3) { /*magazines query*/
		$q3=$q;
		$qc3=$qc;
	}
	
	include 'searchResults.php';
	
	echo '<table ><tr><th class="th">';
	
	include 'booksResults.php';
	
	echo '</th><th class="th">';
	
	include 'articlesResults.php';
	
	echo '</th><th class="th">';
	
	include 'magsResults.php';
	
	echo '</th></tr></table>';
	
	echo '</div>';
	include 'footer.php';
}