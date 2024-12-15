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
	//  Get va parameters
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$ivao = $row["ivao"];
		$vatsim = $row["vatsim"];
		$va_date_format = $row["date_format"];
	}
	$no_count_rejected=0;
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$no_count_rejected = $row["no_count_rejected"];
	}
	//  Get count number of manual pireps for pilot's stadistics
	$sql = "select count(pirep_id) numpireps from pireps ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pireps = $row["numpireps"];
	}
	//  Get count number of fsacars pireps for pilot's stadistics
	$sql = "select count(report_id) numpireps from reports ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_reports = $row["numpireps"];
	}
	//  Get count number of fsacars regular pireps for pilot's stadistics
	$sql = "select count(report_id) numpireps from reports where charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_reports_reg = $row["numpireps"];
	}
	//  Get count number of regular manual pireps for pilot's stadistics
	$sql = "select count(pirep_id) numpireps from pireps where charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pireps_reg = $row["numpireps"];
	}
	//  Get distancer of regular manual pireps for pilot's stadistics
	$sql = "select sum(distance) distance from pireps";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_pireps = $row["distance"];
	}
	// Get FS FSACARS flights for pilot's stadistics
	$sql = "select count(*) flights from reports";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fsacars = $row["flights"];
	}
	// Get Regular FS FSACARS flights for pilot's stadistics
	$sql = "select count(*) flights from reports where charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fsacars_reg = $row["flights"];
	}
	// Get VAM ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from vampireps ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_vamacars = $row["flights"];
	}
	// Get Regular VAM ACARS flights for pilot's stadistics
	$sql = "select count(*) flights from vampireps where charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_vamacars_reg = $row["flights"];
	}
	// Get FS Keeper distance for pilot's stadistics
	$sql = "select sum(distance) distancefsacars from reports ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_fsacars = $row["distancefsacars"];
	}
	// Get FS Keeper flights for pilot's stadistics
	$sql = "select count(*) flights from pirepfsfk";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fskeeper = $row["flights"];
	}
	// Get Regular FS Keeper flights for pilot's stadistics
	$sql = "select count(*) flights from pirepfsfk where charter=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_fskeeper_reg = $row["flights"];
	}
	// Get FS Keeper distance for pilot's stadistics
	$sql = "select sum(DistanceRoute) distance from pirepfsfk ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$dist_fskeeper = $row["distance"];
	}
	//  Get count number of pilots
	$sql = "select count(*) num_pilots from gvausers where activation=1";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pilots = $row["num_pilots"];
	}
	//  Get count number of planes
	$sql = "select count(*) num_planes from fleets ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_planes = $row["num_planes"];
	}
	//  Get count number of routes
	$sql = "select count(*) num_routes from routes ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_routes = $row["num_routes"];
	}
	// Get rejected flights to be discounted
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
		//  Get count number of manual pireps
		$sql = "select count(pirep_id) numpireps from pireps where  valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_pireps_rejected = $row["numpireps"];
		}
		//  Get count number of regular manual pireps
		$sql = "select count(pirep_id) numpireps from pireps where charter=0 and valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_pireps_reg_rejected = $row["numpireps"];
		}
		//  Get distancer of regular manual pireps
		$sql = "select sum(distance) distance from pireps where valid=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_pireps_rejected = $row["distance"];
		}
		// Get FS Keeper flights
		$sql = "select count(*) flights from pirepfsfk where validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fskeeper_rejected = $row["flights"];
		}
		// Get Regular FS Keeper flights
		$sql = "select count(*) flights from pirepfsfk where charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fskeeper_reg_rejected = $row["flights"];
		}
		// Get FS Keeper distance
		$sql = "select sum(DistanceRoute) distance from pirepfsfk where  validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_fskeeper_rejected = $row["distance"];
		}
		// Get FS ACARS flights
		$sql = "select count(*) flights from reports where validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fsacars_rejected = $row["flights"];
		}
		// Get Regular FS ACARS flights
		$sql = "select count(*) flights from reports where charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_fsacars_reg_rejected = $row["flights"];
		}
		// Get VAM ACARS flights
		$sql = "select count(*) flights from vampireps where validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_vamacars_rejected = $row["flights"];
		}
		//  Get distancer of VAM ACARS
		$sql = "select sum(distance) distance from vampireps where validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_vamacars_rejected = $row["distance"];
		}
		// Get Regular VAM ACARS flights
		$sql = "select count(*) flights from vampireps where  charter=0 and validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_vamacars_reg_rejected = $row["flights"];
		}
		// Get FS ACARS distance
		$sql = "select sum(distance) as distance from reports where validated=2";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$dist_fsacars_rejected = $row["distance"];
		}
	}
	if ($no_count_rejected==1)
		{
			$sql = "select  sum(v.sum_time + g.transfered_hours) as total_time from v_top_hours_rejected v inner join gvausers g on g.gvauser_id = v.pilot";
		}
		else
		{
			$sql = "select  sum(v.sum_time + g.transfered_hours) as total_time from v_top_hours v inner join gvausers g on g.gvauser_id = v.pilot";
		}
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$va_hours = $row["total_time"];
		}
?>