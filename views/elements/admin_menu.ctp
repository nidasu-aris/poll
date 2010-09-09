<a href="#"><?php __('Polls'); ?></a>
<ul>
    <li><?php echo $html->link(__('List', true), array('plugin' => 'poll', 'controller' => 'polls', 'action' => 'index')); ?></li>
    <li><?php echo $html->link(__('New poll', true), array('plugin' => 'poll', 'controller' => 'polls', 'action' => 'add')); ?></li>
</ul>