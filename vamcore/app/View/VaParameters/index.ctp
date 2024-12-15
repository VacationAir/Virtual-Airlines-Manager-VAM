<?php

    if ($_SESSION["access_va_parameters"] ==1)
    {
?>
<div class="vaParameters index">
	<h2><?php echo __('Va Parameters'); ?></h2>
	<table class="table table-striped">
	<tr>

			<th><?php echo $this->Paginator->sort('Allowed pilots'); ?></th>
			<th><?php echo $this->Paginator->sort('IVAO'); ?></th>
			<th><?php echo $this->Paginator->sort('VATSIM'); ?></th>
			<th><?php echo $this->Paginator->sort('VA ICAO'); ?></th>
			<th><?php echo $this->Paginator->sort('VA Name'); ?></th>
			<th><?php echo $this->Paginator->sort('Cost jump type 1'); ?></th>
			<th><?php echo $this->Paginator->sort('Cost jump type 2'); ?></th>
			<th><?php echo $this->Paginator->sort('Cost jump type 3'); ?></th>
			<th><?php echo $this->Paginator->sort('Plane_status hangar'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing crash'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing penalty 1'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing penalty 2'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing penalty 3'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing VS penalty 1'); ?></th>
			<th><?php echo $this->Paginator->sort('Landing VS penalty 2'); ?></th>
			<th><?php echo $this->Paginator->sort('Flight wear'); ?></th>
			<th><?php echo $this->Paginator->sort('hangar_maintenance_days'); ?></th>
			<th><?php echo $this->Paginator->sort('hangar_crash_days'); ?></th>
			<th><?php echo $this->Paginator->sort('pilot_crash_penalty'); ?></th>
			<th><?php echo $this->Paginator->sort('charter_reduction'); ?></th>
			<th><?php echo $this->Paginator->sort('currency'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vaParameters as $vaParameter): ?>
	<tr>

		<td><?php echo h($vaParameter['VaParameter']['number_pilots']); ?>&nbsp;</td>
		<?php $ivao='No'; if ($vaParameter['VaParameter']['ivao']==1) $ivao='Yes'  ; ?>
		<td><?php echo h($ivao); ?>&nbsp;</td>
		<?php $vatsim='No'; if ($vaParameter['VaParameter']['vatsim']==1) $vatsim='Yes'  ; ?>
		<td><?php echo h($vatsim); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['va_icao']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['va_name']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['jump_type1']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['jump_type2']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['jump_type3']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['plane_status_hangar']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_crash']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_penalty1']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_penalty2']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_penalty3']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_vs_penalty1']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['landing_vs_penalty2']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['flight_wear']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['hangar_maintenance_days']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['hangar_crash_days']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['pilot_crash_penalty']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['charter_reduction']); ?>&nbsp;</td>
		<td><?php echo h($vaParameter['VaParameter']['currency']); ?>&nbsp;</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $vaParameter['VaParameter']['va_parameters_id']),
                       array('escape' => false));?>
            <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $vaParameter['VaParameter']['va_parameters_id']),
                       array('escape' => false));?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>

</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VA Parameters module</div>';
    }
?>
