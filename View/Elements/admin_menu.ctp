<a href="#"><?php echo __('Polls'); ?></a>
<ul>
    <li><?php echo $this->Html->link(__('List'), array('plugin' => 'poll', 'controller' => 'polls', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link(__('New poll'), array('plugin' => 'poll', 'controller' => 'polls', 'action' => 'add')); ?></li>
</ul>