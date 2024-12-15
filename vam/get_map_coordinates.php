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
<?php
	/* Connect to Database */
	include('./db_login.php');
	$db_map = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db_map->set_charset("utf8");
	if ($db_map->connect_errno > 0) {
		die('Unable to connect to database [' . $db_map->connect_error . ']');
	}
	// Execute SQL query
	$sql_map = "select * from vam_live_flights";
	if (!$result = $db_map->query($sql_map)) {
		die('There was an error running the query  [' . $db_map->error . ']');
	}
	unset($flights_coordinates);
	unset($flight);
	unset($liveflights);
	unset($datos);
	unset($jsonarray);
	$flights_coordinates = array();
	$datos = array ();
	$flight = array();
	$liveflights = array ();
	$jsonarray = array ();
	$index = 0;
	$index2=0;
	$flightindex=0;
	while ($row = $result->fetch_assoc()) {
			$flight["gvauser_id"]=$row["gvauser_id"];
			$flight["departure"]=$row["departure"];
			$flight["arrival"]=$row["arrival"];
			$flight["latitude"]=$row["latitude"];
			$flight["longitude"]=$row["longitude"];
			$flight["flight_status"]=$row["flight_status"];
			$flight["heading"]=$row["heading"];
			$liveflights[$flightindex] =$flight;
			$sql_map2 = "select * from vam_live_acars where flight_id='".$row["flight_id"]."' order by id asc";
			if (!$result2 = $db_map->query($sql_map2)) {
				die('There was an error running the query  [' . $db_map->error . ']');
			}
			while ($row2 = $result2->fetch_assoc()) {
					$flights_coordinates ["gvauser_id"] = $row2["gvauser_id"];
					$flights_coordinates ["latitude"] = $row2["latitude"];
					$flights_coordinates ["longitude"] = $row2["longitude"];
					$flights_coordinates ["heading"] = $row2["heading"];
					$datos [$index2][$index] = $flights_coordinates;
					$index ++;
			}
			$index=0  ;
			$index2 ++;
			$flightindex ++;
	}
	$jsonarray[0]=$liveflights;
	$jsonarray[1]=$datos;
	echo json_encode( $jsonarray );
?>