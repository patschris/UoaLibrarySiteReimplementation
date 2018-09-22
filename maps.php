<!DOCTYPE html>
<html> 
<head> 
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
   <title>Google Maps Geometry</title> 
   <script src="http://maps.google.com/maps/api/js?sensor=false" 
           type="text/javascript"></script> 
</head> 
<body> 
   <div id="map" style="width: 400px; height: 300px"></div> 

   <script type="text/javascript"> 
      Number.prototype.toRad = function() {
         return this * Math.PI / 180;
      }

      Number.prototype.toDeg = function() {
         return this * 180 / Math.PI;
      }

      google.maps.LatLng.prototype.destinationPoint = function(brng, dist) {
         dist = dist / 6371;  
         brng = brng.toRad();  

         var lat1 = this.lat().toRad(), lon1 = this.lng().toRad();
         var lat2 = Math.asin(Math.sin(lat1) * Math.cos(dist) + Math.cos(lat1) * Math.sin(dist) * Math.cos(brng));
         var lon2 = lon1 + Math.atan2(Math.sin(brng) * Math.sin(dist) * Math.cos(lat1), Math.cos(dist) - Math.sin(lat1) * Math.sin(lat2));
         if (isNaN(lat2) || isNaN(lon2)) return null;

         return new google.maps.LatLng(lat2.toDeg(), lon2.toDeg());
      }

      var pointA = new google.maps.LatLng(40.70, -74.00);   // Circle center
      var radius = 10;                                      // 10km

      var mapOpt = { 
         mapTypeId: google.maps.MapTypeId.TERRAIN,
         center: pointA,
         zoom: 10
      };

      var map = new google.maps.Map(document.getElementById("map"), mapOpt);

      // Draw the circle
      new google.maps.Circle({
         center: pointA,
         radius: radius * 1000,       // Convert to meters
         fillColor: '#FF0000',
         fillOpacity: 0.2,
         map: map
      });

      // Show marker at circle center
      new google.maps.Marker({
         position: pointA,
         map: map
      });

      // Show marker at destination point
      new google.maps.Marker({
         position: pointA.destinationPoint(90, radius),
         map: map
      });
   </script> 
</body> 
</html>