<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="tours view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Tour'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Tour Name'); ?></td>
	              		<td><?php echo h($tour['Tour']['tour_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Tour description'); ?></td>
	              		<td><?php echo h($tour['Tour']['tour_description']); ?></td>
	              	</tr>

	              	<tr>
	              		<td><?php echo __('Start Date'); ?></td>
	              		<td><?php echo h($tour['Tour']['start_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('End Date'); ?></td>
	              		<td><?php echo h($tour['Tour']['end_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Tour Image url'); ?></td>
	              		<td><?php echo h($tour['Tour']['tour_image']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Tour Award Image url'); ?></td>
	              		<td><?php echo h($tour['Tour']['tour_award_image']); ?></td>
	              	</tr>
	           
	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Tour'), array('action' => 'edit', $tour['Tour']['tour_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Leg'), array('controller' => 'tourLegs', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tour'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tour'), array('action' => 'delete', $tour['Tour']['tour_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $tour['Tour']['tour_name'])); ?> </li>
	</ul>
</div>





</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
