<?php
    
    if ($_SESSION["access_event_manager"] ==1)
    {
?>
<div class="events form">
<?php echo $this->Form->create('Event'); ?>
	<fieldset>
		<legend><?php echo __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('event_id');
		echo $this->Form->input('create_date');
		echo $this->Form->input('publish_date');
		echo $this->Form->input('hide_date');
		echo $this->Form->input('event_name');
		echo $this->Ck->input('event_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Event.event_id')) ,array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Event.event_id'))); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Events manager module</div>';
    }
?>
