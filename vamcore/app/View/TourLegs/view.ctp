<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="tourlegs view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Tour Leg'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Tour Name'); ?></td>
	              		<td><?php echo h($tourLeg['Tour']['tour_name']); ?></td>
	              	</tr>
                    <tr>
	              		<td><?php echo __('Leg Number'); ?></td>
	              		<td><?php echo h($tourLeg['TourLeg']['leg_number']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Departure'); ?></td>
	              		<td><?php echo h($tourLeg['TourLeg']['departure']); ?></td>
	              	</tr>

	              	<tr>
	              		<td><?php echo __('Arrival'); ?></td>
	              		<td><?php echo h($tourLeg['TourLeg']['arrival']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Leg Length'); ?></td>
	              		<td><?php echo h($tourLeg['TourLeg']['leg_length']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Route'); ?></td>
	              		<td><?php echo h($tourLeg['TourLeg']['route']); ?></td>
	              	</tr>
	           
	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Leg'), array('action' => 'edit', $tourLeg['TourLeg']['tour_leg_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Legs'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tours'), array('controller' => 'tours', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Leg'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Leg'), array('action' => 'delete', $tourLeg['TourLeg']['tour_leg_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $tourLeg['TourLeg']['leg_number'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>

