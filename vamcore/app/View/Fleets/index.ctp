<?php

    if ($_SESSION["access_fleet_manager"] ==1)
    {
?>
<div class="fleets index">
	<h2><?php echo __('Fleet'); ?></h2>
	<table class="table table-striped">
	<tr>
			
			<th><?php echo $this->Paginator->sort('plane_icao'); ?></th>
			<th><?php echo $this->Paginator->sort('registry'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('hours'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('booked'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('hub'); ?></th>
			<th><?php echo $this->Paginator->sort('hangar'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fleets as $fleet): ?>
	<tr>
		
		<td>
			<?php echo $this->Html->link($fleet['Fleettype']['plane_icao'], array('controller' => 'fleettypes', 'action' => 'view', $fleet['Fleettype']['fleettype_id'])); ?>
		</td>
		<td><?php echo h($fleet['Fleet']['registry']); ?>&nbsp;</td>
		
		<td><?php echo h($fleet['Fleet']['location']); ?>&nbsp;</td>
		<td><?php echo h($fleet['Fleet']['hours']); ?>&nbsp;</td>
		<td><?php echo h($fleet['Fleet']['status']); ?>&nbsp;%</td>
		<?php $booked='No'; if ($fleet['Fleet']['booked']==1) $booked='Yes'  ; ?>
		<td><?php echo $booked; ?></td>
		<td><?php echo h($fleet['Fleet']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fleet['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $fleet['Hub']['hub_id'])); ?>
		</td>



		<?php $hangar='No'; if ($fleet['Fleet']['hangar']==1) $hangar='Yes'  ; ?>
		<td><?php echo $hangar; ?></td>
			
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $fleet['Fleet']['fleet_id']),
                       array('escape' => false));?>
            <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $fleet['Fleet']['fleet_id']),
                       array('escape' => false));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fleet['Fleet']['fleet_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleet['Fleet']['registry'])); ?>
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
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet manager module</div>';
    }
?>
