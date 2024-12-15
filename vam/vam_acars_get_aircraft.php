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
	$allow_select="";
	$fleet_id = '';
	$name = '';
	$plane_icao = '';
	$registry = '';

	$i=0;

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

	$sql = "SELECT * FROM va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$allow_select = $row['allow_select_aircraft_for_charter'];
	}



	if ($exists != 0 && $allow_select==1) {

		$sql = "select gva.location as location ,f.fleet_id,f.name, f.registry,ft.plane_icao  from fleettypes_gvausers ftgva inner join gvausers gva on gva.gvauser_id = ftgva.gvauser_id inner join fleets f on f.fleettype_id = ftgva.fleettype_id inner join fleettypes ft on ft.fleettype_id=f.fleettype_id and f.fleettype_id=ftgva.fleettype_id and f.location=gva.location and f.booked=0 and f.hangar=0 and gva.gvauser_id=$id";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$json = NULL;
		while ($row = $result->fetch_assoc()) {
			$fleet_id = $row['fleet_id'];
			$name = $row['name'];
			$plane_icao = $row['plane_icao'];
			$registry = $row['registry'];
			$location_icao = $row['location'];
			$json[$i]= array(
			'location_icao' => $location_icao,
			'fleet_id' => $fleet_id,
			'name' => $name,
			'plane_icao' => $plane_icao ,
			'registry' => $registry
			)	;

			$i=$i + 1;
		}

			$jsonstring = json_encode($json);
			echo $jsonstring;
	}
	else{
		echo 'FAIL';
	}
?>
