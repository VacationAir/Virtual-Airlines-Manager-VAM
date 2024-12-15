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
	if ($_SESSION["access_jump_validator"] == '1')
	{
		$from_airport = $_GET['from_airport'];
		$to_airport = $_GET['to_airport'];
		$type = $_GET['type'];
		$pilot = $_GET['pilot'];
		$jump = $_GET['jump'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// get VA parameters
		$sql = "select * from va_parameters ";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$jump_type1 = -1 * $row["jump_type1"];
			$jump_type2 = -1 * $row["jump_type2"];
			$jump_type3 = -1 * $row["jump_type3"];
		}
		// Pay the jump to the pilot
		if ($type == 'national') {
			$sql1 = "update jumps set paid=1, value='$jump_type1' where id=$jump";
			$sql2 = "insert into bank (gvauser_id,date,quantity,jump) values ($pilot,now(),$jump_type1,'" . VALIDATE_JUMP . " $from_airport - $to_airport')";
		}
		if ($type == 'continental') {
			$sql1 = "update jumps set paid=1, value=$jump_type2 where id=$jump";
			$sql2 = "insert into bank (gvauser_id,date,quantity,jump) values ($pilot,now(),$jump_type2,'" . VALIDATE_JUMP . " $from_airport - $to_airport')";
		}
		if ($type == 'intercontinental') {
			$sql1 = "update jumps set paid=1, value=$jump_type3 where id=$jump";
			$sql2 = "insert into bank (gvauser_id,date,quantity,jump) values ($pilot,now(),$jump_type3,'" . VALIDATE_JUMP . "$from_airport - $to_airport')";
		}
		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		if (!$result = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=validate_jumps">';
	}
	else
	{
		include("./notgranted.php");
	}
?>
