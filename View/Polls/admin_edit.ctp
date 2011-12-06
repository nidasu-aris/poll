<div class="polls form">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php echo $this->Form->create('Poll');?>
        <fieldset>
        <?php
			echo $this->Form->input('id');
            echo $this->Form->input('question', array(
				'label' => 'Question'
			));
            echo $this->Form->input('slug');
			echo $this->Form->input('description', array(
				'label' => 'Description'
			));
			echo $this->Form->input('status');
        ?>
        </fieldset>
    <?php echo $this->Form->end(__('Submit', TRUE));?>
</div>