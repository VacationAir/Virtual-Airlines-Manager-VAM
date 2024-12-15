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
	include ("./helpers/get_metar.php");
	$airport =  strtoupper($_GET['airport']);
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// Execute SQL query
	$sql = "select * from runways where airport_ident='" . $airport . "'";
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_cloud_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_METAR; ?></div>
			<table class="table table-hover">
				<tr>
					<?php
						get_metar($airport);
					?>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_zoom_out_map_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_MAP; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'airport_map.php'; ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_view_week_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_RUNWAY_INFO; ?></div>
			<table class="table table-hover">
				<?php
					if (!$result = $db->query($sql)) {
						die('There was an error running the query  [' . $db->error . ']');
					}
					while ($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><strong><?php echo AIRPORT_RUNWAY; ?></strong></td>
							<td><?php echo $row["le_ident"]; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_LENGTH; ?></strong></td>
							<td><?php echo $row["length_ft"] . ' ft'; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_WIDTH; ?></strong></td>
							<td><?php echo $row["width_ft"] . ' ft'; ?></td>
						</tr>
						<tr>
							<td><strong><?php echo AIRPORT_RUNWAY_ELEVATION; ?></strong></td>
							<td><?php echo $row["le_elevation_ft"] . ' ft'; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_THRESHOLD; ?></strong></td>
							<td><?php echo $row["le_displaced_threshold_ft"]. ' ft'; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_HEADING; ?></strong></td>
							<td><?php echo number_format($row["le_heading_degT"] , 0); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><strong><?php echo AIRPORT_RUNWAY; ?></strong></td>
							<td><?php echo $row["he_ident"]; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_LENGTH; ?></strong></td>
							<td><?php echo $row["length_ft"]. ' ft' ; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_WIDTH; ?></strong></td>
							<td><?php echo $row["width_ft"] . ' ft'; ?></td>
						</tr>
						<tr>
							<td><strong><?php echo AIRPORT_RUNWAY_ELEVATION; ?></strong></td>
							<td><?php echo $row["he_elevation_ft"] . ' ft'; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_THRESHOLD; ?></strong></td>
							<td><?php echo $row["he_displaced_threshold_ft"]. ' ft'; ?></td>
							<td><strong><?php echo AIRPORT_RUNWAY_HEADING; ?></strong></td>
							<td><?php echo number_format($row["he_heading_degT"] , 0); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php
					}
				?>
			</table>
			<br>
		</div>
	</div>
</div>
<?php
	// Execute SQL query
	$sql = "select * from airport_frequencies where airport_ident='" . $airport . "'";
?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><IMG src="images/icons/ic_speaker_phone_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_FREQUENCIES; ?></div>
				<table class="table table-hover">
					<?php
						if (!$result = $db->query($sql)) {
							die('There was an error running the query  [' . $db->error . ']');
						}
						while ($row = $result->fetch_assoc()) {
							?>
							<tr>
								<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_TYPE; ?></strong></td>
								<td><?php echo $row["type"]; ?></td>
								<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_NAME; ?></strong></td>
								<td><?php echo $row["description"]; ?></td>
								<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_FREQ; ?></strong></td>
								<td><?php echo $row["frequency_mhz"] . ' MHZ'; ?></td>
							</tr>
						<?php
						}
					?>
				</table>
				<br>
			</div>
		</div>
<?php
	// Execute SQL query
	$sql = "select * from navaids where associated_airport='" . $airport . "'";
?>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_surround_sound_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_NAVAIDS; ?></div>
			<table class="table table-hover">
				<?php
					if (!$result = $db->query($sql)) {
						die('There was an error running the query  [' . $db->error . ']');
					}
					while ($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_TYPE; ?></strong></td>
							<td><?php echo $row["type"]; ?></td>
							<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_NAME; ?></strong></td>
							<td><?php echo $row["name"]; ?></td>
							<td><strong><?php echo AIRPORT_AIRPORT_NAVAIDS_FREQ; ?></strong></td>
							<td><?php echo $row["frequency_khz"] . ' KHZ'; ?></td>
						</tr>
					<?php
					}
				?>
			</table>
			<br>
		</div>
	</div>
</div>
<?php
	$db->close();
?>
