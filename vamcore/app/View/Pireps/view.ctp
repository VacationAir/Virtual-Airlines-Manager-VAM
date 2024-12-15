<?php

    if ($_SESSION["access_manual_manager"] ==1)
    {
?>
<div class="pireps view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Pirep'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Date'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Departure'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['from_airport']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Arrival'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['to_airport']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Duration'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['duration']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Distance'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['distance']); ?></td>
	              	</tr>
	               	<tr>
	              		<td><?php echo __('Fuel used'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['fuel']); ?></td>
	              	</tr>	
	             	<tr>
	              		<td><?php echo __('Plane Type'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['plane_type']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Charter/Regular'); ?></td>
	              		<?php $value='Regular';
	              			  if ($pirep['Pirep']['charter']==1) $value='Chater'; 
	              	    ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>	
	        	    <tr>
	              		<td><?php echo __('Pilot Comments'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['comment']); ?></td>
	              	</tr>	
	              	<tr>
	              		<td><?php echo __('Pirep status'); ?></td>
	              		<?php $value='Pending validation';
	              			  if ($pirep['Pirep']['valid']==1) $value='Accepted'; 
	              			  if ($pirep['Pirep']['valid']==2) $value='Rejected'; 
	              	    ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>	
	              	<tr>
	              		<td><?php echo __('Validator Comments'); ?></td>
	              		<td><?php echo h($pirep['Pirep']['validator_comments']); ?></td>
	              	</tr>	      			
	              </table>
	            </div>
	          </div>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__('Edit Pirep'), array('action' => 'edit', $pirep['Pirep']['pirep_id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('List Pireps'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('New Pirep'), array('action' => 'add'), array('class' => 'btn btn-md btn-success')); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Pirep'), array('action' => 'delete', $pirep['Pirep']['pirep_id']),  array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $pirep['Pirep']['pirep_id'])); ?> </li>
		</ul>
	</div>

</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Manual Pireps manager module</div>';
    }
?>
