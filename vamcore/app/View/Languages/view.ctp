<?php

    if ($_SESSION["access_language_manager"] ==1)
    {
?>
<div class="hubs view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Language'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Language'); ?></td>
	              		<td><?php echo h($language['Language']['language_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('File sufix'); ?></td>
	              		<td><?php echo h($language['Language']['file_sufix']); ?></td>
	              	</tr>

	              </table>
	            </div>
	          </div>
	</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('New Language'), array('action' => 'add'), array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Language'), array('action' => 'edit', $language['Language']['id']), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Language'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Language'), array('action' => 'delete', $language['Language']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $language['Language']['language_name'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Languages manager module</div>';
    }
?>
