<?php

    if ($_SESSION["access_web_manager"] ==1)
    {
?>
<div class="webConfigurations view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Web Configuration'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Welcome Text'); ?></td>
	              		<td><?php echo h($webConfiguration['WebConfiguration']['welcome_text']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Rules'); ?></td>
	              		<td><?php echo h($webConfiguration['WebConfiguration']['rules']); ?></td>
	              	</tr>
   
	              </table>
	            </div>
	          </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Web Configuration'), array('action' => 'edit', $webConfiguration['WebConfiguration']['id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Web Configuration'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Web manager module</div>';
    }
?>
