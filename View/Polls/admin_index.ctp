<div class="polls index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New poll'), array('action'=>'add')); ?></li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $this->Html->tableHeaders(array(
                                            $this->Paginator->sort('id'),
                                            $this->Paginator->sort(__('Question'), 'question'),
											$this->Paginator->sort('status'),                                            
                                              __('Actions'),
                                             ));
        echo $tableHeaders;

        $rows = array();
        foreach ($polls AS $poll) {
        	$actions  = $this->Html->link(__('View answers'), array('controller' => 'poll_answers', 'action' => 'index', 'poll' => $poll['Poll']['id']));
            $actions .= $this->Html->link(__('Edit'), array('controller' => 'polls', 'action' => 'edit', $poll['Poll']['id']));
            $actions .= ' ' . $this->Html->link(__('Delete'), array('controller' => 'polls', 'action' => 'delete', $poll['Poll']['id']), null, __('Are you sure?'));

            $rows[] = array(
                        $poll['Poll']['id'],
                        $poll['Poll']['question'],
					    $this->Layout->status($poll['Poll']['status']),
                       $actions,
                      );
        }

        echo $this->Html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
</div>

<div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
<div class="counter"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
