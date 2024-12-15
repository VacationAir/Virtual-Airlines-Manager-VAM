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
	include('planedd.php');
	if (is_logged())
	{
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_mode_edit_white_18dp_1x.png">&nbsp;<?php echo MANUAL_PIREP; ?></div>
			<p>

			<form class="form-horizontal" id="manual-pirep-form" action="./index_vam_op.php?page=pirep_manual_pre_insert"
			      role="form" method="post">
				<div class="form-group">
					<label class="control-label col-sm-2" for="flight_date"><?php echo MANUAL_PIREP_DATE; ?></label>

					<div class="col-sm-4">
						<div class='input-group date' id='datetimepicker'>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
							<input type='text' name="flight_date" id="flight_date"
							       class="form-control"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="departure"><?php echo MANUAL_PIREP_DEP; ?></label>

					<div class="col-sm-3">
						<input type="text" class="form-control" maxlength="4" name="departure" id="departure"
						       placeholder="<?php echo MANUAL_PIREP_DEP_PH; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="arrival"><?php echo MANUAL_PIREP_ARR; ?></label>

					<div class="col-sm-3">
						<input type="text" class="form-control" maxlength="4" name="arrival" id="arrival"
						       placeholder="<?php echo MANUAL_PIREP_ARR_PH; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="distance"><?php echo MANUAL_PIREP_DISTANCE; ?></label>

					<div class="col-sm-3">
						<input type="text" class="form-control" name="distance" id="distance"
						       placeholder="<?php echo MANUAL_PIREP_DISTANCE_PH; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="duration"><?php echo MANUAL_PIREP_TIME; ?></label>

					<div class="col-sm-3">
						<input type="text" class="form-control" data-fv-digits="true" name="duration" id="duration"
						       placeholder="<?php echo MANUAL_PIREP_TIME_PH; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="fuel"><?php echo MANUAL_PIREP_FUEL; ?></label>

					<div class="col-sm-3">
						<input type="text" class="form-control" name="fuel" id="fuel"
						       placeholder="<?php echo MANUAL_PIREP_FUEL_PH; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="plane"><?php echo MANUAL_PIREP_AIRCRAFT; ?></label>

					<div class="col-sm-3">
						<select class="form-control" name="plane" id="plane">
							<?php echo $combobit; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="notes"><?php echo MANUAL_PIREP_COMMENT; ?></label>

					<div class="col-sm-8">
						<textarea class="form-control" name="notes" id="notes" rows="5"
						          placeholder="<?php echo MANUAL_PIREP_COMMENT_PH; ?>"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary"><?php echo MANUAL_PIREP_SUBMIT_BTN; ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="clearfix visible-lg"></div>
</div>
<?php
}
else
{
	include("./notgranted.php");
}
?>
