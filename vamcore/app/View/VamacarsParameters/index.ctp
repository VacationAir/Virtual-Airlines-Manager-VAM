<?php
 
    if ($_SESSION["access_vam_acars_manager"] ==1)
    {
?>
<div class="vamacarsParameters index">
	<h2><?php echo __('Vamacars Parameters'); ?></h2>
	<table class="table table-striped">
	<tr>
		<th><?php echo $this->Paginator->sort('crash'); ?></th>
		<th><?php echo $this->Paginator->sort('beacon_off'); ?></th>
		<th><?php echo $this->Paginator->sort('ias_below_10000_ft'); ?></th>
		<th><?php echo $this->Paginator->sort('lights_below_10000_ft'); ?></th>
		<th><?php echo $this->Paginator->sort('lights_above_10000_ft'); ?></th>
		<th><?php echo $this->Paginator->sort('stall'); ?></th>
		<th><?php echo $this->Paginator->sort('overspeed'); ?></th>
		<th><?php echo $this->Paginator->sort('pause'); ?></th>
		<th><?php echo $this->Paginator->sort('refuel'); ?></th>
		


		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vamacarsParameters as $vamacarsParameter): ?>
	<tr>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['crash']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['beacon_off']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['ias_below_10000_ft']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['lights_below_10000_ft']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['lights_above_10000_ft']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['stall']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['overspeed']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['pause']); ?>&nbsp;</td>
		<td><?php echo h($vamacarsParameter['VamacarsParameter']['refuel']); ?>&nbsp;</td>		
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $vamacarsParameter['VamacarsParameter']['vamacars_parameters_id']),
                       array('escape' => false));?>
            <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $vamacarsParameter['VamacarsParameter']['vamacars_parameters_id']),
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
        echo '<div class="alert alert-danger"> You do not have access to VAM ACARS manager module</div>';
    }
?>
