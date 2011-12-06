<div class="pollLogs form">
<?php echo $this->Form->create('PollLog');?>
	<fieldset>
		<legend><?php echo __('Admin Add Poll Log'); ?></legend>
	<?php
		echo $this->Form->input('poll_id');
		echo $this->Form->input('poll_answer_id');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('user_agent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Poll Logs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Polls'), array('controller' => 'polls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll'), array('controller' => 'polls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Poll Answers'), array('controller' => 'poll_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Poll Answer'), array('controller' => 'poll_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
