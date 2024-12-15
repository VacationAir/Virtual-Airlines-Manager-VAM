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
	$flightid = $_GET['ID'];
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// Execute SQL query
	$sql = "select * , DATE_FORMAT(date,'$va_date_format') as date from pireps p ,gvausers u where u.gvauser_id = p.gvauser_id and p.pirep_id='" . $flightid . "'";
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo VAMACARS_FLITGH_DETAILS; ?></div>
			<?php
				if (!$result = $db->query($sql)) {
					die('There was an error running the query  [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()) {
			?>
			<table class="table table-hover">
				<tr>
					<td><strong><?php echo FSKEEPER_PILOT; ?></strong></td>
					<td><?php echo $row["callsign"] ." ".$row["name"] ." ".$row["surname"]; ?></td>
					<td><strong><?php echo FSKEEPER_AIRCRAFT; ?></strong></td>
					<td><?php echo $row["plane_type"]; ?></td>
					<td><strong><?php echo FSKEEPER_DISTANCE; ?></strong></td>
					<td><?php echo $row["distance"] . 'NM'; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo VAMACARS_DEPARTURE; ?></strong></td>
					<td><?php echo $row["from_airport"]; ?></td>
					<td><strong><?php echo VAMACARS_ARRIVAL; ?></strong></td>
					<td><?php echo $row["to_airport"]; ?></td>
					<td><strong><?php echo VAMACARS_DURATION; ?></strong></td>
					<td><?php echo number_format($row["duration"],2); ?></td>
				</tr>
				<tr>
					<td><strong><?php echo VAMACARS_STATUS_VALIDATION; ?></strong></td>
					<td><?php if ($row["valid"] == '1') {
							echo VAMACARS_STATUS_VALIDATED;
						} elseif
							($row["valid"] == '2'){
							echo VAMACARS_STATUS_REJECTED;
						} else {
							echo VAMACARS_STATUS_NOVALIDATED;
						} ?></td>
					<td><strong><?php echo VAMACARS_TYPE; ?></strong></td>
					<td><?php if ($row["charter"] == '1') {
							echo VAMACARS_FLIGHT_CHARTER;
						} else {
							echo VAMACARS_FLIGHT_REGULAR;
						} ?></td>
					<td><strong><?php echo PILOT_FLIGTHS_DATE; ?></strong></td>
					<td><?php echo $row["date"] ; ?></td>
				</tr>
			</table>
			<br>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo PILOT_FSKEEPER_VALIDATOR; ?></div>
				<table class="table table-hover">
					<tr>
						<td><strong><?php echo VAMACARS_VALIDATOR_COMMENTS; ?></strong></td>
						<td><?php echo $row["validator_comments"]; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo FLIGHT_FINANCES; ?></div>
					<tr>
						<?php
						$vamflightid = 	$flightid;
						include ('flight_financial_report.php');
						?>
					</tr>
			</div>
		</div>
	</div>
<?php
}
$db->close();
?>
