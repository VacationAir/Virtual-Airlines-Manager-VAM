<?php
    
    if ($_SESSION["access_award_manager"] ==1)
    {
?>
<div class="ranks form">
<?php echo $this->Form->create('Award'); ?>
	<fieldset>
		<legend><?php echo __('Edit Award'); ?></legend>
	<?php
		echo $this->Form->input('award_id');
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
		<li><?php echo $this->Html->link(__('List Pilot Awards'), array('controller' => 'awardpilots', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Award.award_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Award.award_id'))); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Award manager module</div>';
    }
?>
