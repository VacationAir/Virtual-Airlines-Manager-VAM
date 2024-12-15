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
	include ("./helpers/get_metar.php");
	if (is_logged())
	{
		$route = $_GET['route'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "SELECT DISTINCT a3.name as alt_name, a3.iso_country as alt_country, a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country , r.route_id,r.flight flight, f.fleet_id, registry as reg,
		status , plane_description, r.departure, r.arrival, duration, etd,eta,pax_price,flproute,comments, alternative, flight_level
		FROM gvausers gu, fleets f, fleettypes ft, routes r, fleettypes_gvausers ftgu, fleettypes_routes ftro, airports a1, airports a2 ,airports a3
		WHERE a1.ident=r.departure
		AND a2.ident=r.arrival
		AND a3.ident=r.alternative
		AND gu.gvauser_id = ftgu.gvauser_id
		AND ftgu.fleettype_id = f.fleettype_id
		AND ft.fleettype_id = f.fleettype_id
		AND ft.fleettype_id = ftgu.fleettype_id
		AND ftro.fleettype_id = f.fleettype_id
		AND ft.fleettype_id = ftro.fleettype_id
		AND ftro.route_id = r.route_id
		AND r.departure = gu.location
		AND gu.gvauser_id =$id
		AND f.location = gu.location
		AND	f.booked = 0
		AND r.route_id=$route order by plane_description, registry asc";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo AVAILABLE_AIRCRAFT; ?></div>
				<div class="table-responsive">
				<br>
				<!-- Table -->
				<table id="route_select_two" class="table table-hover">
					<?php
						echo '<thead>';
						echo "<tr><th>" . BOOK_ROUTE_FLIGHT . "</th><th>" . BOOK_ROUTE_DEPARTURE . "</th><th>" . BOOK_ROUTE_ARRIVAL . "</th><th>" . BOOK_ROUTE_ARICRAFT_TYPE . "</th><th>" . BOOK_ROUTE_ARICRAFT_REG . "</th><th>" . BOOK_ROUTE_ARICRAFT_STATUS . "</th><th>" . BOOK_ROUTE_ARICRAFT_BOOK . "</th></tr>";
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
							echo "<td><i class='fa fa-bookmark'></i>&nbsp;";
							$etd = $row["flight"];
							$eta = $row["eta"];
							$duration = $row["duration"];
							$etd = $row["etd"];
							$eta = $row["eta"];
							$departure = strtoupper($row["departure"]);
							$arrival = strtoupper($row["arrival"]);
							$price = $row["pax_price"];
							$flproute= $row["flproute"];
							$flight_level= $row["flight_level"];
							$comments = $row["comments"];
							$alternative = strtoupper($row["alternative"]);
							$alt_name=$row["alt_name"];
							$alt_country=$row["alt_country"];
							echo $row["flight"] . '</td><td>';
							$ioio = $row["flight"];
							echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a target="_blank" href="./index_vam_op.php?page=airport_info&airport=' . $row["departure"] . '">' . $row["departure"] . '</a><br><font size="1">'.str_replace("Airport","",$row["dep_name"]).'</font> </td><td>';
							echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a target="_blank" href="./index_vam_op.php?page=airport_info&airport=' . $row["arrival"] . '">' . $row["arrival"] . '</a><br><font size="1">'.str_replace("Airport","",$row["arr_name"]).'</font> </td><td>';
							echo $row["plane_description"] . '</td><td>';
							echo '<a target="_blank" href="./index_vam_op.php?page=plane_info_public&registry_id=' . $row["reg"] . '">' . $row["reg"] . '</a> </td><td>';

							if  ($row["status"]>=70){
								$bar='progress-bar-success';
							}
							elseif ($row["status"]<70 || $row["status"]>=35 )

								$bar='progress-bar-warning';

							if ($row["status"]<35  )

								$bar='progress-bar-danger';
							?>
							<div class="progress">
								<div class=" <?php echo $bar ?>" role="progressbar" aria-valuenow="70"
								     aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row["status"]?>%">
									<?php echo $row["status"]. '</td><td>'; ?>
								</div>
							</div>
							<?php
								echo '<a href="./index_vam_op.php?page=route_reserve_plane&plane=' . $row["fleet_id"] . '&route=' . $row["route_id"] . '"><IMG src="images/Edit-Validated-48.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
							}
								echo "</table>";
								$db->close();
							?>
				</table>
				</div>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo BOOK_ROUTE_INFO; ?></div>
				<table class="table table-hover">
					<tr>
						<td><strong><?php echo BOOK_ROUTE_DURATION; ?></strong></td>
						<td><?php echo $duration ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_ALTERNATIVE; ?></strong></td>
						<td><?php echo '<IMG src="images/country-flags/'.$alt_country.'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a target="_blank" href="./index_vam_op.php?page=airport_info&airport='.$alternative.'" &nbsp;'.$alternative.'">' .$alternative.' '.$alt_name; ?></a>&nbsp;</td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_TIME_DEP; ?></strong></td>
						<td><?php echo $etd ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_TIME_ARR; ?></strong></td>
						<td><?php echo $eta ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_ROUTE; ?></strong></td>
						<td><?php echo $flproute ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo VAMACARS_FLIGHT_LEVEL; ?></strong></td>
						<td><?php echo $flight_level ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_PRICE; ?></strong></td>
						<td><?php echo $price ; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo BOOK_ROUTE_COMMENTS; ?></strong></td>
						<td><?php echo $comments ; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><IMG src="images/icons/ic_cloud_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_METAR; ?></div>
				<table class="table table-hover">
					<tr>
						<?php
							get_metar($departure);
						?>
					</tr>
				</table>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><IMG src="images/icons/ic_cloud_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_METAR; ?></div>
				<table class="table table-hover">
					<tr>
						<?php
							get_metar($arrival);
						?>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php
	}
else
	{
		include("./notgranted.php");
	}
?>
