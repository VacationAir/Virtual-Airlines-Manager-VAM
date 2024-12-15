<?php

    if ($_SESSION["access_fleet_type_manager"] ==1)
    {
?>
<div class="fleettypes index">
	<h2><?php echo __('Fleet types'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('plane_icao'); ?></th>
			<th><?php echo $this->Paginator->sort('plane_description'); ?></th>
			<th><?php echo $this->Paginator->sort('pax'); ?></th>
			<th><?php echo $this->Paginator->sort('crew_members'); ?></th>
			<th><?php echo $this->Paginator->sort('cargo_capacity'); ?></th>
			<th><?php echo $this->Paginator->sort('unit_price'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fleettypes as $fleettype): ?>
	<tr>
		<td><?php echo h($fleettype['Fleettype']['plane_icao']); ?>&nbsp;</td>
		<td><?php echo h($fleettype['Fleettype']['plane_description']); ?>&nbsp;</td>
		<td><?php echo h($fleettype['Fleettype']['pax']); ?>&nbsp;</td>
		<td><?php echo h($fleettype['Fleettype']['crew_members']); ?>&nbsp;</td>
		<td><?php echo h($fleettype['Fleettype']['cargo_capacity']); ?>&nbsp;</td>
		<td><?php echo h($fleettype['Fleettype']['unit_price']); ?>&nbsp;</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $fleettype['Fleettype']['fleettype_id']),
                       array('escape' => false));?>
            <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $fleettype['Fleettype']['fleettype_id']),
                       array('escape' => false));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fleettype['Fleettype']['fleettype_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleettype['Fleettype']['plane_icao'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
		<ul class="pagination">
		<?php
		  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
		  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
		  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
		?>
		</ul>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		
		<li><?php echo $this->Html->link(__('List Fleets'), array('controller' => 'fleets', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('controller' => 'fleets', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet Type manager module</div>';
    }
?>
