<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/libraries.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>
body{background-image: url("images/minimal-background-pattern-wordpress-2.jpg");}
</style>

<?php
	session_start();
	if(isset($_SESSION['id'])) include "loggedIn.php";
	else include "login.php";
	include 'menu.php';
?>

<body>
<table class="tableLibraries">
  <tr>
  	<td class="libSearch"><?php include 'librariesSearch.php';?></td>
    <td  class="libList">
	    <form method='post'>
			<?php 
				include 'db_connection.php';			
				if (!isset($_GET['page']) or !is_numeric($_GET['page']))
					$page = 0; // we give the value of the starting row to 0 because nothing was found in URL otherwise we take the value from the URL
				else
					$page = (int)$_GET['page'];
				
				//this part goes after the checking of the $_GET var
				
				$offset = $page * 5;
				
				$q = "select * from libraries LIMIT $offset, 5";
				mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
				mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
				$results = mysqli_query($conn,$q) or die("Query failed");
				
				$num = mysqli_num_rows($results);
				
				echo '<div><h4 class="libTitle"><b>Όλες οι βιβλιοθήκες ΕΚΠΑ</b></h4>';
			    if($num > 0){
			    	
			        echo '<div class="tableDiv">';
					echo '<table class="table table-striped">';
			        
			        while ($row = mysqli_fetch_object($results)) {
			        	echo '<tbody><tr><th><b>'.$row -> Name.'</b></th>';
			        	echo '<th class="open"><p class="openBtn"><b>Ανοιχτά</b></p></th>';
			        	echo '<th class="more"><a href="libraryDetails.php?id='.$row -> Id.'" class="moreBtn"><b>Περισσότερα</b></a></th></tr></tbody>';
			        }
			        echo '</table></div>';
			        
			    }
					
				//now this is the link..
				$q2 = "select * from libraries ";
				mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
				mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
				$results2 = mysqli_query($conn,$q2) or die("Query failed");
				$numOfResults = mysqli_num_rows($results2);
				
				$numOfResults = ceil($numOfResults/5);
				
				$curPage = $page + 1;
				echo '<p>Σελίδα '.$curPage .' από '.$numOfResults;
				
				if ($page < $numOfResults - 1) echo '<span class="pull-right"><a href="'.$_SERVER['PHP_SELF'].'?page='.($page+1).'">Επόμενη </a></span>';
			   
				$prev = $page - 1;
			
				//only print a "Previous" link if a "Next" was clicked
				if ($prev >= 0) echo '<span class="pull-right"><a href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Προηγούμενη</a>';
				
				echo '</p></div>';
				
				mysqli_close($conn);
			
			?>
		</form>
    </td>
  </tr>
</table>
</body>

<?php include 'footer.php';?>