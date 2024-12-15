<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licenced under the following license:
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
	$hubID = $_GET['hub_id'];
	include('db_login.php');
	$lat_centro='';
	$long_centro='';
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT * FROM routes INNER JOIN airports ON airports.ident = routes.arrival  WHERE hub_id = $hubID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	$index=-1;
	while ($row = $result->fetch_assoc()) {
		$index++;
		$flights_coordinates [$index] = array ($row["latitude_deg"],  $row["longitude_deg"] ,  $row["ident"],  $row["name"] ) ;
	}
	$sql = "SELECT * FROM  hubs h  INNER JOIN airports a on a.ident=h.hub WHERE h.hub_id = $hubID ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$lat_centro = $row["latitude_deg"];
		$long_centro = $row["longitude_deg"];
	}
?>
<div class="container">
	<div class="row">
		<div id="map-outer" class="col-md-12">
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
		background-color:#FFFFF;
		width:100%;
		height:480px}
	#map-container { height: 100%}
</style>
</body>
<script type="text/javascript">
	function init_map() {
		var locations = <?php echo json_encode($flights_coordinates); ?>;
		console.log(locations);
		var var_location = new google.maps.LatLng(<?php echo $lat_centro; ?>,<?php echo $long_centro; ?>);
		var var_mapoptions = {
			center: var_location,
			zoom: 5,
			styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]
		};
		var var_map = new google.maps.Map(document.getElementById("map-container"),
			var_mapoptions);
		var k=0;
		var arr_long= locations.length;
		while (k<arr_long) {
			dep = var_location;
			arr = new google.maps.LatLng(locations[k][0], locations[k][1]);
			var icon_red = 'images/airport_runway_red.png';
			var icon_green = 'images/airport_runway_green.png';
			var icon_red = '';
			var icon_green = '';
			var marker_dep = new google.maps.Marker({
				position: dep,
				icon: icon_green
			});
			var marker_arr = new google.maps.Marker({
				position: arr,
				icon: icon_green
			});
			marker_dep.setMap(var_map);
			marker_arr.setMap(var_map);
			var var_marker = new google.maps.Polyline({
				path: [dep, arr],
				geodesic: true,
				strokeColor: '#FF0000',
				strokeOpacity: 1.0,
				strokeWeight: 2
			});
			var_marker.setMap(var_map);
			var marker_dep = new google.maps.Marker({
				position: dep,
				icon: icon_green
			});
			var marker_arr = new google.maps.Marker({
				position: arr,
				icon: icon_green
			});
			marker_dep.setMap(var_map);
			marker_arr.setMap(var_map);
			k++;
		}
	}
	google.maps.event.addDomListener(window, 'load', init_map);
</script>
</html>
