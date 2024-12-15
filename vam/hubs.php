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
	$sql_hub_global ="select * from hubs order by hub asc";
	if (!$result_hub_global = $db->query($sql_hub_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hubs = $result_hub_global->fetch_assoc()) {
		$hub_id= $row_hubs["hub_id"];
		// pilots
		$sql_pilots = "select * from country_t c, gvausers gu, ranks r, hubs h, (select 0 + sum(time) as gva_hours, pilot from v_pilot_roster_rejected vv group by pilot) as v
	            where
	            h.hub_id = $hub_id and
	            gu.rank_id=r.rank_id and
	            h.hub_id=gu.hub_id and
	            gu.activation<>0 and
	            gu.country=c.iso2 and
	            v.pilot = gu.gvauser_id order by callsign asc";
		if (!$result_pilots = $db->query($sql_pilots)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// fleet
		$sql_fleet= "select registry, status, hours,plane_description, location
				from fleets f
				inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
				where hub_id = $hub_id";
		if (!$result_fleet = $db->query($sql_fleet)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// Hub info
		$sql_hub = "select count(*) num_pilots from gvausers where hub_id=$hub_id and activation=1";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_pilots= $row_hub["num_pilots"];
		}
		$sql_hub = "select count(*) num_fleet from fleets where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_fleet= $row_hub["num_fleet"];
		}
		$sql_hub = "select count(*) num_routes from routes where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_routes= $row_hub["num_routes"];
		}
		$sql_hub = "select * from hubs h inner join airports a on a.ident = h.hub where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$iso_country= $row_hub["iso_country"];
			$hub_name= $row_hub["name"];
			$hub_web= $row_hub["web"];
			$hub_image = $row_hub["image_url"];
		}
		$sql_routes = "select * from routes where hub_id=$hub_id ";
		if (!$result_routes = $db->query($sql_routes)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	?>
	<div class="alert alert-danger" role="alert"><?php echo $hub_name; ?></div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_group_white_18dp_1x.png">&nbsp;<?php echo HUB_PILOTS; ?></div>
				<div class="table-responsive header-fixed" style="height:500px;overflow:auto">
					<!-- Table -->
					<table class="table table-hover header-fixed">
						<?php
							echo "<thead><tr><th>" . CALLSIGN . " </th><th>" . NAME .  "</th><th>" . LOCATION . "</th><th>" . HOURS . "</th><th>" . RANK . "</th><th>" . COUNTRY . "</th><th>" . STATUS . "</th>";
							echo "</tr></thead>";
							while ($row_pilots = $result_pilots->fetch_assoc()) {
								echo "<td>";
								echo '<a href="./index.php?page=pilot_details&pilot_id=' . $row_pilots["gvauser_id"] . '">' . $row_pilots["callsign"] . '</a></td><td>';
								echo $row_pilots["name"] . ' ' . $row_pilots["surname"] . '</td><td>';
								echo '<a href="./index.php?page=airport_info&airport='.strtoupper($row_pilots["location"]) .'">'. strtoupper($row_pilots["location"]).'</a></td><td>';
								echo '<i class="fa fa-clock-o"></i>&nbsp;'.convertTime(round($row_pilots["gva_hours"] , 2) + round($row_pilots["transfered_hours"] , 2),$va_time_format) . '</td><td>';
								echo $row_pilots["rank"] . '</td><td>';
								echo '<img src="./images/country-flags/' . $row_pilots["iso2"] . '.png" alt="' . $row_pilots["iso2"] . '">' . '  ' . $row["short_name"] . '</td><td>';
								if ($row_pilots["activation"] == 1)
									echo '<img src="./images/green-user-icon.png" height="25" width="25"</td>';
								else
									echo '<img src="./images/red-user-icon.png" height="25" width="25"</td>';
								echo '</tr>';
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo HUB_FLEET; ?></div>
				<div class="table-responsive" style="height:500px;overflow:auto">
					<!-- Table -->
					<table class="table table-hover ">
						<?php
							echo "<thead><tr><th>" . REGISTRY . " </th><th>" . TYPE .  "</th><th>" . LOCATION_PLANE . "</th><th>" . HOURS_PLANE . "</th><th>" . STATUS_PLANE . "</th>";
							echo "</tr></thead>";
							while ($row_fleet = $result_fleet->fetch_assoc()) {
								echo "<td>";
								echo '<a href="./index.php?page=plane_info_public&registry_id=' . $row_fleet["registry"] . '">' . $row_fleet["registry"] . '</a></td><td>';
								echo $row_fleet["plane_description"]. '</td><td>';
								echo '<a href="./index.php?page=airport_info&airport='.strtoupper($row_fleet["location"]) .'">'. strtoupper($row_fleet["location"]).'</a></td><td>';
								echo '<i class="fa fa-clock-o"></i>&nbsp;'.$row_fleet["hours"]. '</td><td>';
								if  ($row_fleet["status"]>=70){
									$bar='progress-bar-success';
								}
								elseif ($row_fleet["status"]<70 || $row["status"]>=35 )
									$bar='progress-bar-warning';
								if ($row_fleet["status"]<35  )
									$bar='progress-bar-danger';
								?>
								  <div class="progress">
		    						<?php
		    							echo '<div class="progress-bar '. $bar .'" role="progressbar" aria-valuenow="'. $row_fleet["status"].'" aria-valuemin="0" aria-valuemax="100" style="width:'.$row_fleet["status"].'%">
		      '.$row_fleet["status"].'% ';
		      						?>
		   							 </div>
		 						 </div>
								<?php
								echo '</tr>';
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
	<!-- ROW 2 -->
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_zoom_in_white_18dp_1x.png">&nbsp;<?php echo HUB_DETAILS ; ?></div>
				<div class="table-responsive" style="height:500px;overflow:auto">
					<!-- Table -->
					<table class="table table-hover">
						<?php
							echo "<tr>";
							echo '<td>';
							echo '<img src='.$hub_image.' width="100%" >';
							echo '</td></tr>';
							echo '<tr><td>';
							echo '<div class="small"><strong>'.HUB_NAME.'</strong></div>';
							echo $hub_name . '&nbsp;<img src="./images/country-flags/' . $iso_country . '.png" ></td></tr><tr><td>';
							echo '<div class="small"><strong>'.HUB_WEB.'</strong></div>';
							echo '<a href='.$hub_web. '>Link</a>'.'</td></tr><tr><td>';
							echo '<div class="small"><strong>'.HUB_NUM_PILOTS.'</strong></div>';
							echo $num_pilots.'</td></tr><tr><td>';
							echo '<div class="small"><strong>'.HUB_NUM_FLEET.'</strong></div>';
							echo $num_fleet.'</td></tr><tr><td>';
							echo '<div class="small"><strong>'.HUB_NUM_ROUTES.'</strong></div>';
							echo $num_routes.'</td>';
							echo '</tr>';
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo HUB_ROUTES;  ?></div>
				<div class="table-responsive" style="height:500px;overflow:auto;">
					<!-- Table -->
					<table class="table table-hover">
						<?php
							echo "<thead><tr><th>" . FLIGHT_VA . " </th><th>" . DEPARTURE .  "</th><th>" . ARRIVAL . "</th>";
							echo "</tr></thead>";
							while ($row_routes = $result_routes->fetch_assoc()) {
								echo '<tr><td>';
								echo $row_routes["flight"].'</td><td>';
								echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;'.$row_routes["departure"].'</td><td>';
								echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;'.$row_routes["arrival"].'</td></tr>';
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default" >
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_zoom_out_map_white_18dp_1x.png">&nbsp;<?php echo HUB_MAP_LOCATION; ?></div>
				<div class="panel-body">
					<table class="table table-hover">
						<tr>
							<td ><iframe src="hub_routes_map.php?hub_id=<?php echo $hub_id ; ?>" width="100%" height="500px"></iframe></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
<?php
	} // END global while loop
	$db->close();
?>
