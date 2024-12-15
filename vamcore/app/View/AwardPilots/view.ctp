<?php

    if ($_SESSION["access_award_manager"] ==1)
    {
?>
<div class="awardpilots view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Award Pilot'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Award Name'); ?></td>
	              		<td><?php echo h($awardPilot['Award']['award_name']); ?></td>
	              	</tr>
                    <tr>
	              		<td><?php echo __('Pilot'); ?></td>
	              		<td><?php echo h($awardPilot['Gvauser']['name_surname']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Date'); ?></td>
	              		<td><?php echo h($awardPilot['AwardPilot']['award_date']); ?></td>
	              	</tr>

	              	<tr>
	              		<td><?php echo __('Comments'); ?></td>
	              		<td><?php echo h($awardPilot['AwardPilot']['comments']); ?></td>
	              	</tr>

	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Pilot Award'), array('action' => 'edit', $awardPilot['AwardPilot']['award_pilot_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilot Awards'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Awards'), array('controller' => 'awards', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pilot Award'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Leg'), array('action' => 'delete', $awardPilot['AwardPilot']['award_pilot_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $awardPilot['AwardPilot']['award_pilot_id'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Award manager module</div>';
    }
?>

