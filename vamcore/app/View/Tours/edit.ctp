<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="ranks form">
<?php echo $this->Form->create('Tour'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tour'); ?></legend>
	<?php
		echo $this->Form->input('tour_id');
		echo $this->Form->input('tour_name');
		echo $this->Ck->input('tour_description');
	    echo $this->Form->input('start_date');
        echo $this->Form->input('end_date');
        echo $this->Form->input('tour_image');
        echo $this->Form->input('tour_award_image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('New Leg'), array('controller' => 'tourLegs', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tour'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tour.tour_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Tour.tour_name'))); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
