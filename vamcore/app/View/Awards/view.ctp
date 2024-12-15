<?php
    if ($_SESSION["access_award_manager"] ==1)
    {
?>
<div class="awards view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Award'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Award Name'); ?></td>
	              		<td><?php echo h($award['Award']['award_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Award Award Image url'); ?></td>
	              		<td><?php echo h($award['Award']['award_image']); ?></td>
	              	</tr>
	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Award'), array('action' => 'edit', $award['Award']['award_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Award Assignation'), array('controller' => 'tourlegs', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Award'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Award'), array('action' => 'delete', $award['Award']['award_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $award['Award']['award_name'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Award manager module</div>';
    }
?>
