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
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading"><?php echo CHANGE_LOCATION; ?></div>
					<p>
					<form class="form-horizontal" action="./index_vam_op.php?page=jump_insert" role="form" method="post">
						<div class="form-group">
							<label class="control-label col-sm-2" for="destiny"><?php echo CHANGE_LOCATION_ICAO; ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="destiny" id="destiny"
								       placeholder="<?php echo CHANGE_LOCATION_SUBMIT_BTN; ?>">
							</div>
						</div>
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
