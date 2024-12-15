<?php

    if ($_SESSION["access_web_manager"] ==1)
    {
?>
<div class="hubs view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Staff'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Display position'); ?></td>
	              		<td><?php echo h($staff['Staff']['display_position']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Name'); ?></td>
	              		<td><?php echo h($staff['Staff']['name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Role'); ?></td>
	              		<td><?php echo h($staff['Staff']['role']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Image URL'); ?></td>
	              		<td><?php echo h($staff['Staff']['image_url']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Email'); ?></td>
	              		<td><?php echo h($staff['Staff']['email']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Description'); ?></td>
	              		<td><?php echo h($staff['Staff']['description']); ?></td>
	              	</tr>	     
	              </table>
	            </div>
	          </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Staff'), array('action' => 'edit', $staff['Staff']['id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Staffs'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Staff'), array('action' => 'add'), array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Staff'), array('action' => 'delete', $staff['Staff']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $staff['Staff']['name'])); ?> </li>
		
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pilots'); ?></h3>
	<?php if (!empty($staff['Gvauser'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Callsign'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($staff['Gvauser'] as $gvauser): ?>
		<tr>
			<td><?php echo $gvauser['name']; ?></td>
			<td><?php echo $gvauser['surname']; ?></td>
			<td><?php echo $gvauser['callsign']; ?></td>
			<td><?php echo $gvauser['email']; ?></td>
			<td><?php echo $gvauser['location']; ?></td>
			<td class="actions">
				<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'view', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'edit', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gvausers', 'action' => 'delete', $gvauser['gvauser_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $gvauser['callsign'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Web manager module</div>';
    }
?>
