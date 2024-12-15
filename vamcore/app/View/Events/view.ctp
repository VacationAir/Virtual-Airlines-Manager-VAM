<?php
  
    if ($_SESSION["access_event_manager"] ==1)
    {
?>
<div class="events view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Event'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Event Name'); ?></td>
	              		<td><?php echo h($event['Event']['event_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Create Date'); ?></td>
	              		<td><?php echo h($event['Event']['create_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Publish Date'); ?></td>
	              		<td><?php echo h($event['Event']['publish_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hide Date'); ?></td>
	              		<td><?php echo h($event['Event']['hide_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Event Description'); ?></td>
	              		<td><?php echo h($event['Event']['event_text']); ?></td>
	              	</tr>
	              </table>
	        </div>
	    </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['event_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['event_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $event['Event']['event_id'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Events manager module</div>';
    }
?>
