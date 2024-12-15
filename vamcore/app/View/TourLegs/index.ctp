<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="tourlegs index">
	<h2><?php echo __('Tour Legs'); ?></h2>
	<table class="table table-striped">
	<tr>
	        <th><?php echo $this->Paginator->sort('tour'); ?></th>
	        <th><?php echo $this->Paginator->sort('leg_number'); ?></th>
			<th><?php echo $this->Paginator->sort('departure'); ?></th>
			<th><?php echo $this->Paginator->sort('arrival'); ?></th>
			<th><?php echo $this->Paginator->sort('leg_length'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tourLegs as $tourleg): ?>
	<tr>
		<td>
        	<?php echo $this->Html->link($tourleg['Tour']['tour_name'], array('controller' => 'tours', 'action' => 'view', $tourleg['Tour']['tour_id'])); ?>
        </td>
        <td><?php echo h($tourleg['TourLeg']['leg_number']); ?>&nbsp;</td>
		<td><?php echo h($tourleg['TourLeg']['departure']); ?>&nbsp;</td>
		<td><?php echo h($tourleg['TourLeg']['arrival']); ?>&nbsp;</td>
		<td><?php echo h($tourleg['TourLeg']['leg_length']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'tourLegs', 'action' => 'view', $tourleg['TourLeg']['tour_leg_id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'tourLegs', 'action' => 'edit', $tourleg['TourLeg']['tour_leg_id'])
				));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tourleg['TourLeg']['tour_leg_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete Leg %s?', $tourleg['TourLeg']['leg_number'])); ?>
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
		<li><?php echo $this->Html->link(__('List Tours'), array('controller' => 'tours', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tour Leg'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
