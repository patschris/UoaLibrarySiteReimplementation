<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/library_maps.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>


<?php
	$qX = "select PosX from generalInfo;";
	$qY = "select PosY from generalInfo;";
	$qName = "select Name from generalinfo,libraries where generalinfo.Id = libraries.Id;";
	
	include 'db_connection.php';
	
	if (!empty($qX)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$resultX = mysqli_query($conn,$qX) or die("Query failed");
		$cordinateX = '';
		while ($row = mysqli_fetch_object($resultX)) $cordinateX = $cordinateX.$row -> PosX.'|';
	}
		
	if (!empty($qY)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$resultY = mysqli_query($conn,$qY) or die("Query failed");
		$cordinateY = '';
		while ($row = mysqli_fetch_object($resultY)) cordinateY = $cordinateY.$row -> PosY.'|';
	}
	
	if (!empty($qName)){
		mysqli_query($conn, "SET CHARACTER SET utf8") or die("Query failed");
		mysqli_query($conn, "SET NAMES utf8") or die("Query failed");
		$resultName = mysqli_query($conn,$qName) or die("Query failed");
		$libraryName = '';
		while ($row = mysqli_fetch_object($resultName)) $libraryName = $libraryName.$row -> Name.'|';
	}
	mysqli_close($conn);
?>


<script type="text/javascript">
	jQuery(function($) {
	    // Asynchronously Load the map API 
	    var script = document.createElement('script');
	    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
	    document.body.appendChild(script);
	});

	function initialize() {
	    var map;
	    var bounds = new google.maps.LatLngBounds();
	    var mapOptions = {
	        mapTypeId: 'roadmap'
	    };
	                    
	    // Display a map on the page
	    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	    map.setTilt(45);
	        
	    // Multiple Markers
	    var markers = [
			['Βιβλιοθήκη Αγγλικής Γλώσσας και Φιλολογίας', 37.96905,23.780372],
	        ['Βιβλιοθήκη Γαλλικής Γλώσσας και Φιλολογίας', 37.96905,23.780372],
	        ['Βιβλιοθήκη Επιστημών Υγείας', 37.983698,23.766082],
	        ['Βιβλιοθήκη Προσχολικής Αγωγής ', 37.982887,23.735542],
	        ['Βιβλιοθήκη Σχολής Θετικών Επιστημών - Αναγνωστήριο Πληροφορικής ', 37.968554,23.766981],
	        ['Νομική Βιβλιοθήκη ', 37.982887, 23.735542]
	    ];
	                        
	    // Info Window Content
	    var infoWindowContent = [
	        ['<div class="info_content">' +
	        '<h4>Βιβλιοθήκη Αγγλικής Γλώσσας και Φιλολογίας</h4>' +
	        '<p>Κτήριο Φιλοσοφικής Σχολής, 9ος όροφος, Kυψέλη 929, Παν/πολη Ζωγράφου </p>' +        '</div>'],
	        ['<div class="info_content">' +
		    '<h4>Βιβλιοθήκη Γαλλικής Γλώσσας και Φιλολογίας</h4>' +
		    '<p>Κτήριο Φιλοσοφικής Σχολής - 9ος όροφος, Kυψέλη 928, Παν/πολη Ζωγράφου </p>' +        '</div>'],
		    ['<div class="info_content">' +
			'<h4>Βιβλιοθήκη Επιστημών Υγείας</h4>' +
			'<p>Μικράς Ασίας και Δήλου 1 , Γουδή 1ος όροφος  </p>' +        '</div>'],
		    ['<div class="info_content">' +
			'<h4>Βιβλιοθήκη Προσχολικής Αγωγής </h4>' +
			'<p>Ιπποκράτους 33 - Ημιόροφος, Αθήνα</p>' +        '</div>'],
		    ['<div class="info_content">' +
			'<h4>Βιβλιοθήκη Σχολής Θετικών Επιστημών - Αναγνωστήριο Πληροφορικής </h4>' +
			'<p>Τμήμα Πληροφορικής και Τηλεπικοινωνιών, Νέα Κτήρια, Πανεπιστημιούπολη, Ιλίσια </p>' +        '</div>'],
		    ['<div class="info_content">' +
			'<h4>Νομική Βιβλιοθήκη </h4>' +
			'<p>Ιπποκράτους 33, Αθήνα - Νομική Σχολή  </p>' +        '</div>']
	    ];
	        
	    // Display multiple markers on a map
	    var infoWindow = new google.maps.InfoWindow(), marker, i;
	    
	    // Loop through our array of markers & place each one on the map  
	    for( i = 0; i < markers.length; i++ ) {
	        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
	        bounds.extend(position);
	        marker = new google.maps.Marker({
	            position: position,
	            map: map,
	            title: markers[i][0]
	        });
	        
	        // Allow each marker to have an info window    
	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
	                infoWindow.setContent(infoWindowContent[i][0]);
	                infoWindow.open(map, marker);
	            }
	        })(marker, i));

	        // Automatically center the map fitting all markers on the screen
	        map.fitBounds(bounds);
	    }

	    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
	    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
	        this.setZoom(13);
	        google.maps.event.removeListener(boundsListener);
	    });
	    
	}
</script>
	
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>