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
	include ('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT flight_id FROM `vam_live_flights` WHERE TIMESTAMPDIFF( MINUTE ,NOW( ) , last_update )<-3";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc())
	{
		$sql_inner = "delete from vam_live_acars where flight_id='".$row["flight_id"]."'";

		if (!$result_acars = $db->query($sql_inner))
		{
		die('There was an error running the query [' . $db->error . ']');
		}
		$sql_inner = "delete from vam_live_flights where flight_id='".$row["flight_id"]."'";
		if (!$result_acars = $db->query($sql_inner))
		{
		die('There was an error running the query [' . $db->error . ']');
		}
	}
	$sql = 'select a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country, callsign, arrival, departure, flight_status, gu.name as name_pilot, surname, plane_type, pending_nm, perc_completed, network from vam_live_flights vf, gvausers gu ,airports a1 , airports a2 where gu.gvauser_id = vf.gvauser_id and departure=a1.ident and arrival=a2.ident';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$data = array();
	if ( mysqli_num_rows ( $result ) >0)
	{
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
	$db->close();
	echo json_encode( $data );
?>