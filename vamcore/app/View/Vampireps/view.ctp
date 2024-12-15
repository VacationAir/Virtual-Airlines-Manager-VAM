<?php

    if ($_SESSION["access_simacars_manager"] ==1)
    {
?>
<div class="vampireps view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Vampirep'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Date'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['flight_date']); ?></td>
	              	</tr>
	                <tr>
	              		<td><?php echo __('Callsign'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['callsign']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Departure'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['departure']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Arrival'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['arrival']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Duration'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['flight_duration']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Distance'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['distance']); ?></td>
	              	</tr>
	               	<tr>
	              		<td><?php echo __('Route'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['route']); ?></td>
	              	</tr>
	             	<tr>
	              		<td><?php echo __('Network'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['network']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Charter/Regular'); ?></td>
	              		<?php $value='Regular';
	              			  if ($vampirep['Vampirep']['charter']==1) $value='Chater';
	              	    ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	        	    <tr>
	              		<td><?php echo __('Pilot Comments'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['comments']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Vampirep status'); ?></td>
	              		<?php $value='Pending validation';
	              			  if ($vampirep['Vampirep']['validated']==1) $value='Accepted';
	              			  if ($vampirep['Vampirep']['validated']==2) $value='Rejected';
	              	    ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Validator Comments'); ?></td>
	              		<td><?php echo h($vampirep['Vampirep']['validator_comments']); ?></td>
	              	</tr>
	              </table>
	            </div>
	          </div>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vampirep['Vampirep']['id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('List'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vampirep['Vampirep']['id']),  array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete the flight %s?', $vampirep['Vampirep']['callsign'] .':' .$vampirep['Vampirep']['departure']  .'-' .$vampirep['Vampirep']['arrival'])); ?> </li>
		</ul>
	</div>

</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to SIM ACARS flights manager module</div>';
    }
?>
