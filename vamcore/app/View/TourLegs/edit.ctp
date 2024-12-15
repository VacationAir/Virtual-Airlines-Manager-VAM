<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="tourlegs form">
<?php echo $this->Form->create('TourLeg'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tour Leg'); ?></legend>
	<?php
	echo $this->Form->input('tour_leg_id');
		echo $this->Form->input('tour_id');
		echo $this->Form->input('leg_number');
		echo $this->Form->input('departure');
		echo $this->Form->input('arrival');
		echo $this->Form->input('leg_length');
		echo $this->Form->input('route');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">		
		<li><?php echo $this->Html->link(__('List Tour Legs'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Tours'), array('controller' => 'tours', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Leg'), array('action' => 'delete', $this->Form->value('TourLeg.tour_leg_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('TourLeg.leg_number'))); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
