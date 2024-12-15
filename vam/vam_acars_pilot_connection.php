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
	$pilot = strtoupper($data["pilot"]);
	$password = $data["password"];
	$Encrypt_Pass = md5($password);
	$exists = 0;
	$id='FAIL';

	$departure = '';
	$arrival = '';
	$route = '';
	$alternative = '';
	$flight = '';
	$etd = '';
	$duration = '';
	$plane_icao = '';
	$duration = '';
	$registry = '';
	$pax='';
	$cargo='';
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT * FROM gvausers where activation=1 and UPPER(callsign)='" . $pilot . "' and password='" . $Encrypt_Pass . "'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$exists = 1;
		$id = $row['gvauser_id'];
	}
	if ($exists != 0) {
	$sql = "update fleets set booked=0 ,gvauser_id=NULL , booked_at=NULL where booked=1 and hangar=0 and gvauser_id=$id and fleet_id not in (select fleet_id from reserves)";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
	}

	$sql = "select departure, arrival, flproute,alternative,flight,etd,duration, plane_icao,registry, re.pax as pax, re.cargo as cargo from reserves re inner join fleets f on re.fleet_id=f.fleet_id inner join routes r on re.route_id=r.route_id inner join fleettypes ft on ft.fleettype_id = f.fleettype_id where re.gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$exists = 1;
		$departure = $row['departure'];
		$arrival = $row['arrival'];
		$route = $row['flproute'];
		$alternative = $row['alternative'];
		$flight = $row['flight'];
		$etd = $row['etd'];
		$plane_icao = $row['plane_icao'];
		$duration = $row['duration'];
		$registry = $row['registry'];
		$pax = $row['pax'];
		$cargo = $row['cargo'];
	}


	$json[]= array(
		'id' => $id,
		'departure' => $departure,
		'arrival' => $arrival,
		'alternative' => $alternative ,
		'route' => $route,
		'callsign' => $flight,
		'etd' => $etd,
		'plane_icao' => $plane_icao,
		'duration' => $duration,
		'registry' => $registry,
		'pax' => $pax,
		'cargo' => $cargo
	);
		$jsonstring = json_encode($json);
		echo $jsonstring;
	}
	else{
		echo 'FAIL';
	}
?>
