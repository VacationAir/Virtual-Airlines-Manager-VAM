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
$data = json_decode(file_get_contents('php://input'), true);
$dataLenght = count($data);
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
for ($x=0; $x < $dataLenght ;$x++)
{
	$gvauser_id= $data[$x]["pilotId"];
	$departure= $data[$x]["departure"];
	$arrival= $data[$x]["arrival"];
	$flightId = $data[$x]["flightId"];
	$ias = $data[$x]["ias"];
	$heading = $data[$x]["heading"];
	$gs = $data[$x]["gs"];
	$altitude = $data[$x]["altitude"];
	$fuel = $data[$x]["fuel"];
	$fuel_used = $data[$x]["fuel_used"];
	$latitude = $data[$x]["latitude"];
	$longitude = $data[$x]["longitude"];
	$time_passed = $data[$x]["time_passed"];
	$perc_completed = $data[$x]["perc_completed"];
	$oat = $data[$x]["oat"];
	$wind_deg = $data[$x]["wind_deg"];
	$wind_knots = $data[$x]["wind_knots"];
	$flight_status = $data[$x]["flight_status"];
	$plane_type = $data[$x]["plane_type"];
	$pending_nm = $data[$x]["pending_nm"];
	$network = $data[$x]["network"];
	$sql = "insert into vam_live_acars (gvauser_id,flight_id,departure,arrival,ias,heading,gs,altitude,fuel,fuel_used,latitude,longitude,time_passed,perc_completed,oat,wind_deg,wind_knots,flight_status,plane_type,pending_nm,network)
	values ('$gvauser_id ','$flightId ','$departure' ,'$arrival' ,'$ias','$heading','$gs','$altitude','$fuel','$fuel_used'
	,'$latitude','$longitude','$time_passed','$perc_completed','$oat','$wind_deg','$wind_knots','$flight_status','$plane_type','$pending_nm','$network')";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$sql = "delete from vam_live_flights where flight_id='$flightId'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$sql = "insert into vam_live_flights (gvauser_id,flight_id,departure,arrival,ias,heading,gs,altitude,fuel,fuel_used,latitude,longitude,time_passed,perc_completed,oat,wind_deg,wind_knots,flight_status,plane_type,pending_nm,network)
	values ('$gvauser_id ','$flightId ','$departure' ,'$arrival' ,'$ias','$heading','$gs','$altitude','$fuel','$fuel_used'
	,'$latitude','$longitude','$time_passed','$perc_completed','$oat','$wind_deg','$wind_knots','$flight_status','$plane_type','$pending_nm','$network')";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
}
$db->close();
echo $sql.'ACARS saved in the system';
?>
