<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	require('check_login.php');
	require_once('create_template_fskeeper.php');
	require_once('create_template_fsacars.php');
	$id = $_SESSION["id"];
	$link_fskeeper = "tmp_templates/vam_fskeeper_$id.zip";
	$link_fsacars = "tmp_templates/vam_fsacars_$id.zip";
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_cloud_download_white_18dp_1x.png">&nbsp;<?php echo DOWNLOADS; ?></div>
			<br>
			<div class="table-responsive">
			<!-- Table -->
				<table id="downloads" class="table table-hover">
					<thead><tr>
						<th> <?php echo DOWNLOAD_NAME; ?> </th>
						<th> <?php echo DOWNLOAD_LINK; ?> </th>
					</tr></thead>
					<tr>
						<td>
							SIM ACARS 1.4.0
						</td>
						<td>
							<a href="<?php echo "vamacars/SIM_ACARS_1.4.0.zip" ; ?>  ">Link</a>
						</td>
					</tr>
					<tr>
						<td>
							FSKeeper template
						</td>
						<td>
							<a href="<?php echo $link_fskeeper ; ?> " >Link</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
