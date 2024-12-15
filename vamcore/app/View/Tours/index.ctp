<?php

    if ($_SESSION["access_tour_manager"] ==1)
    {
?>
    <div class="tours index">
        <h2><?php echo __('Tours'); ?></h2>
        <table class="table table-striped">
        <tr>
                <th><?php echo $this->Paginator->sort('tour_name'); ?></th>
                <th><?php echo $this->Paginator->sort('tour_description'); ?></th>
                <th><?php echo $this->Paginator->sort('start_date'); ?></th>
                <th><?php echo $this->Paginator->sort('end_date'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($tours as $tour): ?>
        <tr>
            <td><?php echo h($tour['Tour']['tour_name']); ?>&nbsp;</td>
            <td><?php echo h($tour['Tour']['tour_description']); ?>&nbsp;</td>
            <td><?php echo h($tour['Tour']['start_date']); ?>&nbsp;</td>
            <td><?php echo h($tour['Tour']['end_date']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->image("view.png", array(
                    'url' => array('controller' => 'tours', 'action' => 'view', $tour['Tour']['tour_id'])
                    ));?>
                <?php echo $this->Html->image("edit.png", array(
                    'url' => array('controller' => 'tours', 'action' => 'edit', $tour['Tour']['tour_id'])
                    ));?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tour['Tour']['tour_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete  %s?', $tour['Tour']['tour_name'])); ?>
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
            <li><?php echo $this->Html->link(__('List Tour Legs'), array('controller' => 'tourLegs', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
            <li><?php echo $this->Html->link(__('New Tour'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>

        </ul>
    </div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Tour manager module</div>';
    }
?>
