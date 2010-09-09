<?php
/**
 * PollAnswers Controller
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.0
 * @author   Zijad Redžić <zijad.redzic@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.webzy.in
 */
class PollAnswersController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    var $name = 'PollAnswers';
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    var $uses = array('Poll.Poll','Poll.PollAnswer','Poll.PollVote');

/**
 * Menu ID
 *
 * holds the current menu ID (if any)
 *
 * @var string
 * @access public
 */
    var $pollId = '';

    function beforeFilter() {
        parent::beforeFilter();

        if (isset($this->params['named']['poll']) && $this->params['named']['poll'] != null) {
            $poll = $this->params['named']['poll'];
            $this->pollId = $poll;
            
        } else {
            $poll = '';
            $this->pollId = $poll;
        }
        $this->set(compact('poll'));
    }

    function admin_index() {
		$this->set('title_for_layout', __('Answers', true));

        $conditions = array();
        if ($this->pollId != null) {
            $poll = $this->PollAnswer->Poll->findById($this->pollId);
            $this->pageTitle .= ': ' . $poll['Poll']['question'];
        }
        $answersTree = $this->PollAnswer->find('list', array(
			'fields' => array(
                'PollAnswer.id',
                'PollAnswer.title',
            ),
			'conditions' => array(
				'PollAnswer.poll_id' => $this->pollId
			)
		));
        $this->set(compact('answersTree'));
    }

    function admin_add() {
		$this->set('title_for_layout', __('Add answer', true));

        if (!empty($this->data)) {
            $this->PollAnswer->create();
            if ($this->PollAnswer->save($this->data)) {
                $this->Session->setFlash(__('Answer is saved.', true));
                $this->redirect(array('action'=>'index', 'poll' => $this->pollId));
            } else {
                $this->Session->setFlash(__('Answer could not be saved. Please try again.', true));
            }
        }
        $polls = $this->PollAnswer->Poll->find('list', array(
			'fields' => array(
                'Poll.id',
                'Poll.question',
            )
		));
        $this->set(compact('polls'));
    }

    function admin_edit($id = null) {
		$this->set('title_for_layout', __('Edit answer', true));

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid answer.', true));
            $this->redirect(array('action'=>'index', 'poll' => $this->pollId));
        }
        if (!empty($this->data)) {
           if ($this->PollAnswer->save($this->data)) {
                $this->Session->setFlash(__('Answer is saved.', true));
                $this->redirect(array('action'=>'index', 'poll' => $this->pollId));
            } else {
                $this->Session->setFlash(__('Answer could not be saved. Please try again..', true));
            }
        }
        if (empty($this->data)) {
            $data = $this->PollAnswer->read(null, $id);     
			$this->data = $data;       
        }
        $polls = $this->PollAnswer->Poll->find('list', array(
			'fields' => array(
                'Poll.id',
                'Poll.question',
            )
		));
        $this->set(compact('polls'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid answer ID.', true));
            $this->redirect(array('action'=>'index', 'poll' => $this->pollId));
        }
        if ($this->PollAnswer->delete($id)) {
            $this->Session->setFlash(__('Answer is deleted.', true));
            $this->redirect(array('action'=>'index', 'poll' => $this->pollId));
        }
    }

    function admin_moveup($id, $step = 1) {
        if( $this->PollAnswer->moveup($id, $step) ) {
            $this->Session->setFlash(__("Answer is moved up.", true));
        } else {
            $this->Session->setFlash(__("Answer could not be moved up.", true));
        }

        $this->redirect(array('admin' => true, 'action' => 'index', 'poll' => $this->pollId));
    }

    function admin_movedown($id, $step = 1) {
        if( $this->PollAnswer->movedown($id, $step) ) {
            $this->Session->setFlash(__("Answer is moved down.", true));
        } else {
            $this->Session->setFlash(__("Answer could not be moved down.", true));
        }

        $this->redirect(array('admin' => true, 'action' => 'index', 'poll' => $this->pollId));
    }

    function admin_process() {
        $action = $this->data['PollAnswer']['action'];
        $ids = array();
        foreach ($this->data['PollAnswer'] AS $id => $value) {
            if ($id != 'action' && $value['id'] == 1) {
                $ids[] = $id;
            }
        }

        if (count($ids) == 0 || $action == null) {
            $this->Session->setFlash(__('No items selected.', true));
            $this->redirect(array('action' => 'index', 'poll' => $this->pollId));
            exit();
        }

        if ($action == 'delete' &&
            $this->PollAnswer->deleteAll(array('PollAnswer.id' => $ids))) {
            $this->Session->setFlash(__('Answers deleted.', true));
        } elseif ($action == 'publish' &&
            $this->PollAnswer->updateAll(array('PollAnswer.status' => 1), array('PollAnswer.id' => $ids))) {
            $this->Session->setFlash(__('Answers published.', true));
        } elseif ($action == 'unpublish' &&
            $this->PollAnswer->updateAll(array('PollAnswer.status' => 0), array('PollAnswer.id' => $ids))) {
            $this->Session->setFlash(__('Answers not published.', true));
        } else {
            $this->Session->setFlash(__('An error occurred.', true));
        }

        $this->redirect(array('action' => 'index', 'poll' => $this->pollId));
        exit();
    }

}
?>