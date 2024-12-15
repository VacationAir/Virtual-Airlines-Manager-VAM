<?php



	/*--HEADER--------------------------------------------------------------------------*/

	/*                                                                                  */

	/*    Project   : Live ACARS Demo PIREP Service v3.0.1                              */

	/*    Author    : Thomas Molitor                                                    */

	/*    Company   : Thomas Molitor EDV Service                                        */

	/*    Copyright : Copyright  2002-2009 Thomas Molitor                               */

	/*                                                                                  */

	/*    Notes:   Adpated by Alejandro Garcia for VAM virtualairlinesmanager.net       */

	/*                                                                                  */

	/*                                                                                  */

	/*                                                                                  */

	/*--END-----------------------------------------------------------------------------*/



	function convert_timestamp($timestamp)

	{

		$timestring = substr($timestamp , 0 , 4) . '-' . substr($timestamp , 4 , 2) . '-' . substr($timestamp , 6 , 2) . ' ' .

			substr($timestamp , 8 , 2) . ':' . substr($timestamp , 10 , 2) . ':' . substr($timestamp , 12 , 2);

		return strtotime($timestring);

	}





	if (!isset($_REQUEST["ID"])) die("There is no PIREP ID given.");



	$pirepfsfk_id = $_REQUEST["ID"];



	

	/* Connect to Database */

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}



	// Execute SQL query

	$sql = "SELECT * from pirepfsfk WHERE pirepfsfk_id = '" . $pirepfsfk_id . "'";
	$IDPIREP='';

?>

<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">

			<div class="panel-heading"><?php echo FSKEEPER_TRACK; ?></div>



			<?php

				if (!$result = $db->query($sql)) {

					die('There was an error running the query  [' . $db->error . ']');

				}

				while ($row = $result->fetch_assoc()) {
					$IDPIREP=$row["IDPIREP"];

			?>

			<table class="table table-hover">

				<tr>

					<td><strong><?php echo FSKEEPER_PILOT; ?></strong></td>

					<td><?php echo $row["PilotName"]; ?></td>

					<td><strong><?php echo FSKEEPER_AIRCRAFT; ?></strong></td>

					<td><?php echo $row["AircraftType"]; ?></td>

					<td><strong><?php echo FSKEEPER_DISTANCE; ?></strong></td>

					<td><?php echo $row["DistanceFlight"] . 'NM'; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_DEPARTURE; ?></strong></td>

					<td><?php echo $row["OriginAirport"]; ?></td>

					<td><strong><?php echo FSKEEPER_ARRIVAL; ?></strong></td>

					<td><?php echo $row["DestinationAirport"]; ?></td>

					<td><strong><?php echo FSKEEPER_TIME; ?></strong></td>

					<td><?php echo $row["FlightTime"]; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_VALIDATED; ?></strong></td>

					<td><?php if ($row["validated"] == '1') {

							echo FSKEEPER_STATUS_VALIDATED;

						} elseif

							($row["validated"] == '2'){

							echo FSKEEPER_STATUS_REJECTED;

						} else {

							echo FSKEEPER_STATUS_NOVALIDATED;

						} ?></td>

					<td><strong><?php echo FSKEEPER_TYPE; ?></strong></td>

					<td><?php if ($row["charter"] == '1') {

							echo FSKEEPER_FLIGHT_CHARTER;

						} else {

							echo FSKEEPER_FLIGHT_REGULAR;

						} ?></td>

					<td><strong><?php echo FSKEEPER_REGISTRY; ?></strong></td>

					<td><?php echo $row["TailNumber"]; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_DEPARTURE_SID; ?></strong></td>

					<td><?php echo $row["SID"]; ?></td>

					<td><strong><?php echo FSKEEPER_DEPARTURE_RWY; ?></strong></td>

					<td><?php echo $row["OriginRunway"]; ?></td>

					<td><strong><?php echo FSKEEPER_DEPARTURE_TRANS; ?></strong></td>

					<td><?php echo $row["OriginTA"]; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_ARRIVAL_SID; ?></strong></td>

					<td><?php echo $row["STAR"]; ?></td>

					<td><strong><?php echo FSKEEPER_ARRIVAL_RWY; ?></strong></td>

					<td><?php echo $row["DestinationRunway"]; ?></td>

					<td><strong><?php echo FSKEEPER_ARRIVAL_TRANS; ?></strong></td>

					<td><?php echo $row["DestinationTA"]; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_ZFW; ?></strong></td>

					<td><?php echo $row["ZFW"]; ?></td>

					<td><strong><?php echo FSKEEPER_BFUEL; ?></strong></td>

					<td><?php echo $row["BlockFuel"]; ?></td>

					<td><strong><?php echo FSKEEPER_FFUEL; ?></strong></td>

					<td><?php echo $row["FlightFuel"]; ?></td>

				</tr>

				<tr>

					<td><strong><?php echo FSKEEPER_PASSENGERS; ?></strong></td>

					<td><?php echo $row["Passenger"]; ?></td>

					<td><strong><?php echo FSKEEPER_CARGO; ?></strong></td>

					<td><?php echo $row["Cargo"]; ?></td>

					<td><strong><?php echo FSKEEPER_ALTERNATE; ?></strong></td>

					<td><?php echo $row["AlternateAirport"]; ?></td>

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

				<div class="panel-heading"><?php echo FSKEEPER_LANDING_ANALYSIS; ?></div>

				<table class="table table-hover">

					<tr>

						<td><strong><?php echo FSKEEPER_LANDVS; ?></strong></td>

						<td><?php echo $row["LandingVS"] . ' ft/min'; ?></td>

						<td><strong><?php echo FSKEEPER_LANDIAS; ?></strong></td>

						<td><?php echo $row["LandingIAS"] . ' kt'; ?></td>

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
						$vamflightid = 	$IDPIREP;				
						include ('flight_financial_report.php');
						?>
					</tr>				
			</div>
		</div>
	</div>	

	<div class="row">

		<div class="col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading"><?php echo FSKEEPER_ROUTE; ?></div>

				<table class="table table-hover">

					<tr>

						<td><strong><?php echo FSKEEPER_PILOT; ?></strong></td>

						<td><?php echo $row["FlightPlan"]; ?></td>



					</tr>



				</table>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading"><?php echo FSKEEPER_CRITIQUE; ?></div>

				<table class="table table-hover">

					<tr>

						<td><?php echo FSKEEPER_SCORE . ' ' . $row["FlightScore"]; ?></td>

					</tr>

					<tr>

						<td><?php echo $row["FlightCritique"]; ?></td>

					</tr>

				</table>

			</div>

		</div>

	</div>



	<div class="row">

		<div class="col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading"><?php echo FSKEEPER_MAPS; ?></div>

				<table class="table table-hover">

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapJPG"]  ?>"></td>

					</tr>

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapWeatherJPG"]  ?>"></td>

					</tr>

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapTaxiOutJPG"]  ?>"></td>

					</tr>

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapTaxiInJPG"]  ?>"></td>

					</tr>

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapVerticalProfileJPG"]  ?>"></td>

					</tr>

					<tr>

						<td><img src="<?php echo 'FSFK/Images/PIREP/'.$row["FlightMapLandingProfileJPG"]  ?>"></td>

					</tr>

				</table>

			</div>

		</div>

	</div>

<?php

	$db->close();

	};

?>

        









