<?php

class PollAppController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();
		$this->setupSession();
	}

	function setupSession() {
		if (!$this->Session->check('SessionInfo.start')){
			$this->Session->write('SessionInfo.start', date('Y-m-d H:i:s'));
			$this->Session->write('SessionInfo.ip', env('REMOTE_ADDR'));
			$this->Session->write('SessionInfo.user_agent', env('HTTP_USER_AGENT'));
		}
	}
}
