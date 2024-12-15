<?php
  
    if ($_SESSION["access_manual_manager"] ==1)
    {
?>
<div class="pireps form">
<?php echo $this->Form->create('Pirep'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pirep'); ?></legend>
	<?php
		$yes_no = array('1' => 'Yes', '0' => 'No');
		echo $this->Form->input('pirep_id');
		echo $this->Form->input('date');
		echo $this->Form->input('from_airport');
		echo $this->Form->input('to_airport');
		echo $this->Form->input('duration');
		echo $this->Form->input('distance');
		echo $this->Form->input('fuel');
		echo $this->Form->input('plane_type');
		echo $this->Form->input(
		    'charter',
		    array('options' => $yes_no, 'default' => '1'));				
		echo $this->Ck->input('comments');
		echo $this->Form->input(
		    'valid',
		    array('options' => $yes_no, 'default' => '1'));							
		echo $this->Ck->input('validator_comments');		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">		
		<li><?php echo $this->Html->link(__('List Pireps'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pirep.pirep_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Pirep.pirep_id'))); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Manual pireps manager module</div>';
    }
?>
