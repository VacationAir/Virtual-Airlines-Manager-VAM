<?php

    if ($_SESSION["access_web_manager"] ==1)
    {
?>
<div class="configEmails index">
	<h2><?php echo __('Web sections configuration'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('welcome_text'); ?></th>
			<th><?php echo $this->Paginator->sort('rules'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($configEmails as $configEmail): ?>
	<tr>
		<td><?php echo h($configEmail['WebConfiguration']['welcome_text']); ?>&nbsp;</td>
		<td><?php echo h($configEmail['WebConfiguration']['rules']); ?>&nbsp;</td>
		<td><?php echo h($configEmail['WebConfiguration']['school']); ?>&nbsp;</td>
		<td class="actions">

			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'WebConfigurations', 'action' => 'view', $configEmail['WebConfiguration']['id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'WebConfigurations', 'action' => 'edit', $configEmail['WebConfiguration']['id'])
				));?>


		</td>
	</tr>
<?php endforeach; ?>
	</table>


</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Web manager module</div>';
    }
?>
