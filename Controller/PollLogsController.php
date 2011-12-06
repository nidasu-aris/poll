<?php
App::uses('PollAppController', 'Poll.Controller');
/**
 * PollLogs Controller
 *
 * @property PollLog $PollLog
 */
class PollLogsController extends PollAppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PollLog->recursive = 0;
		$this->set('pollLogs', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->PollLog->id = $id;
		if (!$this->PollLog->exists()) {
			throw new NotFoundException(__('Invalid poll log'));
		}
		$this->set('pollLog', $this->PollLog->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PollLog->create();
			if ($this->PollLog->save($this->request->data)) {
				$this->Session->setFlash(__('The poll log has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The poll log could not be saved. Please, try again.'));
			}
		}
		$polls = $this->PollLog->Poll->find('list');
		$pollAnswers = $this->PollLog->PollAnswer->find('list');
		$this->set(compact('polls', 'pollAnswers'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->PollLog->id = $id;
		if (!$this->PollLog->exists()) {
			throw new NotFoundException(__('Invalid poll log'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PollLog->save($this->request->data)) {
				$this->Session->setFlash(__('The poll log has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The poll log could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PollLog->read(null, $id);
		}
		$polls = $this->PollLog->Poll->find('list');
		$pollAnswers = $this->PollLog->PollAnswer->find('list');
		$this->set(compact('polls', 'pollAnswers'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PollLog->id = $id;
		if (!$this->PollLog->exists()) {
			throw new NotFoundException(__('Invalid poll log'));
		}
		if ($this->PollLog->delete()) {
			$this->Session->setFlash(__('Poll log deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Poll log was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
