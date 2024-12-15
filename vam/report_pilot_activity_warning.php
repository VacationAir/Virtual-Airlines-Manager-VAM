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
if ($_SESSION["access_pilot_manager"] == '1')
{
	$pilot=$_GET['pilot'];
	include('db_login.php');
	include('./classes/class_vam_mailer.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql="delete from pilot_warning where gvauser_id=$pilot";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$sql="insert into pilot_warning (gvauser_id) values ($pilot)";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$pilot=$_GET['pilot'];
	// Send mail to the pilot
	$mail = new vam_mailer();
	$mail = new vam_mailer();
	$mail->mail_warning_inac_pilot_compose($pilot , 1);
	$db->close();
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam_op.php?page=report_pilot_activity">';
}
else
{
	include("./notgranted.php");
}
?>