<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/contact.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize(){
	var myLatLng = {lat:  37.968698, lng: 23.766981};
	var map = new google.maps.Map(document.getElementById("googleMap"), {
		zoom: 12,
		center: myLatLng
	});

	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: "Υπολογιστικό Κέντρο Βιβλιοθηκών"
	});
}

function loadScript(){
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
	document.body.appendChild(script);
}

window.onload = loadScript;
</script>

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
?>

<body>
	<div class="container">
			<ul class="nav nav-tabs">
            	<li class="active"><a href="#one" data-toggle="tab">Τρόποι επικοινωνίας</a></li>
            	<li><a href="#two" data-toggle="tab">Φόρμα επικοινωνίας</a></li>
          	</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="one">
					<table class="table" style="width:100%">
						<tr>
							<th><div id="googleMap"></div></th>
							<td>
								<ul class="list">
									<li><h3><b>Στοιχεία επικοινωνίας</b></h3></li>
									<li>Υπολογιστικό Κέντρο Βιβλιοθηκών</li>
									<li>Τμήμα Πληροφορικής και Τηλεπικοινωνιών</li>
									<li>Πανεπιστημιούπολη Ζωγράφου</li>
									<li>Τ.Κ. 157 84<br /> &nbsp;</li> 
									<li><b>email:</b> ykb@lib.uoa.gr</li>
									<li><b>fax:</b> 210 727 5614</li>
								</ul>
							</td>
						</tr>
					</table>
	            </div>
            	<div class="tab-pane" id="two">
			 		<form method="post" action="#" class="comForm">
			 		<h3 style="text-align: center;"><b>Φόρμα επικοινωνίας</b></h3>
					    <div class="form-group">
					      <label for="name">Όνομα:</label>
					      <input type="text" class="form-control" id="name">
					    </div>
					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control" id="email">
					    </div>
					    <div class="form-group">
					      <label for="subject">Θέμα μηνύματος:</label>
					      <input type="text" class="form-control" id="subject">
					    </div>
					    <div class="form-group">
					      <label for="message">Μήνυμα:</label>
					      <textarea class="form-control" rows="5" id="message"></textarea>
					    </div>
					    <div class="form-group">
						    <button type="reset" class="btn btn-default" style="float: left;">Ακύρωση</button>
						    <button type="submit" class="btn btn-warning" style="float: right;">Αποστολή</button>
					    </div>
			  		</form>
				</div>
			</div>
		</div>
</body>

<?php include "footer.php";?>