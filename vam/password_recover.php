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
	<div class="col-md-8">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><?php echo FORGOT_PASSWORD ?></div>
			<p>

			<form class="form-horizontal" id="password-recover-form" action="./index.php?page=password_reset"
			      role="form" method="post">
				<div class="form-group">
					<label class="control-label col-sm-2"
					       for="callsign"><?php echo PILOT_CALLSIGN_PASSWORD_FORM ?></label>

					<div class="col-md-4">
						<input type="text" class="form-control" name="callsign" id="callsign"
						       placeholder="<?php echo PILOT_CALLSIGN_PLACEHOLDER_PASSWORD_FORM ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2" for="email"><?php echo PILOT_EMAIL_PASSWORD_FORM ?></label>

					<div class="col-md-4">
						<input type="email" class="form-control" name="email" id="email"
						       placeholder="<?php echo PILOT_EMAIL_PLACEHOLDER_PASSWORD_FORM ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-2">
						<button type="submit" class="btn btn-primary"><?php echo BUTTONSUBMIT_PASSWORD_FORM ?></button>
					</div>
				</div>
			</form>

		</div>
	</div>

	<div class="clearfix visible-lg"></div>
</div>
