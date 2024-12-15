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
	include('hubdd.php');
	include('countriesdd.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	//  Get va parameters
	$sql = "select * from gvausers where activation=1";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$number_current_pilots = $result->num_rows;
	if ($number_pilots < $number_current_pilots){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo REGISTER_WRONG; ?></div>
			<div class="alert alert-danger" role="alert"><?php echo REGISTER_CLOSED_MSG; ?></div>
			<div>
				<div>
					<div>
						<?php
							}
							else {
								?>
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<!-- Default panel contents -->
											<div class="panel-heading"><?php echo REGISTER_FORM; ?></div>
											<p>
											<form class="form-horizontal" id="register-form"
											      action="./index.php?page=pilot_insert" role="form" method="post">
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="name"><?php echo PILOT_NAME_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="name" id="name"
														       placeholder="<?php echo PILOT_NAME_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="surname"><?php echo PILOT_LASTNAME_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="surname"
														       id="surname"
														       placeholder="<?php echo PILOT_LASTNAME_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="birthday"><?php echo PILOT_BIRTHDATE_REG_FORM; ?></label>
													<div class="col-sm-4">
														<div class='input-group date' id='datetimepicker'>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
															<input type='text' name="birthdate" id="birthdate"
															       class="form-control"/>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="ivao"><?php echo PILOT_IVAOID_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="ivao" id="ivao"
														       placeholder="<?php echo PILOT_IVAOID_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="vatsim"><?php echo PILOT_VATSIMID_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="vatsim"
														       id="vatsim"
														       placeholder="<?php echo PILOT_VATSIMID_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="language"><?php echo PILOT_LANGUAGE_REG_FORM; ?></label>
													<div class="col-sm-4">
														<select class="form-control" name="language" id="language">
															<?php echo $combolanguage; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="country"><?php echo PILOT_COUNTRY_REG_FORM; ?></label>
													<div class="col-sm-4">
														<select class="form-control" name="country" id="country">
															<?php echo $combocountry; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="city"><?php echo PILOT_CITY_REG_FORM; ?>
													</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="city" id="city"
														       placeholder="<?php echo PILOT_CITY_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="hub"><?php echo PILOT_HUB_REG_FORM; ?></label>
													<div class="col-sm-4">
														<select class="form-control" name="hub" id="hub">
															<?php echo $combohub_id; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="email"><?php echo PILOT_EMAIL_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="email" class="form-control" name="email" id="email"
														       placeholder="<?php echo PILOT_EMAIL_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="password"><?php echo PILOT_PASSWORD_REG_FORM; ?></label>
													<div class="col-sm-4">
														<input type="password" class="form-control" name="password"
														       id="password"
														       placeholder="<?php echo PILOT_PASSWORD_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="password2"><?php echo PILOT_CONFIRMPASSWORD_FORM; ?></label>
													<div class="col-sm-4">
														<input type="password" class="form-control" name="password2"
														       id="password2"
														       placeholder="<?php echo PILOT_PASSWORD_PLACEHOLER_REG_FORM; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2"
													       for="notes"><?php echo PILOT_COMMENTS_REG_FORM; ?></label>
													<div class="col-sm-10">
														<textarea class="form-control" name="notes" id="notes" rows="3"
														          placeholder="<?php echo PILOT_COMMENTS_PLACEHOLER_REG_FORM; ?>"></textarea>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-6">
														<div class="checkbox">
															<label>
																<input type="checkbox" required  name="rules" value="yes">
																<a href="./index.php?page=rules" ><?php echo READ_RULES; ?><a/>
															</label>
														</div>
													</div>
													<p>
													<div class="col-sm-offset-2 col-sm-6">
														<?php echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">'; ?>
														<p>
														</br>
														<input type="text" class="form-control" name="captcha" id="captcha">
														<input type="hidden"  name="captchahidden" id="captchahidden" value="<?php echo $_SESSION['captcha']['code']?>">
														<br>
														<button type="submit"
														        class="btn btn-primary"><?php echo BUTTONSUBMIT_REG_FORM; ?>
														</button>
														</br>
													</div>
												</div>
										</div>
									</div>
									<div class="clearfix visible-lg"></div>
								</div>
							<?php
							} // Else close
						?>
