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
	include('./classes/class_vam_mailer.php');
	if ($_SESSION["access_flight_validator"] == '1')
	{
		$flight = $_GET['flight'];
		$type = $_GET['type'];
		$pilot = $_GET['gvauser_id'];
		$departure = $_GET['departure'];
		$arrival = $_GET['arrival'];
		$charter = '';
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// get the salary per hour for the pilot's rank
		$sql = "select * from va_parameters ";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$charter_reduction = $row["charter_reduction"] / 100;
		}
		// get the salary per hour for the pilot's rank
		$sql = "select * from ranks r , gvausers g where g.gvauser_id=$pilot and g.rank_id=r.rank_id ";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$salary_hour = $row["salary_hour"];
		}
		// Pay the salay to the pilot
		if ($type == 'pirep') {
			$sql = "select * from pireps where pirep_id=$flight";
		}
		if ($type == 'keeper') {
			$sql = "select * from pirepfsfk where pirepfsfk_id=$flight";
		}
		if ($type == 'fsacars') {
			$sql = "select ((TIME_TO_SEC( duration )) /3600.0) as duration, origin_id, destination_id, charter from reports where report_id=$flight";
		}
		if ($type == 'vamacars') {
			$sql = "select * from vampireps where id='". $flight."'";
		}
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			if ($type == 'pirep') {
				$duration = $row["duration"];
				$departure = $row["from_airport"];
				$arrival = $row["to_airport"];
				$charter = $row["charter"];
			}
			if ($type == 'keeper') {
				$duration = $row["FlightTime"];
				$departure = substr($row["OriginAirport"] , 0 , 4);
				$arrival = substr($row["DestinationAirport"] , 0 , 4);
				$charter = $row["charter"];
			}
			if ($type == 'fsacars') {
				$duration = $row["duration"];
				$departure = substr($row["origin_id"] , 0 , 4);
				$arrival = substr($row["destination_id"] , 0 , 4);
				$charter = $row["charter"];
			}
			if ($type == 'vamacars') {
				$duration = $row["flight_duration"];
				$departure = $row["departure"] ;
				$arrival = $row["arrival"];
				$charter = $row["charter"];
			}
		}
		$fligth_type = VALIDATE_FLIGHT_REGULAR;
		$reduction = 0; // assumes it is regular
		if ($charter == 1) {
			$fligth_type = VALIDATE_FLIGHT_CHARTER;
			$reduction = $charter_reduction;
		}
		$quantity = ($duration * $salary_hour) - ($duration * $salary_hour * $reduction);
		$sql = "insert into bank (gvauser_id,date,pirep,quantity,jump) values ($pilot,now(),$flight,$quantity,'$fligth_type:$departure - $arrival')";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// insert pilot salary in Va finance module
		$sql = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($quantity, '99995',now(),$pilot ,'$fligth_type:$departure - $arrival','$type', '$flight')";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// update the pirep or fskeepr pirep to set it paid and validated
		if ($type == 'pirep') {
			$sql = "UPDATE pireps set valid=1, paid=1 where pirep_id=$flight";
		}
		if ($type == 'keeper') {
			$sql = "UPDATE pirepfsfk set validated=1,paid=1 where pirepfsfk_id=$flight";
		}
		if ($type == 'fsacars') {
			$sql = "UPDATE reports set validated=1,paid=1 where report_id=$flight";
		}
		if ($type == 'vamacars') {
			$sql = "UPDATE vampireps set validated=1,paid=1 where id=$flight";
		}
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// Send mail to the pilot
		$comment='';
		$action='acceptflight';
		$mail = new vam_mailer();
		$mail->mail_validation_compose($pilot,$action,$departure,$arrival,$comment);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=validate_flights">';
	}
	else
	{
		include("./notgranted.php");
	}
?>
