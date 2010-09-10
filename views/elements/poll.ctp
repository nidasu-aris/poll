<?php
	if(isset($polls_for_layout['Poll']['id'])){
    $b = $block['Block'];
    $class = 'block block-' . $b['alias'];
    if ($block['Block']['class'] != null) {
        $class .= ' ' . $b['class'];
    }
?>
<div id="block-<?php echo $b['id']; ?>" class="<?php echo $class; ?>">
	
		<?php if ($b['show_title'] == 1) { ?>
			<h3><?php echo $b['title']; ?></h3>					
		<?php } ?>       					
			<div class="block-body <?php echo $class; ?>">
				<?php $poll = $polls_for_layout; ?>
		
		   	<h4><?php echo $poll['Poll']['question']; ?></h4>
			<p><?php echo $poll['Poll']['description']; ?></p>
			
		    <?php
		        echo $form->create('PollVotes', array(
		            'url' => array(
						'plugin' => 'poll',
		                'controller' => 'poll_votes',
		                'action' => 'add'
		            )
		        ));
				
		       echo $form->hidden('PollVote.poll_id', array('value' => $poll['Poll']['id']));
			   
			   echo '<fieldset>';
		       echo $form->input('PollVote.poll_answer_id', array(
			   		'div' => 'radiopoll', 
					'separator' => '<br />',  
					'after' => '<br /><br />', 
					'legend' => false, 
					'label' => true, 
					'type' => 'radio', 
					'options' => $poll['answers']
					)); 
			   echo '</fieldset>';
			   echo $form->input('token_key', array(
		            'type' => 'hidden',
		            'value' => $this->params['_Token']['key'],
		        ));
		       echo $form->end(array('label' => __('Vote', true)));
		    ?>			
		</div>    				
</div>
<?
}
?>