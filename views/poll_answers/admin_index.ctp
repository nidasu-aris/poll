<div class="polls index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('New answer', true), array('action'=>'add', 'poll' => $poll)); ?></li>
        </ul>
    </div>

    <?php
    	if (isset($this->params['named'])) {
            foreach ($this->params['named'] AS $nn => $nv) {
                $paginator->options['url'][] = $nn . ':' . $nv;
            }
        }
    ?>

    <?php echo $form->create('PollAnswer', array('url' => array('controller' => 'pollanswers', 'action' => 'process', 'poll' => $poll))); ?>
    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $html->tableHeaders(array(
            '',
            __('Id', true),
            __('Answer', true),
            __('Actions', true),
        ));
        echo $tableHeaders;
        $rows = array();
        foreach ($answersTree AS $linkId => $linkTitle) {
            $actions  = $html->link(__('Move up', true), array('controller' => 'poll_answers', 'action' => 'moveup', 'poll' => $poll, $linkId));
            $actions .= ' ' . $html->link(__('Move down', true), array('controller' => 'poll_answers', 'action' => 'movedown', 'poll' => $poll, $linkId));
            $actions .= ' ' . $html->link(__('Edit', true), array('controller' => 'poll_answers', 'action' => 'edit', 'poll' => $poll, $linkId));
            $actions .= ' ' . $html->link(__('Delete', true), array('controller' => 'poll_answers', 'action' => 'delete', 'poll' => $poll, $linkId), null, __('Are you sure?', true));

            $rows[] = array(
                $form->checkbox('PollAnswer.'.$linkId.'.id'),
                $linkId,
                $linkTitle,
                $actions,
            );
        }

        echo $html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
    <div class="bulk-actions">
    <?php
        echo $form->input('PollAnswer.action', array(
            'label' => false,
            'options' => array(
                'delete' => __('Delete', true),
            ),
            'empty' => true,
        ));
        echo $form->end('Submit');
    ?>
    </div>
</div>