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
	require('check_login.php');
	if (is_logged())
	{
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		$route='';
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}

		$sql = "select route_id from gvausers gu where	gu.gvauser_id=$id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row = $result->fetch_assoc()) {
			$route = $row["route_id"];
		}
		if ($route <> '' && $route > 0)
		{
		$sql1 = "select a3.iso_country as alt_country, a3.name as alt_name,a1.name as dep_name, a2.name as arr_name,
		a1.iso_country as dep_country,a2.iso_country as arr_country,flight, departure, arrival, alternative, registry, plane_icao,
		f.fleet_id, plane_icao
		 from routes ro, reserves re, fleets f, fleettypes ft , airports a1, airports a2, airports a3
		 where a1.ident=ro.departure and a2.ident=ro.arrival and a3.ident=ro.alternative and
		 ft.fleettype_id=f.fleettype_id and f.fleet_id=re.fleet_id and ro.route_id=$route and ro.route_id=re.route_id and re.gvauser_id=$id";
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo ROUTES_BOOKED; ?></div>
				<div class="table-responsive">
				<br>
				<!-- Table -->
				<table id="route_select_booked" class="table table-hover">
					<?php
						echo "<tr><th>" . BOOK_ROUTE_FLIGHT . "</th><th>" . BOOK_ROUTE_DEPARTURE . "</th><th>" . BOOK_ROUTE_ARRIVAL . "</th><th>" . BOOK_ROUTE_ALTERNATIVE . "</th><th>" . BOOK_ROUTE_ARICRAFT_REG . "</th><th>" . BOOK_ROUTE_ARICRAFT_TYPE . "</th><th>" . BOOK_ROUTE_CANCEL . "</th></tr>";
						while ($row1 = $result1->fetch_assoc()) {
							echo "<td>";
							echo $row1["flight"] . '</td><td><IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row1["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row1["departure"] . '<br><font size="1">'.str_replace("Airport","",$row1["dep_name"]).'</font></td><td><IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row1["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row1["arrival"] . '<br><font size="1">'.str_replace("Airport","",$row1["arr_name"]).'</font> </td><td><IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row1["alt_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row1["alternative"] . '<br><font size="1">'.str_replace("Airport","",$row1["alt_name"]).'</font> </td><td>';
							echo '<a target="_blank" href="./index_vam_op.php?page=plane_info_public&registry_id=' . $row1["registry"]  . '">'.$row1["registry"].'</td><td>';
							echo '<a target="_blank" href="./index_vam_op.php?page=fleet_public&plane_icao=' . $row1["plane_icao"]  . '">'.$row1["plane_icao"].'</td><td>';
							echo '<a href="./index_vam_op.php?page=cancel_reserve&route=' . $route . '&plane=' . $row1["fleet_id"] . '"><IMG src="images/KO32.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
						}?>
				</table>
				</div>
				<?php
					}
					else
					{
					$sql2 = "select distinct a3.iso_country as alt_country, a3.name as alt_name,a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country, r.route_id as route, flight,r.departure,r.arrival,alternative,etd,eta,duration from
							fleets f inner join gvausers g on g.location = f.location
							inner join routes r on r.departure = f.location
							inner join fleettypes_routes ftr on ftr.route_id = r.route_id
							inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
							inner join airports a1 on (a1.ident=r.departure)
							inner join airports a2 on (a2.ident=r.arrival)
							inner join airports a3 on (a3.ident=r.alternative)
							where f.booked=0
							and ftr.fleettype_id = f.fleettype_id
							and g.gvauser_id=$id
							and ftu.gvauser_id=$id";
					if (!$result2 = $db->query($sql2)) {
						die('There was an error running the query [' . $db->error . ']');
					}
				?>

				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<!-- Default panel contents -->
							<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo AVAILABLE_ROUTES; ?></div>
							<div class="table-responsive">
							<br>
							<!-- Table -->
							<table id="route_select_one" class="table table-hover">
								<?php
									echo '<thead>';
									echo "<tr><th>" . BOOK_ROUTE_FLIGHT . "</th><th>" . BOOK_ROUTE_DEPARTURE . "</th><th>" . BOOK_ROUTE_ARRIVAL . "</th><th>" . BOOK_ROUTE_ALTERNATIVE . "</th><th>" . BOOK_ROUTE_DURATION . "</th><th>" . BOOK_ROUTE_TIME_DEP . "</th><th>" . BOOK_ROUTE_TIME_ARR . "</th><th>" . BOOK_ROUTE_INFORMATION . "</th></tr>";
									echo '</thead>';
									while ($row2 = $result2->fetch_assoc()) {
										echo "<td><i class='fa fa-bookmark'></i>&nbsp;";
										echo $row2["flight"] . '</td><td><IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row2["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
										echo '<a target="_blank" href="./index_vam_op.php?page=airport_info&airport=' . $row2["departure"] . '">' . $row2["departure"] . '</a><br><font size="1">'.str_replace("Airport","",$row2["dep_name"]).'</font></td><td><IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row2["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
										echo '<a target="_blank" href="./index_vam_op.php?page=airport_info&airport=' . $row2["arrival"] . '">' . $row2["arrival"] . '</a><br><font size="1">'.str_replace("Airport","",$row2["arr_name"]).'</font> </td><td><IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row2["alt_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
										echo '<a target="_blank" href="./index_vam_op.php?page=airport_info&airport=' . $row2["alternative"] . '">' . $row2["alternative"] . '</a><br><font size="1">'.str_replace("Airport","",$row2["alt_name"]).'</font> </td><td><i class="fa fa-clock-o"></i>&nbsp;';
										echo $row2["duration"] . '</td><td>';
										echo $row2["etd"] . '</td><td>';
										echo $row2["eta"] . '</td><td>';
										echo '<a href="./index_vam_op.php?page=route_selection_stage2&route=' . $row2["route"] . '"><IMG src="images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
									}
									echo "</table>";
									}
									$db->close();
								?>
							</table>
							</div>
						</div>
					</div>

					<div class="clearfix visible-lg"></div>
				</div>
			</div>
<?php
	}
else
	{
		include("./notgranted.php");
	}
?>
