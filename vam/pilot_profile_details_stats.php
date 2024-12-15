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
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_person_white_18dp_1x.png">&nbsp;<?php echo PILOT_PROFILE; ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<td colspan="2">
							<?php if (strlen ($pilot_image)<=10)
							{
								$pilot_image="./uploads/pilot_default.png";
							}
							echo '<img src='.$pilot_image.' width="100%" >'; ?>
						</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
		<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_person_white_18dp_1x.png">&nbsp;<?php echo PILOT_PROFILE; ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<td><?php echo PILOT_NAME; ?></td>
						<td><?php echo $pilotname . ' ' . $pilotsurname; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_CALLSIGN; ?></td>
						<td><?php echo $callsign; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_COUNTRY; ?></td>
						<td><?php echo $country; ?>
							<?php echo '<img src="./images/country-flags/' . $country_flag . '.png" alt="' . $country_flag . '">' ?>
						</td>
					</tr>
					<tr>
						<td><?php echo PILOT_CITY; ?></td>
						<td><?php echo $city; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_HUB; ?></td>
						<td><?php echo $hub;?>
						<?php if (isset($hub_airport_flag))
						{
							echo '<img src="./images/country-flags/' . $hub_airport_flag . '.png" alt="' . $hub_airport_flag . '">';
						} ?>
						<?php if (isset($hub_airport_name))
						{
							echo '<font size="1">&nbsp;'.str_replace ("Airport","",$hub_airport_name).'</font>';
						} ?>
						</td>
					</tr>
					<tr>
						<td><?php echo PILOT_LOCATION; ?></td>
						<td><?php echo strtoupper($location); ?>
							<?php echo '<img src="./images/country-flags/' . $location_airport_flag . '.png" alt="' . $location_airport_flag . '">' ?>
							<?php echo '<font size="1">&nbsp;'.str_replace("Airport","",$location_airport_name).'</font>'; ?>
						</td>
					</tr>
					<tr>
						<td><?php echo PILOT_RANK; ?></td>
						<td><?php echo '<img src="'.$rank_url_image.'" alt="some_text">&nbsp;' ?><?php echo $rank; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_SALARY; ?></td>
						<td><?php echo $salary_hour; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_MONEY; ?></td>
						<td><?php echo $money . ' ' . $currency;; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_REGISTERDATE; ?></td>
						<td><?php echo $register_date; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo PILOT_STATICS; ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<td><?php echo PILOT_FLIGHTS; ?></td>
						<td><?php echo $num_fsacars + $num_fskeeper + $num_pireps + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_HOURS; ?></td>
						<td><?php echo convertTime(($transfered_hours + $gva_hours),$va_date_format); ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_DISTANCE; ?></td>
						<td><?php echo $dist_pireps + $dist_fskeeper + $dist_fsacars  + $dist_vamacars - $dist_pireps_rejected - $dist_fskeeper_rejected - $dist_fsacars_rejected - $dist_vamacars_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FLIGHTSREGULAR; ?></td>
						<td><?php echo $num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FLIGHTSCHARTER; ?></td>
						<td><?php echo $num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_pireps_reg - $num_fskeeper_reg - $num_fsacars_reg - $num_vamacars_reg - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_PERFLIGHTREGULAR; ?></td>
						<td><?php
								if (($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) < 1) {
									echo '0 %';
								} else {
									echo number_format((100 * ($num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected)) / ($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) , 2) . ' %';
								};?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_MANUALREPORT; ?></td>
						<td><?php echo $num_pireps - $num_pireps_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FSKEEPERREPORT; ?></td>
						<td><?php echo $num_fskeeper - $num_fskeeper_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FSACARSREPORT; ?></td>
						<td><?php echo $num_fsacars - $num_fsacars_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_VAMACARSREPORT; ?></td>
						<td><?php echo $num_vamacars - $num_vamacars_rejected; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
