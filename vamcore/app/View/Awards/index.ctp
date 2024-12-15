<?php

    if ($_SESSION["access_award_manager"] ==1)
    {
?>
    <div class="awards index">
        <h2><?php echo __('Awards'); ?></h2>
        <table class="table table-striped">
        <tr>
                <th><?php echo $this->Paginator->sort('award_name'); ?></th>
                <th><?php echo $this->Paginator->sort('award_image'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($awards as $award): ?>
        <tr>
            <td><?php echo h($award['Award']['award_name']); ?>&nbsp;</td>
            <td><?php echo h($award['Award']['award_image']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->image("view.png", array(
                    'url' => array('controller' => 'Awards', 'action' => 'view', $award['Award']['award_id'])
                    ));?>
                <?php echo $this->Html->image("edit.png", array(
                    'url' => array('controller' => 'Awards', 'action' => 'edit', $award['Award']['award_id'])
                    ));?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $award['Award']['award_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete  %s?', $award['Award']['award_name'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
        </table>
        <p>
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
        <div class="paging">
            <ul class="pagination">
            <?php
              echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
              echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
              echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
            ?>
            </ul>
        </div>
    </div>
    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul class="list-inline">
            <li><?php echo $this->Html->link(__('List Pilot Awards'), array('controller' => 'AwardPilots', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
            <li><?php echo $this->Html->link(__('New Award'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>

        </ul>
    </div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Awards manager module</div>';
    }
?>
