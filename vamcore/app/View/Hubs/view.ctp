<?php

    if ($_SESSION["access_hub_manager"] ==1)
    {
?>
<div class="hubs view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Hub'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Hub'); ?></td>
	              		<td><?php echo h($hub['Hub']['hub']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Web'); ?></td>
	              		<td><?php echo h($hub['Hub']['web']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Image URL'); ?></td>
	              		<td><?php echo h($hub['Hub']['image_url']); ?></td>
	              	</tr>
	              </table>
	            </div>
	          </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Hub'), array('action' => 'edit', $hub['Hub']['hub_id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Hubs'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hub'), array('action' => 'add'), array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Hub'), array('action' => 'delete', $hub['Hub']['hub_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $hub['Hub']['hub'])); ?> </li>
		
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pilots'); ?></h3>
	<?php if (!empty($hub['Gvauser'])): ?>
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
		foreach ($hub['Gvauser'] as $gvauser): ?>
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
        echo '<div class="alert alert-danger"> You do not have access to Hub manager module</div>';
    }
?>
