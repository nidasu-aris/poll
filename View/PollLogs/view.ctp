<div class="pollLogs view">
<h2><?php  echo __('Poll Log');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pollLog['PollLog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Poll'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pollLog['Poll']['id'], array('controller' => 'polls', 'action' => 'view', $pollLog['Poll']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Poll Answer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pollLog['PollAnswer']['title'], array('controller' => 'poll_answers', 'action' => 'view', $pollLog['PollAnswer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($pollLog['PollLog']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Agent'); ?></dt>
		<dd>
			<?php echo h($pollLog['PollLog']['user_agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pollLog['PollLog']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Poll Log'), array('action' => 'edit', $pollLog['PollLog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Poll Log'), array('action' => 'delete', $pollLog['PollLog']['id']), null, __('Are you sure you want to delete # %s?', $pollLog['PollLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Poll Logs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll Log'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Polls'), array('controller' => 'polls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll'), array('controller' => 'polls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Poll Answers'), array('controller' => 'poll_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll Answer'), array('controller' => 'poll_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
