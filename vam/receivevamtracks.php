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
$tracksInserted=0;
$data = json_decode(file_get_contents('php://input'), true);
$dataLenght = count($data);

include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
$flightid='';
for ($x=0; $x < $dataLenght ;$x++)
{

	$flight_id = $data[$x]["flight_id"];
	$track_id = $data[$x]["track_id"];
	$ias = $data[$x]["ias"];
	$gs = $data[$x]["gs"];
	$heading = $data[$x]["heading"];
	$altitude = $data[$x]["altitude"];
	$radio_altitude = $data[$x]["agl"];
	$fuel = $data[$x]["fuel"];
	$fuel_used = $data[$x]["fuel_used"];
	$latitude = $data[$x]["latitude"];
	$longitude = $data[$x]["longitude"];
	$time_passed = $data[$x]["time_passed"];
	$time_flag = $data[$x]["time_flag"];
	$oat = $data[$x]["oat"];
	$wind_deg = $data[$x]["wind_deg"];
	$wind_knots = $data[$x]["wind_knots"];
	$perc_completed = $data[$x]["perc_completed"];
	$flight_status = $data[$x]["flight_status"];
	$plane_type = $data[$x]["plane_type"];
	$pending_nm = $data[$x]["pending_nm"];

	$sql = "insert into vam_track (
	  flight_id  ,
	  track_id  ,
	  ias  ,
	  gs  ,
	  heading  ,
	  radio_altitude ,
	  altitude  ,
	  fuel  ,
	  fuel_used  ,
	  latitude  ,
	  longitude  ,
	  time_passed  ,
	  time_flag ,
	  perc_completed,
	  oat,
	  wind_deg,
	  wind_knots,
	  flight_status,
	  plane_type,
	  pending_nm
	)
	values
	(
	'$flight_id',
	'$track_id',
	'$ias',
	'$gs',
	'$heading',
	'$radio_altitude',
	'$altitude',
	'$fuel',
	'$fuel_used',
	'$latitude',
	'$longitude',
	'$time_passed',
	'$time_flag',
	'$perc_completed',
	'$oat',
	'$wind_deg',
	'$wind_knots',
	'$flight_status',
	'$plane_type',
	'$pending_nm'
	)";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$tracksInserted = $tracksInserted + 1;
}
	$sql= "DELETE FROM vam_live_acars where flight_id='$flight_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	$sql= "DELETE FROM vam_live_flights where flight_id='$flight_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

echo $tracksInserted;

?>
