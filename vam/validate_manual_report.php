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
	if ($_SESSION["access_flight_validator"] == '1')
	{
		$flightid = $_GET['ID'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "select * from pireps p ,gvausers u where u.gvauser_id = p.gvauser_id and p.pirep_id='" . $flightid . "'";
?>
<div class="row">
	<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><IMG src="images/icons/ic_chat_white_18dp_1x.png">&nbsp;<?php echo VAMACARS_VALIDATION_COMMENTS; ?></div>
					<div class="container">
				      <form id="validate_comment_form" name="validate_comment_form" method="post">
						<div class="control-group">
					        <label class="control-label"><IMG src="images/icons/ic_chat_white_18dp_1x.png">&nbsp;<?php echo VAMACARS_VALIDATION_COMMENT; ?></label>
							<div class="controls">
							    <div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
									<textarea id="manualcomment" name="manualcomment" class="span4" rows="4" cols="80" placeholder="Comment (Max 500 characters)"></textarea>
									<input type="hidden" id="manualflightid" name="manualflightid" value="<?php echo $flightid ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
						  <div class="controls">
							<button type="button" id="manualaddcommentbtn" name ="manualaddcommentbtn" class="btn btn-primary"><?php echo VAMACARS_VALIDATION_ADD_COMMENT; ?></button>
							<button type="button" id="manualacceptbtn" name ="manualacceptbtn" class="btn btn-success"><?php echo VAMACARS_VALIDATION_ACCEPT; ?></button>
							<button type="button" id="manualrejectbtn" name ="manualrejectbtn" class="btn btn-warning"><?php echo VAMACARS_VALIDATION_REJECT; ?></button>
							<button type="button" id="manualdeletebtn" name ="manualdeletebtn" class="btn btn-danger"><?php echo VAMACARS_VALIDATION_DELETE; ?></button>
					      </div>
						</div>
						<div class="control-group">
							<div id="result"></div>
						</div>
					  </form>
					</br>
					    <div class="modal hide fade">
					      <div class="modal-body">
							<p>Thank for contacting us.</p>
							<p class="ajax_data"></p>
					      </div>
						  <div class="modal-footer">
							<a href="#" class="btn btn-primary" id="done">Done</a>
							<a href="#" class="btn" id="close">Close</a>
						  </div>
					    </div>
				</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo VAMACARS_FLITGH_DETAILS; ?></div>
			<?php
				if (!$result = $db->query($sql)) {
					die('There was an error running the query  [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()) {
					$com=$row["validator_comments"];
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
				</tr>
			</table>
			<?php
				}
			?>
			<br>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_view_week_white_18dp_1x.png">&nbsp;<?php echo PILOT_FSKEEPER_VALIDATOR; ?></div>
			<table class="table table-hover">
				<tr>
					<td><strong><?php echo VAMACARS_VALIDATOR_COMMENTS; ?></strong></td>
					<td id="td1"> <?php echo $com;?></td>
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