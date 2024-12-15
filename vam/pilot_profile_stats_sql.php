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
	// Averages for different parameters
	$distance_arr = array();
	$time_arr = array();
	$landvs_arr = array();
	$distance_avg_gen=0;
	$duration_avg_gen=0;
	$landingvs_avg_gen=0;
	$sql="select AVG (distance) as distance_avg , AVG(flight_duration) as duration_avg , AVG(landing_vs) as landingvs_avg from vampireps where gvauser_id=$pilotid
		union
		select AVG (DistanceFlight) as distance_avg , AVG(FlightTime) as duration_avg , CASE  WHEN DistanceFlight IS NULL then 0 else AVG(LandingVS) END as landingvs_avg from pirepfsfk where gvauser_id=$pilotid";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		if ($row["distance_avg"]!=0)
		{
			array_push($distance_arr,$row["distance_avg"]);
		}
		if ($row["duration_avg"]!=0)
		{
			array_push($time_arr,$row["duration_avg"]);
		}
		if ($row["landingvs_avg"]!=0)
		{
			array_push($landvs_arr,$row["landingvs_avg"]);
		}
	}
	if (count($distance_arr)>0)
	{
		$distance_avg_gen=array_sum($distance_arr)/count($distance_arr);
	}
    if (count($time_arr)>0)
	{
		$duration_avg_gen=array_sum($time_arr)/count($time_arr);
	}
    if (count($landvs_arr)>0)
	{
		$landingvs_avg_gen=array_sum($landvs_arr)/count($landvs_arr);
	}		
	// Last 30 days
	$flights_last_30d=0;
	$sql="select SUM(flight_cnt) as flight_cnt_gen from
		(select count(*) as flight_cnt from vampireps where gvauser_id=$pilotid and (UNIX_TIMESTAMP(NOW()) -  UNIX_TIMESTAMP(flight_date))<2678400
		union
		select count(*) as flight_cnt  from pirepfsfk where gvauser_id=$pilotid and (UNIX_TIMESTAMP(NOW()) -  UNIX_TIMESTAMP(CreatedOn))<2678400
		union
		select count(*) as flight_cnt  from pireps where gvauser_id=$pilotid and (UNIX_TIMESTAMP(NOW()) -  UNIX_TIMESTAMP(date))<2678400
		union
		select count(*) as flight_cnt  from reports where gvauser_id=$pilotid and (UNIX_TIMESTAMP(NOW()) -  UNIX_TIMESTAMP(date))<2678400) as t group by flight_cnt";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$flights_last_30d=$row["flight_cnt_gen"];

	}
	// Calculate % by flight duration
	$duration_perc='';
	$duration_array = array();
	$duration_cnt = 0;
	$duration_graph ='';
	$sql = "select flightduration , SUM(cn) as cnt from (
select '0-1' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>1 and ABS(abs(flight_duration))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>2 and ABS(abs(flight_duration))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>3 and ABS(abs(flight_duration))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>4 and ABS(abs(flight_duration))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>5 and ABS(abs(flight_duration))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>6 and ABS(abs(flight_duration))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>7 and ABS(abs(flight_duration))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>8 and ABS(abs(flight_duration))<=9
union
select '>9' as flightduration , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>9
union
select '0-1' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>1 and ABS(abs(duration))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>2 and ABS(abs(duration))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>3 and ABS(abs(duration))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>4 and ABS(abs(duration))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>5 and ABS(abs(duration))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>6 and ABS(abs(duration))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>7 and ABS(abs(duration))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>8 and ABS(abs(duration))<=9
union
select '>9' as flightduration , COUNT(*) as cn from pireps where gvauser_id=$pilotid and LENGTH((duration))>0 and ABS(abs(duration))>9
union
select '0-1' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>1 and ABS(abs(flighttime))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>2 and ABS(abs(flighttime))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>3 and ABS(abs(flighttime))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>4 and ABS(abs(flighttime))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>5 and ABS(abs(flighttime))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>6 and ABS(abs(flighttime))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>7 and ABS(abs(flighttime))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>8 and ABS(abs(flighttime))<=9
union
select '>9' as flightduration , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((flighttime))>0 and ABS(abs(flighttime))>9) as t group by flightduration";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$duration_array[$row["flightduration"]] = $row["cnt"];
		$duration_cnt +=  $row["cnt"];
	}
	if ($duration_cnt>0)
	{
		foreach($duration_array as $key => $value)
		{
			$val = number_format((100 * $value)/$duration_cnt,2);
			if ($val>0)
			{
				$duration_graph = $duration_graph. '{label: "'.$key.' h", value: '.$val.'},';
			}
		}
	}

	// Calculate vs % by the pilot
	$landing_vs_perc='';
	$landing_vs_array = array();
	$landing_vs_cnt = 0;
	$landing_vs_graph ='';
	$sql = "select LND_vs , SUM(cn) as cnt from (
