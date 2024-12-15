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
	if ($_SESSION["access_flight_validator"] == '1')
	{
		$tour_pilot_id = $_GET['tour_pilot_id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "UPDATE tour_pilots set status=1 where tour_pilot_id=$tour_pilot_id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// GET TOUR_ID
		$sql = "select * from tour_pilots where tour_pilot_id=$tour_pilot_id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$tour_id = $row["tour_id"];
			$gvauser_id = $row["gvauser_id"];
		}
		// GET TOUR NUM LEGS
		$sql = "select count(*) as cnt from tour_legs where tour_id=$tour_id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$num_legs = $row["cnt"];
		}
		// GET LEGS VALIDATED
		$sql = "select count(*) as cnt from tour_pilots where tour_id=$tour_id and gvauser_id=$gvauser_id and status=1";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$legsvalidated = $row["cnt"];
		}
		if ($num_legs == $legsvalidated)
		{
			$sql = "insert tour_finished (gvauser_id,tour_id,finish_date) values ($gvauser_id,$tour_id,curdate())";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=validate_flights">';
	}
	else
	{
		include("./notgranted.php");
	}
?>
