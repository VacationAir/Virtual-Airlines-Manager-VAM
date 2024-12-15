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
	//  Get va parameters
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$ivao = $row["ivao"];
		$vatsim = $row["vatsim"];
	}
	// get last 5 fligths
	$sql = "select callsign,valid as status,pirep_id as flight,from_airport departure, to_airport arrival ,date,distance,duration,charter, 'pirep' as type from pireps p , gvausers gu where p.gvauser_id=gu.gvauser_id
UNION
select callsign,validated as status,pirepfsfk_id as flight, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceRoute as distance, FlightTime as duration, charter , 'keeper' as type from pirepfsfk p, gvausers gu where p.gvauser_id=gu.gvauser_id 
UNION
select r.callsign, validated as status, report_id as flight, origin_id as departure, destination_id as arrival , date ,distance, duration, charter, 'fsacars' as type from reports r , gvausers gu where r.pilot_id=gu.gvauser_id 
order by date desc limit 5";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$num_last5_flights = $result->num_rows;
	if ($num_last5_flights > 0) {
		$i = 1;
		$flights = array();
		while ($row = $result->fetch_assoc()) {
			$flights[$i] = $row["callsign"] . '&nbsp;&nbsp;&nbsp;&nbsp; ' . $row["departure"] . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $row["arrival"];
			$i = $i + 1;
		}
	}
?>
