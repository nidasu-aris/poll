<?php
	echo $html->css('/poll/css/poll', NULL, array('inline' => FALSE));
?>
<div class="polls">

		<h2><?php echo $title_for_layout; ?></h2>


		<?php 
			if(!@isset($poll['Poll']['id'])){
				__('No items found.');
			}else{
					
		?>
		<h3><?php echo $poll['Poll']['question']; ?></h3>
		<p><?php echo $poll['Poll']['description']; ?></p>
		<ul id="poll">
			<li>
				<?php echo sprintf(__('Total votes %s, published %s', TRUE), $ukupno,  $time->format(Configure::read('Comment.date_time_format'), $poll['Poll']['created'], null, Configure::read('Site.timezone'))); ?>
			</li>
		<?php
			foreach($poll['PollAnswer'] as $key => $val){
				echo '<li class="label">'.$val['title'].'</li>'."\n";
				echo '<li class="item" style="background-color: #'.$val['color'].'; width: '.round($val['percent']).'%;">'.round($val['percent'],2).'% - '.$val['vote'].'</li>'."\n";
			}
		?>
		</ul>	
		
	<br />		
	<?php
		if(count($ostali) > 1){
			echo '<h3>';
			__('Other polls');
			echo '</h3>';
		}
	?>
	
	<div class="related">
		<ul>
		<?php foreach($other as $p){
				if($p['Poll']['id'] != $poll['Poll']['id']){
					echo '<li>';
					echo $html->link($p['Poll']['question'], Router::url(array(
						'plugin' => 'poll',
						'controller' => 'poll_votes', 
						'action' => 'index',
						$p['Poll']['slug']
					)));
					echo '</li>';
				}
		}
		?>
		
		</ul>
	</div>

	<?
			}
	?>
</div>
