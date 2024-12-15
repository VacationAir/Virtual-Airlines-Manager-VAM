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
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select * from gvausers gu, country_t c where gu.country=c.iso2 and gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country_user = $row["country"];
		$country_desc = $row["short_name"];
		$accept_emails_user = $row["accept_emails"];
	}
	$sql = "select short_name,iso2 from country_t order by short_name asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combocountry = "<option value='$country_user'>$country_desc</option>";
	while ($row = $result->fetch_assoc()) {
		if ($row['iso2'] == $country_user)
		{
			$combocountry .= " <option selected=selected value='" . $row['iso2'] . "'>" . $row['short_name'] . "</option>";
		}
		$combocountry .= " <option value='" . $row['iso2'] . "'>" . $row['short_name'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
	}
	// new combo for accept emails flag in my profile, used for send emails when a flight is validated
	$comboaccept_emails = '';
	if ($accept_emails_user==1)
	{
		$accept_e_user=VAMACARS_YES;
	}
	else
	{
		$accept_e_user=VAMACARS_NO;
	}
	$comboaccept_emails .= " <option selected=selected value='" . $accept_emails_user . "'>" . $accept_e_user . "</option>";
	$comboaccept_emails .= " <option value='0'>" . VAMACARS_NO . "</option>";
	$comboaccept_emails .= " <option value='1'>" . VAMACARS_YES . "</option>";
?>
