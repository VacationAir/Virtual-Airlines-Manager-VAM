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
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT * , DATE_FORMAT(register_date,'$va_date_format') as register_date FROM gvausers where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$user_type = $row['user_type_id'];
		$pilotname = $row['name'];
		$pilotsurname = $row['surname'];
		$callsign = $row['callsign'];
		$id = $row['gvauser_id'];
		$location = $row['location'];
		$usertype = $row['user_type_id'];
		$hub_id = $row['hub_id'];
		$register_date = $row['register_date'];
		$rank_id = $row['rank_id'];
		$email = $row['email'];
		$country = $row['country'];
		$city = $row['city'];
		$transfered_hours = $row['transfered_hours'];
		$pilot_image = './uploads/'.$row['pilot_image'];
	}
	// Get Hub info details
	$sql = "SELECT * FROM airports a INNER  JOIN hubs h on a.ident = h.hub where hub_id=$hub_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$hub_airport_name = $row['name'];
		$hub_airport_flag = $row['iso_country'];
	}
	// Get Location info details
	$sql = "SELECT * FROM airports  where ident='$location'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$location_airport_name = $row['name'];
		$location_airport_flag = $row['iso_country'];
	}
	$no_count_rejected=0;
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$no_count_rejected = $row["no_count_rejected"];
	}
	$gva_hours=0;
	if ($no_count_rejected==1)
	{
		$sql = "select sum(time) as gva_hours from v_total_data_flight_no_rejected where pilot=$pilotID group by pilot";
	}
	else
	{
		$sql = "select sum(time) as gva_hours from v_total_data_flight where pilot=$pilotID group by pilot";
	}
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$gva_hours = round($row['gva_hours'] , 2);
	}
	$sql = "select format(sum(quantity),2) money from bank where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$money = $row["money"];
	}
	//  Get count number of manual pireps for pilot's stadistics
	$sql = "select count(pirep_id) numpireps from pireps where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pireps = $row["numpireps"];
	}
	//  Get count number of regular manual pireps for pilot's stadistics
	$sql = "select count(pirep_id) numpireps from pireps where gvauser_id=$pilotID and charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pireps_reg = $row["numpireps"];
	}
	//  Get distancer of regular manual pireps for pilot's stadistics
	$sql = "select sum(distance) distance from pireps where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_pireps = $row["distance"];
	}
	// Get FS Keeper flights for pilot's stadistics
	$sql = "select count(*) flights from pirepfsfk where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fskeeper = $row["flights"];
	}
	// Get Regular FS Keeper flights for pilot's stadistics
	$sql = "select count(*) flights from pirepfsfk where gvauser_id=$pilotID and charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fskeeper_reg = $row["flights"];
	}
	// Get FS Keeper distance for pilot's stadistics
	$sql = "select sum(DistanceRoute) distance from pirepfsfk where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_fskeeper = $row["distance"];
	}
	// Get FS ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from reports where pilot_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fsacars = $row["flights"];
	}
	// Get Regular FS ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from reports where pilot_id=$pilotID and charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fsacars_reg = $row["flights"];
	}
	//  Get plane certifications
	$sql = "select plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id=$pilotID order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$planes = '';
	$planes_certificated = array();
	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$planes .= $row["plane_icao"] . '</br>';
		$planes_certificated[$i] = $row["plane_icao"];
		$i++;
	}
	// Get hub
	$sql = "select hub from hubs where hub_id=$hub_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$hub = $row["hub"];
	}
	// Get Rank
	$sql = "select rank,salary_hour,image_url from ranks where rank_id=$rank_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$rank = $row["rank"];
		$salary_hour = $row["salary_hour"];
		$rank_url_image = $row["image_url"];
	}
	// Get Country
	$sql = "select * from country_t where iso2='$country'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country = $row["short_name"];
		$country_flag = $row["iso2"];
	}
	// Get VA  parameters
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$currency = $row["currency"];
	}
	// VAM 2.2 BEGIN
	// Get VAM ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from vampireps where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_vamacars = $row["flights"];
	}
	//  Get distancer of VAM ACARS for pilot's stadistics
	$sql = "select sum(distance) distance from vampireps where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_vamacars = $row["distance"];
	}
	// Get Regular VAM ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from vampireps where gvauser_id=$pilotID and charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_vamacars_reg = $row["flights"];
	}
	// Get FS ACARS distance for pilot's stadistics
	$sql = "select sum(distance) as distance from reports where pilot_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_fsacars = $row["distance"];
	}
	// VAM 2.3 BEGIN
	// Get rejected flights
	$num_pireps_rejected= 0;
	$num_pireps_reg_rejected = 0;
	$dist_pireps_rejected = 0 ;
	$num_fskeeper_rejected =  0;
	$num_fskeeper_reg_rejected = 0;
	$dist_fskeeper_rejected = 0;
	$num_fsacars_rejected = 0;
	$num_fsacars_reg_rejected = 0;
	$dist_fsacars_rejected =  0;
	$num_vamacars_rejected =  0;
	$dist_vamacars_rejected =  0;
	$num_vamacars_reg_rejected = 0;
	if ($no_count_rejected==1)
	{
		//  Get count number of manual pireps for pilot's stadistics
		$sql = "select count(pirep_id) numpireps from pireps where  gvauser_id=$pilotID and valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_pireps_rejected = $row["numpireps"];
		}
		//  Get count number of regular manual pireps for pilot's stadistics
		$sql = "select count(pirep_id) numpireps from pireps where  gvauser_id=$pilotID and charter=0 and valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_pireps_reg_rejected = $row["numpireps"];
		}
		//  Get distancer of regular manual pireps for pilot's stadistics
		$sql = "select sum(distance) distance from pireps where  gvauser_id=$pilotID and valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_pireps_rejected = $row["distance"];
		}
		// Get FS Keeper flights for pilot's stadistics
		$sql = "select count(*) flights from pirepfsfk where gvauser_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fskeeper_rejected = $row["flights"];
		}
		// Get Regular FS Keeper flights for pilot's stadistics
		$sql = "select count(*) flights from pirepfsfk where gvauser_id=$pilotID and charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fskeeper_reg_rejected = $row["flights"];
		}
		// Get FS Keeper distance for pilot's stadistics
		$sql = "select sum(DistanceRoute) distance from pirepfsfk where gvauser_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_fskeeper_rejected = $row["distance"];
		}
		// Get FS ACARS flights for pilot's stadistics
		$sql = "select count(*) flights from reports where pilot_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fsacars_rejected = $row["flights"];
		}
		// Get Regular FS ACARS flights for pilot's stadistics
		$sql = "select count(*) flights from reports where pilot_id=$pilotID and charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fsacars_reg_rejected = $row["flights"];
		}
		// Get VAM ACARS flights for pilot's stadistics
		$sql = "select count(*) flights from vampireps where gvauser_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_vamacars_rejected = $row["flights"];
		}
		//  Get distancer of VAM ACARS for pilot's stadistics
		$sql = "select sum(distance) distance from vampireps where gvauser_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_vamacars_rejected = $row["distance"];
		}
		// Get Regular VAM ACARS flights for pilot's stadistics
		$sql = "select count(*) flights from vampireps where gvauser_id=$pilotID and charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_vamacars_reg_rejected = $row["flights"];
		}
		// Get FS ACARS distance for pilot's stadistics
		$sql = "select sum(distance) as distance from reports where pilot_id=$pilotID and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_fsacars_rejected = $row["distance"];
		}
	}
?>
