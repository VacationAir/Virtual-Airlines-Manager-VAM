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
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo PILOT_FLIGTHS; ?></h3>
			</div>
			<div class="panel-body">
				<?php
					$db = new mysqli($db_host , $db_username , $db_password , $db_database);
					$db->set_charset("utf8");
					if ($db->connect_errno > 0) {
						die('Unable to connect to database [' . $db->connect_error . ']');
					}
					$sql = "select a1.iso_country as country_dep, a2.iso_country as country_arr ,REPLACE(a1.name,'Airport','') as dep_name,REPLACE(a2.name,'Airport','') as arr_name,CreatedOn as date_int,pirepfsfk_id as id,'' as comment,validated as status,pirepfsfk_id as flight, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , DATE_FORMAT(CreatedOn,'$va_date_format') as date  , DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , flight as flight_regular
          from pirepfsfk , airports a1, airports a2 where a1.ident=SUBSTRING(OriginAirport,1,4) and a2.ident=SUBSTRING(DestinationAirport,1,4) and gvauser_id=$id
          UNION
SELECT a1.iso_country as country_dep, a2.iso_country as country_arr ,REPLACE(a1.name,'Airport','') as dep_name,REPLACE(a2.name,'Airport','') as arr_name,date as date_int,report_id as id,'' as comment , validated as status, report_id as flight , origin_id as departure, destination_id as arrival, DATE_FORMAT(date,'$va_date_format') as date, distance, (HOUR(duration)*60 + minute(duration))/60 as duration, charter, 'Fsacars' as type, flight as flight_regular
          from reports , airports a1, airports a2 where a1.ident=origin_id and a2.ident=destination_id and  pilot_id=$id
		  UNION
select a1.iso_country as country_dep, a2.iso_country as country_arr ,REPLACE(a1.name,'Airport','') as dep_name,REPLACE(a2.name,'Airport','') as arr_name,date as date_int,pirep_id as id,comment,valid as status,pirep_id as flight,from_airport departure, to_airport arrival , DATE_FORMAT(date,'$va_date_format') as date,distance,duration,charter, 'pirep' as type ,flight as flight_regular
          from pireps  , airports a1, airports a2 where a1.ident=from_airport and a2.ident=to_airport and  gvauser_id=$id
          UNION
SELECT a1.iso_country as country_dep, a2.iso_country as country_arr ,REPLACE(a1.name,'Airport','') as dep_name,REPLACE(a2.name,'Airport','') as arr_name,flight_date as date_int, flightid as id,'' as comment , validated as status, flightid as flight, departure, arrival , DATE_FORMAT(flight_date,'$va_date_format') as date, distance, flight_duration as duration, charter, 'VAMACARS' as type, flight as flight_regular
		  from vampireps , airports a1, airports a2
 where a1.ident=departure and a2.ident=arrival and  gvauser_id=$id
		  order by date_int desc, id desc";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query  [' . $db->error . ']');
					}
				?>
				<table id="pilot_flights" class="table table-hover">
					<?php
						echo '<thead>';
						echo "<tr><th>" . PILOT_FLIGTHS_DATE . "</th><th>" . PILOT_FLIGTHS_DEP . "</th><th>" . PILOT_FLIGTHS_ARR . "</th><th>" . PILOT_FLIGTHS_DUR . "</th><th>" . PILOT_FLIGTHS_DIST . "</th><th>" . PILOT_FLIGTHS_TYPE . "</th><th>" . PILOT_FLIGTHS_VALI . "</th><th>" . PILOT_FLIGTHS_DETAILS . "</th></tr>";
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
							$flight_type = '';
							if ($row["type"] == 'pirep') {
								$flight_type = INDEX_PILOT_MANUAL;
							} elseif ($row["type"] == 'keeper') {
								$flight_type = INDEX_PILOT_KEEPER;
							} elseif ($row["type"] == 'Fsacars') {
								$flight_type = INDEX_PILOT_FSACARS;
							}
							elseif ($row["type"] == 'VAMACARS') {
								$flight_type = 'SIM ACARS';
							}
							echo '<td><i class="fa fa-calendar"></i>&nbsp;';
							echo $row["date"] . '</td><td><IMG src="images/country-flags/'.$row["country_dep"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row["departure"] . '<br><font size="1">'.$row["dep_name"].'</font></td><td><IMG src="images/country-flags/'.$row["country_arr"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row["arrival"] . '<br><font size="1">'.str_replace("Aiport","",$row["arr_name"]).'</font></td><td><i class="fa fa-clock-o"></i>&nbsp;';
							echo convertTime(number_format($row["duration"] , 2),$va_time_format) . '</td><td data-order="'.number_format($row["distance"] , 0,",","").'"><i class="fa fa-expand"></i>&nbsp;';
							echo number_format($row["distance"] , 0,",","") . '</td><td><i class="fa fa-tags"></i>&nbsp;';
							if ($row["status"] == 0)
								$status_image = '<font color="#C36900"><span class="glyphicon glyphicon-time fa-lg"></span></font>';
							else if ($row["status"] == 1)
								$status_image = '<font color="#228B22"><span class="glyphicon glyphicon-ok fa-lg"></span></font>';
							else
								$status_image = '<font color="#DC143C"><span class="glyphicon glyphicon-remove fa-lg"></span></font>';
							if ($row["charter"] == 1) {
								echo INDEX_PILOT_CHARTER . ' -' . $flight_type . '</td><td>';
							} else {
								echo INDEX_PILOT_REGULAR . ' - ' . $flight_type . ' - ' . $row["flight_regular"] . '</td><td>';
							}
							echo $status_image . '</td><td>';
							if ($row["type"] == 'pirep') {
								echo '<a href="./index.php?page=manual_flight_details&ID=' . $row["id"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
							} elseif ($row["type"] == 'keeper') {
								echo '<a href="./index.php?page=PIREPDetails&ID=' . $row["id"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
							} elseif ($row["type"] == 'Fsacars') {
								echo '<a href="./index.php?page=FSACARSDetails&ID=' . $row["id"] . '"><<IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
							}
							elseif ($row["type"] == 'VAMACARS') {
								echo '<a href="./index.php?page=flight_details&flight_id=' . $row["id"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
	include( 'pilot_profile_flights_map.php');
?>
