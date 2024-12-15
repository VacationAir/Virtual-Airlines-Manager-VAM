<?php

    if ($_SESSION["access_fleet_manager"] ==1)
    {
?>
<div class="fleets view">

	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Fleet'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Fleet Type'); ?></td>
	              		<td><?php echo $this->Html->link($fleet['Fleettype']['plane_icao'], array('controller' => 'fleettypes', 'action' => 'view', $fleet['Fleettype']['fleettype_id'])); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Registry'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['registry']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Location'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['location']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hours'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['hours']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Status'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['status']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Booked'); ?></td>
	              		<?php $booked='No'; if ($fleet['Fleet']['booked']==1) $booked='Yes'  ; ?>
	              		<td><?php echo $booked; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Name'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hub'); ?></td>
	              		<td><?php echo $this->Html->link($fleet['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $fleet['Hub']['hub_id'])); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hangar'); ?></td>
	              		<?php $hangar='No'; if ($fleet['Fleet']['hangar']==1) $hangar='Yes'  ; ?>
	              		<td><?php echo $hangar; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hangardate'); ?></td>
	              		<td><?php echo h($fleet['Fleet']['hangardate']); ?></td>
	              	</tr>
	           
	              </table>
	        </div>
	    </div>
	</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Fleet'), array('action' => 'edit', $fleet['Fleet']['fleet_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('List Fleets'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fleet'), array('action' => 'delete', $fleet['Fleet']['fleet_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleet['Fleet']['registry'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet manager module</div>';
    }
?>
