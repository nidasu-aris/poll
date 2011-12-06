<div class="polls index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New answer'), array('action'=>'add', 'poll' => $poll)); ?></li>
        </ul>
    </div>

    <?php
    	if (isset($this->request->params['named'])) {
            foreach ($this->request->params['named'] AS $nn => $nv) {
                $this->Paginator->options['url'][] = $nn . ':' . $nv;
            }
        }
    ?>

    <?php echo $this->Form->create('PollAnswer', array('url' => array('controller' => 'pollanswers', 'action' => 'process', 'poll' => $poll))); ?>
    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $this->Html->tableHeaders(array(
            '',
            __('Id'),
            __('Answer'),
            __('Actions'),
        ));
        echo $tableHeaders;
        $rows = array();
        foreach ($answersTree AS $linkId => $linkTitle) {
            $actions  = $this->Html->link(__('Move up'), array('controller' => 'poll_answers', 'action' => 'moveup', 'poll' => $poll, $linkId));
            $actions .= ' ' . $this->Html->link(__('Move down'), array('controller' => 'poll_answers', 'action' => 'movedown', 'poll' => $poll, $linkId));
            $actions .= ' ' . $this->Html->link(__('Edit'), array('controller' => 'poll_answers', 'action' => 'edit', 'poll' => $poll, $linkId));
            $actions .= ' ' . $this->Html->link(__('Delete'), array('controller' => 'poll_answers', 'action' => 'delete', 'poll' => $poll, $linkId), null, __('Are you sure?'));

            $rows[] = array(
                $this->Form->checkbox('PollAnswer.'.$linkId.'.id'),
                $linkId,
                $linkTitle,
                $actions,
            );
        }

        echo $this->Html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
    <div class="bulk-actions">
    <?php
        echo $this->Form->input('PollAnswer.action', array(
            'label' => false,
            'options' => array(
                'delete' => __('Delete'),
            ),
            'empty' => true,
        ));
        echo $this->Form->end('Submit');
    ?>
    </div>
</div>
