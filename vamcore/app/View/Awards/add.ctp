<?php

    if ($_SESSION["access_award_manager"] ==1)
    {
?>
<div class="awards form">
<?php echo $this->Form->create('Award'); ?>
	<fieldset>
		<legend><?php echo __('Add Award'); ?></legend>
	<?php
		echo $this->Form->input('award_name');
		echo $this->Form->input('award_image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('List Awards'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Pilots Awards'), array('controller' => 'awardpilots', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
