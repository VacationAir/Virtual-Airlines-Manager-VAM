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
	require('check_login.php');
	include('get_va_parameters.php');
	include('./classes/class_vam_mailer.php');
	if (is_logged())
	{
		$tourid = $_GET['tourid'];
		$legid = $_GET['legid'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// prevent any action if the tour is inactive
		$sql = "select DATEDIFF (end_date,CURDATE()) as diff_days from tours where tour_id=$tourid";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$diff_days = $row["diff_days"];
		}
		if ($diff_days>=0) {
			// Delete rejected and duplicated reports
			$sql = "delete from tour_pilots where tour_id=$tourid and leg_id=$legid and gvauser_id=$id and status not in (1)";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// Insert the leg reported
			$sql = "insert into tour_pilots (tour_id,leg_id,gvauser_id,status,report_date) values ( $tourid, $legid,$id,0,CURRENT_DATE ());";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=tour_detail_pilot&tour_id='.$tourid.'&pilot_id='.$id.'">';
	}
	else
	{
		include("./notgranted.php");
	}
?>
