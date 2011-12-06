<?php
	echo $this->Html->css('/poll/css/jPicker-1.0.11.css', NULL, array('inline' => FALSE));
 	echo $this->Html->script('/poll/js/jpicker-1.0.11.min', false);
	echo $this->Html->script('/poll/js/colorpicker', false);
?>
<div class="links form">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php echo $this->Form->create('PollAnswer', array('url' => array('controller' => 'poll_answers', 'action' => 'edit', 'poll' => $poll)));?>
        <fieldset>
                    <?php
						echo $this->Form->input('id');
                       	echo $this->Form->input('poll_id', array(
                            'label' => __('Poll'),
                            'options' => $polls,
                            'empty' => false,
                        ));                     
                        echo $this->Form->input('title', array(
                            'label' => __('Answer')
						));
						echo $this->Form->input('color', array(
							'label' => __('Color of graph for answer'),
							'id' => 'colorpicker'
						));
                    ?>
            
        </fieldset>
    <?php echo $this->Form->end('Submit');?>
</div>