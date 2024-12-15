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
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$no_count_rejected = $row["no_count_rejected"];
	}
	if ($no_count_rejected==1)
	{
		$sql = "select g.gvauser_id as gvauser_id,g.rank_id as rank_id,callsign , name,surname, sum_time, g.transfered_hours , (v.sum_time + g.transfered_hours) as total_time from v_top_hours_rejected v inner join gvausers g on g.gvauser_id = v.pilot  order by total_time desc limit 5";
	}
	else
	{
		$sql = "select g.gvauser_id as gvauser_id,g.rank_id as rank_id,callsign , name,surname, sum_time, g.transfered_hours , (v.sum_time + g.transfered_hours) as total_time from v_top_hours v inner join gvausers g on g.gvauser_id = v.pilot  order by total_time desc limit 5";
	}
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$pilot = $row['gvauser_id'];
		$total_time_current=$row['total_time'];
		$rank_current= $row['rank_id'];
		$sql2 = "select rank_id from ranks where minimum_hours<=$total_time_current and maximum_hours >$total_time_current";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row2 = $result2->fetch_assoc()) {
			$rank_new= $row2['rank_id'];
			$sql3 = "update gvausers set rank_id=$rank_new where gvauser_id=$pilot";
			if (!$result3 = $db->query($sql3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
	}
?>
