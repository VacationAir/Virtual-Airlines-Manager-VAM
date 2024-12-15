<?php

    if ($_SESSION["access_financial_parameters"] ==1)
    {
?>
<div class="FinancialParameters index">
	<h2><?php echo __('Financial Parameters'); ?></h2>
	<table class="table table-striped">
	<tr>
			
			<th><?php echo $this->Paginator->sort('parameter_active'); ?></th>
			<th><?php echo $this->Paginator->sort('financial_parameter'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('is_cost'); ?></th>
			<th><?php echo $this->Paginator->sort('is_profit'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($FinancialParameters as $FinancialParameter): ?>
	<tr>
		
		<?php $parameter_active='No'; if ($FinancialParameter['FinancialParameter']['parameter_active']==1) $parameter_active='Yes'  ; ?>
		<td><?php echo h($parameter_active); ?>&nbsp;</td>

		<td><?php echo h($FinancialParameter['FinancialParameter']['financial_parameter']); ?>&nbsp;</td>
		<td><?php echo h($FinancialParameter['FinancialParameter']['amount']); ?>&nbsp;</td>
		<td><?php if (($FinancialParameter['FinancialParameter']['is_cost'])==1){ echo 'YES';}else{	echo 'NO';}?>&nbsp;</td>
		<td><?php if (($FinancialParameter['FinancialParameter']['is_profit'])==1){ echo 'YES';}else{	echo 'NO';}?>&nbsp;</td>


		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $FinancialParameter['FinancialParameter']['id']),
                       array('escape' => false));?>
            <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $FinancialParameter['FinancialParameter']['id']),
                       array('escape' => false));?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $FinancialParameter['FinancialParameter']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $FinancialParameter['FinancialParameter']['financial_parameter'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('New Parameter'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Finantial manager module</div>';
    }
?>
