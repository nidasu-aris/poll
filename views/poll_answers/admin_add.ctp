<?php
	echo $html->css('/poll/css/jPicker-1.0.11.css', NULL, array('inline' => FALSE));
 	echo $html->script('/poll/js/jpicker-1.0.11.min', false);
	echo $html->script('/poll/js/colorpicker', false);
?>
<div class="links form">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php echo $form->create('PollAnswer', array('url' => array('controller' => 'poll_answers', 'action' => 'add', 'poll' => $poll)));?>
        <fieldset>
                    <?php
						echo $form->input('poll_id', array(
                            'label' => __('Poll', true),
                            'options' => $polls,
							'selected' => $poll,
                            'empty' => false,
                        ));                     
                        echo $form->input('title', array(
                            'label' => __('Answer', true)
						));
						echo $form->input('color', array(
							'label' => __('Color of graph for answer', true),
							'id' => 'colorpicker'
						));
                    ?>
            
        </fieldset>
    <?php echo $form->end('Submit');?>
</div>