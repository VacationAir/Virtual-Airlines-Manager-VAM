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
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><IMG src="images/icons/ic_apps_white_18dp_1x.png">&nbsp;<?php echo PILOT_ACTIONS; ?></h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=mails"><img src="images/Email.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_MAIL; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=route_selection_stage1"><img src="images/Map-icon.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_ROUTE_RESERVE; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="#" data-toggle="modal" data-target="#JumpModal"><img src="images/Travel-Airplane-icon.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_CHANGE_LOCATION; ?></strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=my_bank"><img src="images/money-icon.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_BANK; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=pirep_manual_create"><img src="images/validate.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_MANUAL_PIREP; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=my_profile"><img
							src="images/Occupations-Pilot-Male-Light-icon.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_PROFILE; ?></strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=pilot_profile_stats&pilotid=<?php echo $id;?>"><img src="images/estadisticas.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_STATS; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=vaparameters_info"><img src="images/fmc.jpg"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_VA_PARAMETER; ?></strong></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=download"><img src="images/download.jpg"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_DOWNLOADS; ?></strong></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-4">
				<div class="thumbnail">
					<a href="./index_vam_op.php?page=tours_pilot"><img src="images/tour.png"></a>
					<div class="caption">
						<p class="text-center"><strong><?php echo OPTION_TOUR; ?></strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="JumpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo CHANGE_LOCATION; ?></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="change-location-form" action="./index_vam_op.php?page=jump_insert"
				      role="form" method="post">
					<div class="form-group">
						<label class="control-label col-sm-2" for="destiny"><?php echo CHANGE_LOCATION_ICAO; ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="destiny" id="destiny"
							       placeholder="Enter Callsign">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit"
							        class="btn btn-primary"><?php echo CHANGE_LOCATION_SUBMIT_BTN; ?></button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
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

