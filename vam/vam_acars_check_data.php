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
	$data = json_decode(file_get_contents('php://input'), true);
	$flightId = $data[0]["flightId"];
	$numevents=0;
	$numtracks=0;
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT count(*) numinserted FROM vamevents where flight_id='". $flightId."'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$numevents = $row["numinserted"];
	}
	$sql = "SELECT count(*) numinserted FROM vam_track where flight_id='". $flightId."'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$numtracks = $row["numinserted"];
	}
	$json[]= array(
		'numeventsinsertedcheck' => $numevents,
		'numtracksinsertedcheck' => $numtracks,
		);
	$jsonstring = json_encode($json);
	echo $jsonstring;
?>
