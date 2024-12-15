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
	include('hubdd.php');
	include('countriesdduser.php');
	include('languagesdduser.php');
	if (is_logged())
	{
		$sql = " select * from gvausers where gvauser_id=$id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<!-- Default panel contents -->
						<div class="panel-heading"><IMG src="images/icons/ic_person_white_18dp_1x.png">&nbsp;<?php echo MY_PROFILE; ?></div>
						<p>
						<form class="form-horizontal" id="my-profile-form"
						      action="./index_vam_op.php?page=change_my_profile"
						      role="form" method="post">
							<div class="form-group">
								<label class="control-label col-sm-2" for="name"><?php echo PILOT_IMAGEUPLOADER_FORM; ?></label>
								<div class="col-sm-10">
									<a href="./index_vam_op.php?page=pilot_upload_image" ><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;Upload</a>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="name"><?php echo PILOT_NAME_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" id="name"
									       value="<?php echo $row["name"]; ?>" placeholder="<?php echo $row["name"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="surname"><?php echo PILOT_LASTNAME_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="surname" id="surname"
									       value="<?php echo $row["surname"]; ?>"
									       placeholder="<?php echo $row["surname"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="ivao"><?php echo PILOT_IVAOID_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="ivao" id="ivao"
									       value="<?php echo $row["ivaovid"]; ?>"
									       placeholder="<?php echo $row["ivaovid"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="vatsim"><?php echo PILOT_VATSIMID_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="vatsim" id="vatsim"
									       value="<?php echo $row["vatsimid"]; ?>"
									       placeholder="<?php echo $row["vatsimid"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="language"><?php echo PILOT_LANGUAGE_REG_FORM; ?></label>
								<div class="col-sm-10">
									<select class="form-control" name="language" id="country"
									        selected="<?php echo $row["language"]; ?>">
										<?php echo $combolanguage; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="country"><?php echo PILOT_COUNTRY_REG_FORM; ?></label>
								<div class="col-sm-10">
									<select class="form-control" name="country" id="country"
									        selected="selected">
										<?php echo $combocountry; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="city"><?php echo PILOT_CITY_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="city" id="city"
									       value="<?php echo $row["city"]; ?>" placeholder="<?php echo $row["city"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="hub"><?php echo PILOT_HUB_REG_FORM; ?></label>
								<div class="col-sm-10">
									<select class="form-control" name="hub" id="hub">
										<?php echo $combo_hub_user; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="email"><?php echo PILOT_EMAIL_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" id="email"
									       value="<?php echo $row["email"]; ?>" placeholder="<?php echo $row["email"]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="country"><?php echo PILOT_RECEIVE_EMAILS; ?></label>
								<div class="col-sm-10">
									<select class="form-control" name="accept_emails" id="accept_emails" selected="selected">
										<?php echo $comboaccept_emails; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="password"><?php echo PILOT_PASSWORD_REG_FORM; ?></label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="password" id="password"
									       placeholder="<?php echo PILOT_PASSWORD_PLACEHOLER_REG_FORM; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"
								       for="password2"><?php echo PILOT_CONFIRMPASSWORD_FORM; ?></label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="password2" id="password2"
									       placeholder="<?php echo PILOT_PASSWORD_PLACEHOLER_REG_FORM; ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit"
									        class="btn btn-primary"><?php echo MY_PROFILE_UPDATE_BTN; ?></button>
								</div>
							</div>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
			<?php
			$db->close();
		}
	}
	else
	{
		include("./notgranted.php");
	}
	?>
<script>
	$(document).ready(function () {
		$('#datePicker')
			.datepicker({
				format: 'mm/dd/yyyy'
			})
			.on('changeDate', function (e) {
				// Revalidate the date field
			});
</script>
