var lat,lng;

function codeAddress() {
			
		lat = document.getElementById("lat").value;
		lng = document.getElementById("lng").value;
		
	    //console.log('GPS: ' + lat + ' GPS: ' + lng);
	      
	    initialize();
}
google.maps.event.addDomListener(window, 'load', codeAddress);
		
function initialize() {
	var map = new google.maps.Map(document.getElementById('googleMap'), {
	    zoom: 15,
	    center:new google.maps.LatLng(lat,lng),
	});
	
	var marker = new google.maps.Marker({
	    position: new google.maps.LatLng(lat,lng),
	    map: map
	 });
	
}

