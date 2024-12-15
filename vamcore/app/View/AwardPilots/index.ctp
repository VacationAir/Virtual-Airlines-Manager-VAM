<?php

    if ($_SESSION["access_award_manager"] ==1)
    {
?>
<div class="awardpilots index">
	<h2><?php echo __('Awards Pilots'); ?></h2>
	<table class="table table-striped">
	<tr>
	        <th><?php echo $this->Paginator->sort('award'); ?></th>
	        <th><?php echo $this->Paginator->sort('gvauser_id'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($awardPilots as $awardpilot): ?>
	<tr>
		<td>
        	<?php echo $this->Html->link($awardpilot['Award']['award_name'], array('controller' => 'awards', 'action' => 'view', $awardpilot['Award']['award_id'])); ?>
        </td>
        <td><?php echo $this->Html->link($awardpilot['Gvauser']['name_surname'], array('controller' => 'gvausers', 'action' => 'view', $awardpilot['AwardPilot']['gvauser_id'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'AwardPilots', 'action' => 'view', $awardpilot['AwardPilot']['award_pilot_id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'AwardPilots', 'action' => 'edit', $awardpilot['AwardPilot']['award_pilot_id'])
				));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $awardpilot['AwardPilot']['award_pilot_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete Award Pilot Assignation %s?', $awardpilot['AwardPilot']['award_pilot_id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Awards'), array('controller' => 'Awards', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pilot Award Assignation'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>

	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Award manager module</div>';
    }
?>
