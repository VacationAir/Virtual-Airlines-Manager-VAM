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
	include('va_parameters.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select flight, a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,route_id,departure,arrival, duration from routes r, airports a1 , airports a2 where departure=a1.ident and arrival=a2.ident order by departure asc,arrival asc ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_zoom_in_white_18dp_1x.png">&nbsp;<?php echo ROUTES_VA_SEARCHER  ?></div>
				<form class="form-horizontal" id="manual-pirep-form" action="./index_vam_op.php?page=pirep_manual_pre_insert" role="form" method="post">
					<br>
					<div class="form-group">
						<label class="control-label col-sm-2" for="departure"><?php echo MANUAL_PIREP_DEP; ?></label>
						<div class="col-sm-3">
							<input type="text" class="form-control" maxlength="4" name="routedeparture" id="routedeparture"
							       placeholder="<?php echo MANUAL_PIREP_DEP_PH; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="arrival"><?php echo MANUAL_PIREP_ARR; ?></label>
						<div class="col-sm-3">
							<input type="text" class="form-control" maxlength="4" name="routearrival" id="routearrival"
							       placeholder="<?php echo MANUAL_PIREP_ARR_PH; ?>">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
<div id="no_search_result">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo ROUTES_VA . ' ' . $va_name; ?></div>
				<div class="table-responsive">
				<br>
				<!-- Table -->
				<table id="routes_public" class="table table-hover">
					<?php
						echo '<thead>';
						echo '<tr><th>' . FLIGHT_VA . '</th><th>' . DEPARTURE . '</th><th>' . ARRIVAL . '</th><th>' . BOOK_ROUTE_DURATION . '</th><th>' . ROUTE_PLANE . '</th></tr>';
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
							$sql2 = 'select ft.plane_icao from fleettypes_routes fr, routes r, fleettypes ft where r.route_id=' . $row["route_id"] . ' and r.route_id=fr.route_id and fr.fleettype_id=ft.fleettype_id ';
							$planes_icaos = '';
							if (!$result2 = $db->query($sql2)) {
								die('There was an error running the query [' . $db->error . ']');
							}
							while ($row2 = $result2->fetch_assoc()) {
								$planes_icaos = $planes_icaos . ' ' . $row2["plane_icao"];
							}
							echo '<tr><td><i class="fa fa-bookmark"></i>&nbsp;';
							echo $row["flight"] . '</td><td><IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo '<a href="./index.php?page=airport_info&airport=' . $row["departure"] . '">' . $row["departure"] . '</a> <br><font size="1">'.str_replace("Airport","",$row["dep_name"]).'</font> </td><td><IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo '<a href="./index.php?page=airport_info&airport=' . $row["arrival"] . '">' . $row["arrival"] . '</a> <br><font size="1">'.str_replace("Airport","",$row["arr_name"]).'</font> </td><td><i class="fa fa-arrow-clock-o"></i>&nbsp;';
							echo '<i class="fa fa-clock-o"></i>&nbsp;'.convertTime($row["duration"],$va_time_format) . '</td><td><i class="fa fa-plane"></i>&nbsp;';
							echo $planes_icaos . '</td></tr>';
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
<div id="search_result">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><?php echo ROUTES_VA . ' ' . $va_name; ?></div>
				<div id="departureli" name="departureli" class="entry"></div>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
