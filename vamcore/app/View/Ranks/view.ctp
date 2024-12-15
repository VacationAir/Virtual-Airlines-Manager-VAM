<?php

    if ($_SESSION["access_rank_manager"] ==1)
    {
?>
<div class="ranks view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Rank'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Rank'); ?></td>
	              		<td><?php echo h($rank['Rank']['rank']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Salary Hour'); ?></td>
	              		<td><?php echo h($rank['Rank']['salary_hour']); ?></td>
	              	</tr>

	              	<tr>
	              		<td><?php echo __('Minimum hours'); ?></td>
	              		<td><?php echo h($rank['Rank']['minimum_hours']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Maximum hours'); ?></td>
	              		<td><?php echo h($rank['Rank']['maximum_hours']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Image url'); ?></td>
	              		<td><?php echo h($rank['Rank']['image_url']); ?></td>
	              	</tr>
	           
	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Rank'), array('action' => 'edit', $rank['Rank']['rank_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ranks'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rank'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rank'), array('action' => 'delete', $rank['Rank']['rank_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $rank['Rank']['rank'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pilots'); ?></h3>
	<?php if (!empty($rank['Gvauser'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Callsign'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Last Visit Date'); ?></th>
		<th><?php echo __('Activation'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('VAM Hours'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rank['Gvauser'] as $gvauser): ?>
		<tr>
			<td><?php echo $gvauser['callsign']; ?></td>		
			<td><?php echo $gvauser['name']; ?></td>
			<td><?php echo $gvauser['surname']; ?></td>
			<td><?php echo $gvauser['email']; ?></td>
			<td><?php echo $gvauser['last_visit_date']; ?></td>
			<?php $activation='Active'; if ($gvauser['activation']==2) $activation='Inactive'  ; ?>
			<td><?php echo $activation; ?></td>
			<td><?php echo $gvauser['location']; ?></td>
			<td><?php echo $gvauser['gva_hours']; ?></td>
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
        echo '<div class="alert alert-danger"> You do not have access to Rank manager module</div>';
    }
?>
