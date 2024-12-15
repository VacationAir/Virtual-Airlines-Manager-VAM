<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="tourLegs form">
<?php echo $this->Form->create('TourLeg'); ?>
	<fieldset>
		<legend><?php echo __('Add Tour Leg'); ?></legend>
	<?php
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

		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
