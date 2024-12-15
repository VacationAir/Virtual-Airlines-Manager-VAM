<?php
    
    if ($_SESSION["access_notam_manager"] ==1)
    {
?>
<div class="notams view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Notam'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('notam_name'); ?></td>
	              		<td><?php echo h($notam['Notam']['notam_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('create_date'); ?></td>
	              		<td><?php echo h($notam['Notam']['create_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('publish_date'); ?></td>
	              		<td><?php echo h($notam['Notam']['publish_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('hide_date'); ?></td>
	              		<td><?php echo h($notam['Notam']['hide_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('notam_name'); ?></td>
	              		<td><?php echo h($notam['Notam']['notam_text']); ?></td>
	              	</tr>	
	              </table>
	            </div>
	          </div>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__('Edit Notam'), array('action' => 'edit', $notam['Notam']['notam_id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('List Notams'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
			<li><?php echo $this->Html->link(__('New Notam'), array('action' => 'add'), array('class' => 'btn btn-md btn-success')); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Notam'), array('action' => 'delete', $notam['Notam']['notam_id']),  array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $notam['Notam']['notam_id'])); ?> </li>
		</ul>
	</div>

</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to NOTAM manager module</div>';
    }
?>
