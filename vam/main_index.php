<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	include ('./vam_index_header.php');
    include ('./helpers/conversions.php');
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
		<?php
			$sql = 'select callsign, arrival, departure, flight_status, name, surname, pending_nm, plane_type from vam_live_flights vf, gvausers gu where gu.gvauser_id = vf.gvauser_id ';
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$row_cnt = $result->num_rows;
			$sql = "SELECT flight_id FROM `vam_live_flights` WHERE UNIX_TIMESTAMP (now())-UNIX_TIMESTAMP (last_update)>180";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc())
			{
				$sql_inner = "delete from vam_live_acars where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
				$sql_inner = "delete from vam_live_flights where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
			}
			if ($row_cnt>0){
		?>
		<div class="row" id="live_flights">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_flight_takeoff_white_18dp_1x.png">&nbsp;<?php echo "LIVE FIGHTS" ?></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover" id="live_flights_table">
							<?php
									echo "<tr><th>" . LF_CALLSIG . "</th><th>" . LF_PILOT . "</th><th>" . LF_DEPARTURE . "</th><th>" . LF_ARRIVAL . "</th><th>" . FLIGHT_STAGE . "</th><th>". BOOK_ROUTE_ARICRAFT_TYPE . "</th><th>" . PERC_DONE ."</th><th>" . PENDING_NM . "</th></tr>";
							?>
							</table>
						<?php include ('./vam_live_flights_map.php') ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_chat_white_18dp_1x.png">&nbsp;<?php echo WELCOME_VA . ' ' . $va_name; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select welcome_text from web_configurations";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
							while ($row = $result->fetch_assoc()) {
										echo $row["welcome_text"];
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<tr>
								<td><i class="fa fa-users fa-fw"></i> <?php echo ST_NUMPILOTS; ?></td>
								<td><?php echo $num_pilots; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-plane fa-fw"></i> <?php echo ST_NUMPLANES; ?></td>
								<td><?php echo $num_planes; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-globe fa-fw"></i> <?php echo ST_NUMROUTES; ?></td>
								<td><?php echo $num_routes; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-clock-o fa-fw"></i> <?php echo PILOT_HOURS; ?></td>
								<td><?php echo convertTime($va_hours,$va_time_format); ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-suitcase fa-fw"></i> <?php echo ST_NUMFLIGHTS; ?></td>
								<td><?php echo $num_fskeeper + $num_pireps + $num_reports + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected ; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-exchange fa-fw"></i> <?php echo ST_NUMREGULAR; ?></td>
								<td><?php echo $num_fskeeper_reg + $num_pireps_reg + $num_reports_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-code-fork fa-fw"></i> <?php echo ST_NUMCHARTER; ?></td>
								<td><?php echo $num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_pireps_reg - $num_fskeeper_reg - $num_fsacars_reg - $num_vamacars_reg ; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-bar-chart fa-fw"></i> <?php echo ST_PERREGULAR; ?></td>
								<td><?php if (($num_fskeeper + $num_pireps + $num_reports + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) < 1) {
										echo '0 %';
									} else {
										echo number_format((100 * ($num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected)) / ($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) , 2) . ' %';
									}?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<!-- Row 2 -->
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo LATEST_FLIGHTS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select gvauser_id,a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,
							callsign,pilot_name,departure,arrival,DATE_FORMAT(date,'$va_date_format') as date_string, date, format(time,2) as time
							from v_last_5_flights v, airports a1, airports a2
							where v.departure=a1.ident and v.arrival=a2.ident and time is not null order by date desc";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<div class="table-responsive">
							<table class="table table-hover">
								<?php
									echo "<thead><tr><th>" . LF_CALLSIG . "</th><th>" . LF_PILOT . "</th><th>" . LF_DEPARTURE . "</th><th>" . LF_ARRIVAL . "</th><th>" . LF_FLIGHTDATE . "</th><th>" . LF_FLIGHTTIME . "</th></tr></thead>";
									while ($row = $result->fetch_assoc()) {
										echo '<td>';
										echo '<a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a></td><td>';
										echo $row["pilot_name"] . '</td><td>';
										echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . $row["departure"] . '">' . $row["departure"] . '</a></td><td>';
										echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . $row["arrival"] . '">' . $row["arrival"] . '</a> </td><td>';
										echo $row["date_string"] . '</td><td>';
										echo '<i class="fa fa-clock-o"></i>&nbsp;'.convertTime($row["time"],$va_time_format). '</td></tr>';
									}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_person_add_white_18dp_1x.png">&nbsp;<?php echo NEWEST_PILOTS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select gvauser_id, concat(callsign,'-',name,' ',surname) as pilot , DATE_FORMAT(register_date,'$va_date_format') as register_date from gvausers where activation=1 order by DATE_FORMAT(register_date,'%Y%m%d') desc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-hover">
							<?php
								echo "<thead><tr><th>" . NEWPILOT . "</th><th>" . NEWJOINED . "</th></tr></thead>";
								while ($row = $result->fetch_assoc()) {
									echo "<td>";
									echo '<a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["pilot"] . '</a></td><td>';
									echo $row["register_date"] . '</td></tr>';
								}
							?>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<!-- Row 3 -->
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_slow_motion_video_white_18dp_1x.png">&nbsp;<?php echo FUTURE_EVENTS; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select event_id,event_name,DATE_FORMAT(publish_date,'$va_date_format') as publish_date_web ,DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, DATE_FORMAT(now(),'%Y%m%d') as currdat
from events order by publish_date asc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-hover">
							<?php
								echo "<thead><tr><th>" . EVENT_NAME . "</th><th>" . EVENT_DATE . "</th></tr></thead>";
								while ($row = $result->fetch_assoc()) {
									if (($row["publish_date"]-$row["currdat"] <=0) && ($row["hide_date"]-$row["currdat"]>0))
									{
										echo '<tr><td>';
										echo '<a href="index.php?page=event&event_id=' . $row["event_id"] . '">' . $row["event_name"] . '</a>' . '</td><td>';
										echo $row["publish_date_web"] . '</td></tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_record_voice_over_white_18dp_1x.png">&nbsp;<?php echo TWEETS; ?></h3>
					</div>
					<div class="panel-body">
						<a class="twitter-timeline" href="https://twitter.com/pilotovirtual"
						   data-widget-id="525729765416660992">Tweets por el @pilotovirtual.</a>
						<script>!function (d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
								if (!d.getElementById(id)) {
									js = d.createElement(s);
									js.id = id;
									js.src = p + "://platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js, fjs);
								}
							}(document, "script", "twitter-wjs");</script>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_cast_white_18dp_1x.png">&nbsp;<?php echo NOTAMS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select notam_id,notam_name,DATE_FORMAT(publish_date,'%d-%m-%Y') as publish_date_web ,DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, DATE_FORMAT(now(),'%Y%m%d') as currdat
from notams order by publish_date asc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-striped">
							<?php
								echo "<thead><tr><th>" . NOTAM_NAME . "</th><th>" . NOTAM_DATE . "</th></tr></thead>";
								while ($row = $result->fetch_assoc()) {
									if (($row["publish_date"]-$row["currdat"] <=0) && ($row["hide_date"]-$row["currdat"]>0))
									{
										echo '<tr><td>';
										echo '<a href="index.php?page=notam&notam_id=' . $row["notam_id"] . '">' . $row["notam_name"] . '</a>' . '</td><td>';
										echo $row["publish_date_web"] . '</td></tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
			<!-- REMOVE COMMENTS to display ONLNE NETWORKS section
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php //echo FLIGHT_NETWORKS; ?></h3>
					</div>
					<div class="panel-body">
						<div class="container">
							<?php
							/*
								if ($ivao == 1) {
									echo '<img src="./images/ivao.gif" height="50" width="50">';
								}
								if ($vatsim == 1) {
									echo '<img src="./images/Vatsim.png" height="50" width="50">';
								}
							*/
							?>
						</div>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div> -->
		</div>
		<br>
		<!-- HOME PAGE End -->
	<?php
	}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			echo "Page Not Found";
		}
	}
?>
</div>
<?php include('footer.php');?>
</body>
</html>
