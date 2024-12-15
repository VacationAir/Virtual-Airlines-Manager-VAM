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
		$message_id = $_GET['mail'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = 'update messages set status=2, readdate=now() where message_id=' . $message_id;
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$sql = 'select * from messages m, gvausers u where u.gvauser_id= m.user_from and  m.message_id=' . $message_id;
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$from = $row["callsign"] . '-' . $row["name"] . ' ' . $row["surname"];
			$subject = $row["subject"];
			$message = $row["text"];
			$date = $row["sentdate"];
		}
		$db->close();
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_mail_outline_white_18dp_1x.png">&nbsp;<?php echo MAILS ?></div>
				<p>
				<form class="form-horizontal" id="password-recover-form" action="./index.php?page=password_reset.php"
				      role="form" method="post">
					<div class="form-group">
						<label class="control-label col-sm-2" for="date"><?php echo MAILS_DATE ?></label>
						<div class="col-md-4">
							<input type="text" class="form-control" readonly name="date" id="date"
							       placeholder="<?php echo $date; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="from"><?php echo MAILS_FROM ?></label>
						<div class="col-md-4">
							<input type="text" class="form-control" readonly name="from" id="from"
							       placeholder="<?php echo $from; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="subject"><?php echo MAILS_SUBJECT ?></label>
						<div class="col-md-4">
							<input type="text" class="form-control" readonly name="subject" id="subject"
							       placeholder="<?php echo $subject; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="message"><?php echo MAILS_MESSAGE ?></label>
						<div class="col-md-8">
							<textarea name="message" class="form-control" readonly rows="8" style="width:100%"
							          id="message"><?php echo $message; ?></textarea>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
	<!-- Reply -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"><IMG src="images/icons/ic_mail_outline_white_18dp_1x.png">&nbsp;<?php echo MAILS_REPLY ?></div>
				<p>
				<form class="form-horizontal" id="new-message-form"
				      ACTION="./index_vam_op.php?page=message_reply&mail=<?php echo $message_id ?>" role="form"
				      method="post">
					<div class="form-group">
						<label class="control-label col-sm-2" for="message"><?php echo MAILS_MESSAGE; ?></label>
						<div class="col-sm-8">
							<textarea class="form-control" name="message_reply" id="message_reply" rows="8"
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
