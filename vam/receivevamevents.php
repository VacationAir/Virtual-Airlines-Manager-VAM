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
$eventsInserted=0;
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
	$event_id = $data[$x]["event_id"];
	$flight_id = $data[$x]["flight_id"];
	$event_description = $data[$x]["event_description"];
	$event_timestamp = $data[$x]["event_timestamp"];
	$ias = $data[$x]["ias"];
	$altitude = $data[$x]["altitude"];
	$radio_altimeter = $data[$x]["radio_altimeter"];
	$fuel = $data[$x]["fuel"];
	$fuel_used = $data[$x]["fuel_used"];
	$log_time = $data[$x]["log_time"];
	$landing_vs = $data[$x]["landing_vs"];
	$flaps = $data[$x]["flaps"];
	$light_nav = $data[$x]["light_nav"];
	$light_taxi = $data[$x]["light_taxi"];
	$light_sto = $data[$x]["light_sto"];
	$light_lnd = $data[$x]["light_lnd"];
	$light_bea = $data[$x]["light_bea"];
	$heading = $data[$x]["heading"];
	$critical = $data[$x]["critical"];
	$sql = "insert into vamevents (event_id,
	flight_id,
	event_description,
	event_timestamp,
	ias,
	altitude,
	radio_altimeter,
	heading,
	fuel,
	fuel_used,
	log_time,
	landing_vs,
	flaps,
	light_nav,
	light_taxi,
	light_sto,
	light_lnd,
	light_bea,
	critical) 
	values (
	'$event_id',
	'$flight_id',
	'$event_description',
	'$event_timestamp',
	'$ias',
	'$altitude',
	'$radio_altimeter',
	'$heading',
	'$fuel',
	'$fuel_used',
	'$log_time',
	'$landing_vs',
	'$flaps',
	'$light_nav',
	'$light_taxi',
	'$light_sto',
	'$light_lnd',
	'$light_bea',
	'$critical')";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$eventsInserted = $eventsInserted + 1;
}
echo $eventsInserted;
?>
