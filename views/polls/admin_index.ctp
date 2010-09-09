<div class="polls index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('New poll', true), array('action'=>'add')); ?></li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $html->tableHeaders(array(
                                            $paginator->sort('id'),
                                            $paginator->sort(__('Question', true), 'question'),
											$paginator->sort('status'),                                            
                                              __('Actions', true),
                                             ));
        echo $tableHeaders;

        $rows = array();
        foreach ($polls AS $poll) {
        	$actions  = $html->link(__('View answers', true), array('controller' => 'poll_answers', 'action' => 'index', 'poll' => $poll['Poll']['id']));
            $actions .= $html->link(__('Edit', true), array('controller' => 'polls', 'action' => 'edit', $poll['Poll']['id']));
            $actions .= ' ' . $html->link(__('Delete', true), array('controller' => 'polls', 'action' => 'delete', $poll['Poll']['id']), null, __('Are you sure?', true));

            $rows[] = array(
                        $poll['Poll']['id'],
                        $poll['Poll']['question'],
					    $layout->status($poll['Poll']['status']),
                       $actions,
                      );
        }

        echo $html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
</div>

<div class="paging"><?php echo $paginator->numbers(); ?></div>
<div class="counter"><?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?></div>
