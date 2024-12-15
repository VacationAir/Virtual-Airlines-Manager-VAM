<?php

    if ($_SESSION["access_pilot_manager"] ==1)
    {
?>
<div class="gvausers index">

		<h2><?php echo __('New Pilots not activated'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('callsign'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('surname'); ?></th>
			<th><?php echo $this->Paginator->sort('register_date'); ?></th>
			<th><?php echo $this->Paginator->sort('ivaovid'); ?></th>
			<th><?php echo $this->Paginator->sort('hub'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	<?php foreach ($gvausers as $gvauser): ?>
	
	<?php if ($gvauser['Gvauser']['activation']==0) {?>
		
	
	<tr>
		<td><?php echo h($gvauser['Gvauser']['callsign']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['name']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['surname']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['register_date']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['ivaovid']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['hub']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $gvauser['Gvauser']['gvauser_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $gvauser['Gvauser']['gvauser_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gvauser['Gvauser']['gvauser_id']), null, __('Are you sure you want to delete # %s?', $gvauser['Gvauser']['callsign'])); ?>
			<?php echo $this->Form->postLink(__('Inactivate'), array('action' => 'inactivate', $gvauser['Gvauser']['gvauser_id']), null, __('Are you sure you want to inactivate # %s?', $gvauser['Gvauser']['callsign'])); ?>
		</td>
	</tr>
	
	<?php }?>
	
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
	<ul>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jumps'), array('controller' => 'jumps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pirepfsfks'), array('controller' => 'pirepfsfks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reserves'), array('controller' => 'reserves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Pilots module</div>';
    }
?>
