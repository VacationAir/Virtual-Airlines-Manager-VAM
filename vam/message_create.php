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
	include('pilotsdd.php');
	if (is_logged())
	{
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><IMG src="images/icons/ic_mail_outline_white_18dp_1x.png">&nbsp;<?php echo MAILS_NEW ?></div>
					<p>
					<form class="form-horizontal" id="new-message-form" action="./index_vam_op.php?page=message_insert"
					      role="form" method="post">
						<div class="form-group">
							<label class="control-label col-sm-2" for="to"><?php echo MAILS_NEW_TO ?></label>
							<div class="col-md-8">
								<select class="form-control" name="to" id="to">
									<?php echo $combopilot; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" for="subject"><?php echo MAILS_SUBJECT ?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="subject" id="subject"
								       placeholder="<?php echo MAILS_SUBJECT_PH ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="message"><?php echo MAILS_MESSAGE; ?></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="message" id="message" rows="8"
								          placeholder="<?php echo MAILS_MESSAGE_PH; ?>"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" class="btn btn-primary"><?php echo MAILS_SEND_BTN ?></button>
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