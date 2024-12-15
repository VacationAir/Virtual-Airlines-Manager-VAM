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
	$registry_id = $_GET['registry_id'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	/*$sql='SET OPTION SQL_BIG_SELECTS = 1';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	*/
	$sql = "select a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,gu.gvauser_id,ft.fuel fuel,DATE_FORMAT(date,'$va_date_format') as date,gu.name,gu.surname,callsign,flight,ft.departure,ft.arrival,distance from
	fleets f inner join regular_flights_tracks ft on f.fleet_id=ft.fleet_id
	inner join gvausers gu on gu.gvauser_id = ft.gvauser_id
	left outer join routes r on ft.route_id=r.route_id
	inner join airports a1 on (a1.ident=ft.departure)
	inner join airports a2 on (a2.ident=ft.arrival)
	where   registry='$registry_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_zoom_in_white_18dp_1x.png">&nbsp;<?php echo AIRCRAFT_DETAILS  ?></div>
			<table class="table table-hover">
				<?php
					$sql_aircraft = "select hub,maximum_range,ft.image_url,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow
,mlw,mzfw,aircraft_length, pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2
, a.name airport ,a2.name hub_airport , f.name aircraft_name, location, hub_base
from fleets f
inner join hubs hu on hu.hub_id= f.hub_id
inner join airports a on a.ident=f.location
inner join airports a2 on a2.ident=hub
inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
where registry='$registry_id'";

					if (!$result_aircraft = $db->query($sql_aircraft)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					echo '<tr>';
					while ($row_aircraft = $result_aircraft->fetch_assoc()) {
						echo '<td>';
						echo '<img src='.$row_aircraft["image_url"].' width="100%" >';
						echo '</td></tr>';
						echo '<td>';
						echo '<div class="small"><strong>'.NAME_PLANE.'</strong></div>';
						echo $row_aircraft["aircraft_name"] . '</td></tr><td>';
						echo '<div class="small"><strong>'.LOCATION_PLANE.'</strong></div>';
						echo $row_aircraft["location"].'<BR>';
						echo '<img src="./images/country-flags/' . $row_aircraft["location_iso2"] . '.png" alt="' . $row_aircraft["location_iso2"] . '">';
						echo '<font size="2">&nbsp;'.$row_aircraft["airport"].'</font>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.HUB.'</strong></div>';
						echo $row_aircraft["hub"].'<BR>';
						echo '<img src="./images/country-flags/' . $row_aircraft["hub_iso2"] . '.png" alt="' . $row_aircraft["hub_airport"] . '">';
						echo '<font size="2">&nbsp;'.$row_aircraft["hub_airport"].'</font>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.TYPE.'</strong></div>';
						echo $row_aircraft["plane_description"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.HOURS_PLANE.'</strong></div>';
						echo $row_aircraft["hours"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.BOOKED_PLANE.'</strong></div>';
						if ($row_aircraft["booked"] == 1) {
							echo PLANE_BOOKED . '<BR>';
						} else {
							echo PLANE_FREE . '<BR>';
						}
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.STATUS_PLANE.'</strong></div>';
						echo $row_aircraft["status"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_PAX.'</strong></div>';
						echo $row_aircraft["pax"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MAX_RANGE.'</strong></div>';
						echo $row_aircraft["maximum_range"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CARGO.'</strong></div>';
						echo $row_aircraft["cargo_capacity"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_LENGTH.'</strong></div>';
						echo $row_aircraft["aircraft_length"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MZFW.'</strong></div>';
						echo $row_aircraft["mzfw"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MLW.'</strong></div>';
						echo $row_aircraft["mlw"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MTOW.'</strong></div>';
						echo $row_aircraft["mtow"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CRUISE_SPEED.'</strong></div>';
						echo $row_aircraft["cruising_speed"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CEILING.'</strong></div>';
						echo $row_aircraft["service_ceiling"].'<BR>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CREW.'</strong></div>';
						echo $row_aircraft["crew_members"].'<BR>';
						echo '</td>';
					}
				?>
			</table>
		</div>
	</div>
	<div class="col-md-10">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo AIRCRAFT_FLIGHTS . '<strong>' . $registry_id . '</strong>' ?></div>
			<br>
			<!-- Table -->
			<table id="fleet_public" class="table table-hover">
				<?php
					echo "<thead><tr><th>" . AIRCRAFT_FLIGHTS_DATE . " </th><th>" . AIRCRAFT_FLIGHTS_PILOT . "</th><th>" . AIRCRAFT_FLIGHTS_CALLSIGN . "</th><th>" . AIRCRAFT_FLIGHTS_FLIGHT . "</th><th>" . AIRCRAFT_FLIGHTS_DEP . "</th><th>" . AIRCRAFT_FLIGHTS_ARR . "</th><th>" . AIRCRAFT_FLIGHTS_DISTANCE . "</th><th>" . AIRCRAFT_FLIGHTS_FUEL . "</th></tr></thead>";
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo $row["date"] . '</td><td>';
						echo $row["name"] . ' ' . $row["surname"] . '</td><td>';
						echo '<a href="./index_vam_op.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a></td><td>';
						if ($row["flight"]== NULL)
						{
							echo 'CHARTER';
						}
						else
						{
							echo $row["flight"];
						}
						echo '</td><td>';
						echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=fleet_public&plane_location=' . $row["departure"] . '">' . $row["departure"] . '</a><br><font size="1">'.str_replace("Airport","",$row["dep_name"]).'</font></td><td>';
						echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=fleet_public&plane_location=' . $row["arrival"] . '">' . $row["arrival"] . '</a><br><font size="1">'.str_replace("Airport","",$row["arr_name"]).'</font></td><td>';
						echo $row["distance"] . '</td><td>';
						echo $row["fuel"] . '</td></tr>';
					}
				?>
			</table>
		</div>
	</div>
	<br>
		<div class="col-md-10">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo AIRCRAFT_HANGAR . '<strong>' . $registry_id . '</strong>' ?></div>
			<br>
			<!-- Table -->
			<table id="fleet_public" class="table table-hover">
				<?php
					$sql = "select DATE_FORMAT(date_in,'$va_date_format') as datein, DATE_FORMAT(date_out,'$va_date_format') as dateout, name, surname, reason from hangar h inner join gvausers gu on (h.gvauser_id=gu.gvauser_id) where registry='$registry_id'";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					echo "<thead><tr><th>" . HANGAR_IN . " </th><th>" . HANGAR_OUT . "</th><th>" . LAST_PILOT . "</th><th>" . REASON . "</th></tr></thead>";
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo $row["datein"] . '</td><td>';
						echo $row["dateout"] . '</td><td>';
						echo $row["name"] .' '. $row["surname"]. '</td><td>';
						echo $row["reason"] . '</td></tr>';
					}
					$db->close();
				?>
			</table>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
