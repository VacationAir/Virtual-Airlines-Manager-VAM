<?php

    if ($_SESSION["access_hub_manager"] ==1)
    {
?>
<div class="hubs form">
<?php echo $this->Form->create('Hub'); ?>
	<fieldset>
		<legend><?php echo __('Add Hub'); ?></legend>
	<?php
		echo $this->Form->input('hub');
		echo $this->Form->input('web');
		echo $this->Form->input('image_url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Hubs'), array('controller' => 'Hubs', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Hub manager module</div>';
    }
?>
