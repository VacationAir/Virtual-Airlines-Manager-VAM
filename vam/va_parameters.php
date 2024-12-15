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
<?php
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$ivao = '';
	$vatsim = '';
	$va_name = '';
	$va_icao = '';
	$landing_vs_penalty1 = '';
	$landing_vs_penalty2 = '';
	$landing_penalty1 = '';
	$landing_penalty2 = '';
	$landing_crash = '';
	$plane_status_hangar = '';
	$hangar_maintenance_days = '';
	$hangar_maintenance_value = '';
	$hangar_crash_value = '';
	$hangar_crash_days = '';
	$pilot_crash_penalty = '';
	$number_pilots = '';
	$date_format = '';
	$time_format = '';
	$auto_approval = '';
	while ($row = $result->fetch_assoc()) {
		$ivao = $row["ivao"];
		$vatsim = $row["vatsim"];
		$va_name = $row["va_name"];
		$va_icao = $row["va_icao"];
		$landing_vs_penalty1 = $row["landing_vs_penalty1"];
		$landing_vs_penalty2 = $row["landing_vs_penalty2"];
		$landing_penalty1 = $row["landing_penalty1"];
		$landing_penalty2 = $row["landing_penalty2"];
		$flight_wear = $row["flight_wear"];
		$landing_crash = $row["landing_crash"];
		$plane_status_hangar = $row["plane_status_hangar"];
		$hangar_maintenance_days = $row["hangar_maintenance_days"];
		$hangar_maintenance_value = $row["hangar_maintenance_value"];
		$hangar_crash_value = $row["hangar_crash_value"];
		$hangar_crash_days = $row["hangar_crash_days"];
		$pilot_crash_penalty = $row["pilot_crash_penalty"];
		$number_pilots = $row["number_pilots"];
		$pilot_public = $row["pilot_public"];
		$date_format = $row["date_format"];
		$time_format = $row["time_format"];
		$auto_approval = $row["auto_approval"];
	}
	$db->close();
?>
