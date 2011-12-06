<div class="pollLogs index">
	<h2><?php echo __('Poll Logs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('poll_id');?></th>
			<th><?php echo $this->Paginator->sort('poll_answer_id');?></th>
			<th><?php echo $this->Paginator->sort('ip_address');?></th>
			<th><?php echo $this->Paginator->sort('user_agent');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pollLogs as $pollLog): ?>
	<tr>
		<td><?php echo h($pollLog['PollLog']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pollLog['Poll']['id'], array('controller' => 'polls', 'action' => 'view', $pollLog['Poll']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pollLog['PollAnswer']['title'], array('controller' => 'poll_answers', 'action' => 'view', $pollLog['PollAnswer']['id'])); ?>
		</td>
		<td><?php echo h($pollLog['PollLog']['ip_address']); ?>&nbsp;</td>
		<td><?php echo h($pollLog['PollLog']['user_agent']); ?>&nbsp;</td>
		<td><?php echo h($pollLog['PollLog']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pollLog['PollLog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pollLog['PollLog']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pollLog['PollLog']['id']), null, __('Are you sure you want to delete # %s?', $pollLog['PollLog']['id'])); ?>
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
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Poll Log'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Polls'), array('controller' => 'polls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll'), array('controller' => 'polls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Poll Answers'), array('controller' => 'poll_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll Answer'), array('controller' => 'poll_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
