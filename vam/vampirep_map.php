<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<!DOCTYPE html>
<html>
<head>
<script
      src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ &callback=initMap" type="text/javascript">
</script>
</head>
<body>
<?php
	/* Connect to Database */
	include('./db_login.php');
	$db_map = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db_map->set_charset("utf8");
	if ($db_map->connect_errno > 0) {
		die('Unable to connect to database [' . $db_map->connect_error . ']');
	}
	// Execute SQL query
	$sql_map = "select * from vam_track where flight_id='".$vamflightid ."' order by id asc";
	
	if (!$result = $db_map->query($sql_map)) {
		die('There was an error running the query  [' . $db_map->error . ']');
	}
	unset($flights_coordinates);
	$flights_coordinates = array();
	$datos = array ();
	$index = 0;
	while ($row = $result->fetch_assoc()) {
		
		$flights_coordinates ["latitude"] = $row["latitude"];
		$flights_coordinates ["longitude"] = $row["longitude"];
		$datos[$index] = $flights_coordinates;
		$index++;
	}
	
?>
<div class="container">
	<div class="row">
		<div id="map-outer" class="col-md-11">
			<div id="map-container" class="col-md-12"></div>
		</div><!-- /map-outer -->
	</div> <!-- /row -->
</div><!-- /container -->
<style>
	body { background-color:#FFFFF }
	#map-outer {
		padding: 0px;
		border: 0px solid #CCC;
		margin-bottom: 0px;
		background-color:#FFFFF }
	#map-container { height: 500px }
	@media all and (max-width: 991px) {
		#map-outer  { height: 650px }
	}
</style>
</body>
<script type="text/javascript">
	function init_map() {
		var locations = <?php echo json_encode($datos); ?>;
		var numpoints=(locations.length);
		var var_location = new google.maps.LatLng(<?php echo $datos[0]["latitude"]; ?>,<?php echo $datos[0]["longitude"]; ?>);
		var var_mapoptions = {
			center: var_location,
			zoom: 5,
			styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]
		};
		var map = new google.maps.Map(document.getElementById('map-container'),
		var_mapoptions);
		
		
		var flightPlanCoordinates=[];
		var k=0;
			
		var coordinate;
		while (k<numpoints) {
			
			coordinate =new google.maps.LatLng(locations[k]['latitude'],locations[k]['longitude']);
			flightPlanCoordinates.push(coordinate);
			k=k+1;
		};
		var flightPath = new google.maps.Polyline({
		path: flightPlanCoordinates,
		geodesic: true,
		strokeColor: '#FF0000',
		strokeOpacity: 1.0,
		strokeWeight: 2
		});
		var icon_red = 'images/airport_runway_red.png';
		var icon_green = 'images/airport_runway_green.png';
		var marker_arr=new google.maps.Marker({
			  position:coordinate,
			  icon: icon_red
			  });
		
		var marker_dep=new google.maps.Marker({
			  position:var_location,
			  icon: icon_green
			  });
		
		marker_arr.setMap(map);
		marker_dep.setMap(map);
		flightPath.setMap(map);
	}
	google.maps.event.addDomListener(window, 'load', init_map);
</script>
</html>
