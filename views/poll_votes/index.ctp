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
		<div id="poll">
		 <?php
        echo $form->create('PollVotes', array(
            'url' => array(
                'controller' => 'poll_votes',
                'action' => 'add'
            ),
			'class' => 'yform'
        ));
		
       echo $form->hidden('PollVote.poll_id', array('value' => $anketa['Poll']['id']));
	  
	   echo $form->input('PollVote.poll_answer_id', array(
	   		'div' => 'radiopoll', 
			'separator' => '<br />',  
			'after' => '<br /><br />', 
			'legend' => false, 
			'label' => true, 
			'type' => 'radio', 
			'options' => $reply
	    ));
		echo $form->input('token_key', array(
		            'type' => 'hidden',
		            'value' => $this->params['_Token']['key'],
		        ));
	
       echo $form->end( __('Vote', true));
	   ?>
		</div>
		<br />
	<?php
		if(count($other) > 1){
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
					echo $html->link($p['Poll']['pitanje'],Router::url(array(
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