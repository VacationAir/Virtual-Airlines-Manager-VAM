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
if ($_SESSION["access_fleet_manager"] ==1)
    {
		$fleet_id = $_GET['fleet_id'];
		$hub ='';
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql='select hub from fleets f inner join hubs h on (h.hub_id=f.hub_id) where  fleet_id='.$fleet_id;
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$hub =  $row["hub"];
		}
		$sql='update fleets set location="' .$hub. '" where  fleet_id='.$fleet_id;
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$db->close();
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=report_plane_out_route">';
	}
	else
	{
		include("./notgranted.php");
	}
?>