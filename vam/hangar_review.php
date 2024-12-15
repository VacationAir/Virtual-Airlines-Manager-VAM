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
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = "select fleet_id,UNIX_TIMESTAMP(date_out) as date_out ,UNIX_TIMESTAMP(now()) as currdate  from hangar where status=1";

if (!$result = $db->query($sql)) {
    die('There was an error running the query  [' . $db->error . ']');
}
while ($row = $result->fetch_assoc()) {
    $plane = $row["fleet_id"];
	$date_out  = $row["date_out"];
	$currdate  = $row["currdate"];
	$diff =$date_out-$currdate;
	if ($diff<=0)
	{
		$sql1  = "update hangar set status=0 where fleet_id=$plane";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		$sql2 = "update fleets set gvauser_id=NULL, status=100, booked=0 , hangar=0 where fleet_id= $plane";

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	}
}
$db->close();
?>