<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
<div class="ranks form">
<?php echo $this->Form->create('Tour'); ?>
	<fieldset>
		<legend><?php echo __('Add Tour'); ?></legend>
	<?php
		echo $this->Form->input('tour_name');
		echo $this->Form->input('tour_description');
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

		<li><?php echo $this->Html->link(__('List Ranks'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