select '0-100 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and ABS(abs(landing_vs))<=100
union
select '100-200 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=200 and abs(landing_vs)>100
union
select '200-300 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=300 and abs(landing_vs)>200
union
select '300-400 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=400 and abs(landing_vs)>300
union
select '400-500 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=500 and abs(landing_vs)>400
union
select '500-600 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=600 and abs(landing_vs)>500
union
select '600-700ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=700 and abs(landing_vs)>600
union
select '700-800 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=800 and abs(landing_vs)>700
union
select '800-900 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(landing_vs)<=900 and abs(landing_vs)>800
union
select '>900 ft/min' as LND_vs , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH((landing_vs))>0 and abs(abs(landing_vs))>=900
union
select '0-100 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and ABS(abs(landingVs))<=100
union
select '100-200 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=200 and abs(landingVs)>100
union
select '200-300 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=300 and abs(landingVs)>200
union
select '300-400 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=400 and abs(landingVs)>300
union
select '400-500 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=500 and abs(landingVs)>400
union
select '500-600 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=600 and abs(landingVs)>500
union
select '600-700 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=700 and abs(landingVs)>600
union
select '700-800 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=800 and abs(landingVs)>700
union
select '800-900 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(landingVs)<=900 and abs(landingVs)>800
union
select '>900 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where gvauser_id=$pilotid and LENGTH((landingVs))>0 and abs(abs(landingVs))>=900) as t group by LND_vs";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$landing_vs_array[$row["LND_vs"]] = $row["cnt"];
		$landing_vs_cnt +=  $row["cnt"];
	}
	if ($landing_vs_cnt>0)
	{
		foreach($landing_vs_array as $key => $value)
		{
			$val = number_format((100 * $value)/$landing_vs_cnt,2);
			if ($val>0)
			{
				$landing_vs_graph = $landing_vs_graph. '{label: "'.$key.'", value: '.$val.'},';
			}
		}
	}
	// Calculate aircraft used by the pilot
	$perc_aircarft_type_used='';
	$aircarft_type_used_array = array();
	$aircarft_type_used_cnt = 0;
	$sql = "select aircraft_type , COUNT(*) as cn from vampireps where gvauser_id=$pilotid and LENGTH(aircraft_type)>0 group by aircraft_type
