<?php

    if ($_SESSION["access_notam_manager"] ==1)
    {
?>
<div class="noticias form">
<?php echo $this->Form->create('Notam'); ?>
	<fieldset>
		<legend><?php echo __('Add Notam'); ?></legend>
	<?php
		echo $this->Form->input('create_date');
		echo $this->Form->input('publish_date');
		echo $this->Form->input('hide_date');
		echo $this->Form->input('notam_name');
		echo $this->Ck->input('notam_text');
	
	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Notams'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to NOTAM manager module</div>';
    }
?>
