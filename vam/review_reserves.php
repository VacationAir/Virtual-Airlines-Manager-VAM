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
	include('db_login.php');
	$hours_auto_cancellation=24; // if VA seetings is empty defaut value is 24 h to expire a reserve
	$reserves = array();
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
		$sql = "select hours_auto_cancellation from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$hours_auto_cancellation = $row["hours_auto_cancellation"];
	}

	$sql = "select id,UNIX_TIMESTAMP (date) as reserve_date ,UNIX_TIMESTAMP (now()) as currdate ,route_id, gvauser_id, fleet_id  from reserves";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	$limit=$hours_auto_cancellation * 3600;
	while ($row = $result->fetch_assoc()) {
		$plane = $row["fleet_id"];
		$pilot = $row["gvauser_id"];
		$reserve_date = $row["reserve_date"];
		$currdate = $row["currdate"];
		$diffdays= $currdate-$reserve_date;
		if (($diffdays)>$limit)
		{
			$sql1  = "update gvausers set route_id= NULL, book_date= NULL where gvauser_id=$pilot";
			if (!$result1 = $db->query($sql1)) {
				die('There was an error running the query  [' . $db->error . ']');
			}
			$sql1 = "update fleets set gvauser_id=NULL, booked=0 , booked_at=null where fleet_id= $plane";
			if (!$result1 = $db->query($sql1)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			array_push($reserves, $row["id"]);
		}
	}

	foreach ($reserves as $reserve_id) {
		$sql = "delete  from reserves where id=$reserve_id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
	}
	// Clean not used aircraft for charter
	$sql = "update fleets set gvauser_id=NULL , booked=0 , booked_at=null where booked=1 and (UNIX_TIMESTAMP (now())-UNIX_TIMESTAMP (booked_at)) >86400";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

?>