union
select plane_type as aircraft_type , COUNT(*) as cn  from pireps  where gvauser_id=$pilotid and LENGTH(plane_type)>0  group by plane_type
union
select AircraftType as aircraft_type , COUNT(*) as cn  from pirepfsfk  where gvauser_id=$pilotid and LENGTH(AircraftType)>0  group by AircraftType
 ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$aircarft_type_used_array[$row["aircraft_type"]] = $row["cn"];
		$aircarft_type_used_cnt +=  $row["cn"];
	}
	foreach($aircarft_type_used_array as $key => $value)
	{
		$val = number_format((100 * $value)/$aircarft_type_used_cnt,2);
		$perc_aircarft_type_used = $perc_aircarft_type_used. '{label: "'.$key.'", value: '.$val.'},';
	}
	// select current day
	$sql = " select day(now()) as 'current_day', month(now()) as 'current_month',year(now()) as 'current_year' ; ";
	$current_day;
	$current_month;
	$current_year;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$current_day = $row['current_day'];
		$current_month = $row['current_month'];
		$current_year = $row['current_year'];
	}
	// Calculation for flights per month current year
	$count_per_month = '';
	$days='';
	for ($i = 1 ; $i <= $current_month ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(sum(c),0) as co from v_flights_pilots where pilot=$pilotid and date_format(flightdate,'%y')=date_format(now(),'%y') and date_format(flightdate,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	// Calculation for flights per day current month
	$count_per_day = '';
	for ($i = 1 ; $i <= $current_day ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(sum(c),0) as co from v_flights_pilots where pilot=$pilotid and date_format(flightdate,'%m')=date_format(now(),'%m') and date_format(flightdate,'%d')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_day = $count_per_day . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	// Calculation global % Charter VS Regular
	$totalflights = $num_pireps + $num_reports + $num_fskeeper + $num_vamacars;
	$totalregularflights = $num_reports_reg + $num_pireps_reg + $num_fskeeper_reg + $num_vamacars_reg;
	$totalcharterflights = $totalflights - $totalregularflights;
	if ($totalflights == 0) {
		$percregularflights = 0;
		$perccharterflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
		$perccharterflights = round(100 - $percregularflights , 2);
	}
	$perc_charter_reg = '';
	$perccharterflights_pilot=0;
	if ($percregularflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Regular", value: '.$percregularflights.'},';
	}
	if ($perccharterflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Charter", value: '.$perccharterflights.'},';
	}
	if (($percregularflights+$perccharterflights)<1)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No flights", value: 0 },';
	}
	// Calculation for type of report
	if ($totalflights == 0) {
		$percfsacars = 0;	}
	else {
		$percfsacars = round(($num_reports * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {
		$percfskeeper = 0;	}
	else {
		$percfskeeper = round(($num_fskeeper * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {
		$percvamacars = 0;	}
	else {
		$percvamacars = round(($num_vamacars * 100) / $totalflights , 2);
	}
	if ($num_pireps>0)
	{
		$percmanual = round((100 - $percfskeeper - $percfsacars - $percvamacars) , 2);
	}
	else
	{
		$percmanual = round(0 , 2);
	}
	// Country  stats
	$sql = "select SUM(c) as c, short_name from
(select count(*) as c, short_name
			from vampireps vp, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  vp.departure=a.ident and vp.gvauser_id=$pilotid  group by short_name
union
select count(*) as c, short_name
			from pireps p, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  from_airport=a.ident and p.gvauser_id=$pilotid  group by short_name
union
select count(*) as c, short_name
			from pirepfsfk p, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  SUBSTRING(OriginAirport,1,4)=a.ident and p.gvauser_id=$pilotid  group by short_name ) as t group by short_name;";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$totalcountry=0;
	$country='';
	$perccountry='';
	$countcountry='';
	while ($row = $result->fetch_assoc()) {
		$totalcountry += $row['c'];
	}
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country = $country . ',"' . $row['short_name'] . '"';
		$perccountry = round(($row['c'] * 100) / $totalcountry , 2);
		$countcountry = $countcountry . '{label: "'.$row['short_name'] .'", value: '.$perccountry.'},';
	}

	$total= ($num_pireps + $num_fskeeper + $num_fsacars);
	if ($total == 0){
		$percfsacars_pilot = 0;
		$percfskeeper_pilot = 0;
		$percmanual_pilot = 0;
	} else {
		$percfsacars_pilot = ($num_fsacars / $total) * 100 ;
		$percfskeeper_pilot = ($num_fskeeper / $total) * 100 ;
		$percmanual_pilot = ($num_pireps / $total) * 100 ;
	}
	$per_type_report='';
	if (($percfsacars + $percfskeeper + $percmanual + $percvamacars)>0)
	{
		if ($percfsacars>0)
		{
			$per_type_report = $per_type_report . '{label: "FSACARS", value: '.$percfsacars.'},';
		}
		if ($percfskeeper>0)
		{
			$per_type_report = $per_type_report . '{label: "FS KEEPER", value: '.$percfskeeper.'},';
		}
		if ($percmanual>0)
		{
			$per_type_report = $per_type_report . '{label: "Manual", value: '.$percmanual.'},';
		}
		if ($percvamacars>0)
		{
			$per_type_report = $per_type_report . '{label: "SIM ACARS", value: '.$percvamacars.'},';
		}
	}
	else
	{
		$per_type_report = $per_type_report ;
	}
?>