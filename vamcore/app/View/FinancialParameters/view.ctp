<?php

    if ($_SESSION["access_financial_parameters"] ==1)
    {
?>
<div class="FinancialParameters view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Finantial Parameters'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Parameter Active'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['parameter_active']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Financial parameter'); ?></td>
	              		<td><?php echo h($FinancialParameter['FinancialParameter']['financial_parameter']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Amount'); ?></td>
	              		<td><?php echo h($FinancialParameter['FinancialParameter']['amount']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Is Cost'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['is_cost']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Is Profit'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['is_profit']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Linked to time'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['linked_to_time']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Linked to PAX'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['linked_to_pax']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Linked to distance'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['linked_to_distance']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Linked to fuel'); ?></td>
	               		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['linked_to_fuel']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Linked to flight'); ?></td>
	              		<?php $value='NO';if ($FinancialParameter['FinancialParameter']['linked_to_flight']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	 	              		
	              	</tr>
          
	              </table>
	            </div>
	          </div>
	</div>

	
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $FinancialParameter['FinancialParameter']['id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Finantial manager module</div>';
    }
?>
