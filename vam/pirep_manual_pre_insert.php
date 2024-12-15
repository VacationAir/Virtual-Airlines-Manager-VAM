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
		$from_airport = strtoupper($_POST['departure']);
		$to_airport = strtoupper($_POST['arrival']);
		$duration = $_POST['duration'];
		$distance = $_POST['distance'];
		$fuel = $_POST['fuel'];
		$plane = $_POST['plane'];
		$comment = $_POST['notes'];
		$flight_date = $_POST['flight_date'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// select if the pilot has booked a flight with same from and to airports, then it means it is a regular flight
		$sql = 'select r.route_id route, r.flight flight from gvausers, routes r where gvauser_id="' . $id . '"  and r.departure="' . $from_airport . '" and r.arrival="' . $to_airport . '" and gvausers.route_id=r.route_id  ;';
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		if ($result) {
			$number_of_rows = $result->num_rows;
			$charter = 0;
			if ($number_of_rows > 0) {
				$row = $result->fetch_assoc();
				$charter = 0;
			} else {
				$charter = 1;
			}
		} else {
			echo("There was an error running the query ");
		}
		?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><IMG src="images/icons/ic_mode_edit_white_18dp_1x.png">&nbsp;<?php echo MANUAL_PIREP; ?></div>
						<form class="form-horizontal" id="confirm-pirep" action="./index_vam_op.php?page=pirep_manual_insert" 					      role="form" method="post">
							<table class="table table-hover">
							<tr>
								<td><strong>
									<input name="flight_date" type="hidden" value="<?php echo $flight_date; ?>">
									<?php echo MANUAL_PIREP_DATE; ?></strong></td>
								<td><?php echo $flight_date; ?></td>
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
								<td><?php echo $plane; ?></td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit"
									        class="btn btn-success"><?php echo MANUAL_PIREP_CONFIRM_BTN;?></button>
										</div>
									</div>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
			</div>
	<?php
		$db->close();
	}
		else
	{
		include("./notgranted.php");
	}
?>
