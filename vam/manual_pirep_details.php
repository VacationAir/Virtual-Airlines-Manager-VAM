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
	$id = $_GET['ID'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// select if the pilot has booked a flight with same from and to airports, then it means it is a regular flight
	$sql = 'select * from pireps where pirep_id=' . $id;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc())
	{
		$date = $row["date"];
		$from_airport = $row["from_airport"];
		$to_airport = $row["to_airport"];
		$charter = $row["charter"];
		$duration = $row["duration"];
		$distance = $row["distance"];
		$fuel = $row["fuel"];
		$plane_type = $row["plane_type"];
		$comment = $row["comment"];
		$validator_comments = $row["validator_comments"];
		$updated_at = $row["updated_at"];
		if ($row["valid"]==0){
			$valid = MANUAL_PIREP__STATUS_NOVALIDATED;
		}
		if ($row["valid"]==1){
			$valid = MANUAL_PIREP__STATUS_VALIDATED;
		}
		if ($row["valid"]==2){
			$valid = MANUAL_PIREP__STATUS_REJECTED;
		}
	}
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo MANUAL_PIREP; ?></div>
					<form class="form-horizontal" id="confirm-pirep" action="./index_vam_op.php?page=pirep_manual_insert" 					      role="form" method="post">
						<table class="table table-hover">
						<tr>
							<td><strong>
								<input name="flight_date" type="hidden" value="<?php echo $flight_date; ?>">
								<?php echo MANUAL_PIREP_DATE; ?></strong></td>
							<td><?php echo $date; ?></td>
							<td><strong>
								<input name="departure" type="hidden" value="<?php echo $from_airport; ?>">
								<?php echo MANUAL_PIREP_DEP; ?></strong></td>
							<td><?php echo $from_airport; ?></td>
							<td><strong>
								<input name="arrival" type="hidden" value="<?php echo $to_airport; ?>">
								<?php echo MANUAL_PIREP_ARR; ?></strong></td>
							<td><?php echo $to_airport ; ?></td>
							<td><strong><?php echo MANUAL_PIREP_FLIGHT_TYPE; ?></strong></td>
							<td><?php if ($charter == 0) {
									echo MANUAL_PIREP_REG;
								} else {
									echo MANUAL_PIREP_CHARTER;
								} ?></td>
						</tr>
						<tr>
							<td><strong>
								<input name="duration" type="hidden" value="<?php echo $duration; ?>">
								<?php echo MANUAL_PIREP_TIME; ?></strong></td>
							<td><?php echo $duration; ?></td>
							<td><strong>
								<input name="distance" type="hidden" value="<?php echo $distance; ?>">
								<?php echo MANUAL_PIREP_DISTANCE; ?></strong></td>
							<td><?php echo $distance; ?></td>
							<td><strong>
								<input name="fuel" type="hidden" value="<?php echo $fuel; ?>">
								<?php echo MANUAL_PIREP_FUEL; ?></strong></td>
							<td><?php echo $fuel; ?></td>
							<td><strong>
								<input name="plane" type="hidden" value="<?php echo $plane; ?>">
								<input name="notes" type="hidden" value="<?php echo $comment; ?>">
								<?php echo MANUAL_PIREP_AIRCRAFT; ?></strong></td>
							<td><?php echo $plane_type; ?></td>
						</tr>
						<tr>
							<td><strong>
								<input name="duration" type="hidden" value="<?php echo $duration; ?>">
								<?php echo Comments; ?></strong></td>
							<td><?php echo $comment; ?></td>
							<td><strong>
								<input name="distance" type="hidden" value="<?php echo $distance; ?>">
								<?php echo MANUAL_PIREP_VALIDATOR_COMMENTS; ?></strong></td>
							<td><?php echo $validator_comments; ?></td>
							<td><strong>
								<input name="fuel" type="hidden" value="<?php echo $fuel; ?>">
								<?php echo MANUAL_PIREP_VALIDATION; ?></strong></td>
							<td><?php echo $valid; ?></td>
							<td><strong>
								<?php echo MANUAL_PIREP_VALIDATION_DATE; ?></strong></td>
							<td><?php echo $updated_at; ?></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
		</div>
		<?php
		$db->close();
?>
