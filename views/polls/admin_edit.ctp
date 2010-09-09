<div class="polls form">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php echo $form->create('Poll');?>
        <fieldset>
        <?php
			echo $form->input('id');
            echo $form->input('question', array(
				'label' => 'Question'
			));
            echo $form->input('slug');
			echo $form->input('description', array(
				'label' => 'Description'
			));
			echo $form->input('status');
        ?>
        </fieldset>
    <?php echo $form->end(__('Submit', TRUE));?>
</div>