<?php
App::uses('PollAppModel', 'Poll.Model');
/**
 * PollLog Model
 *
 * @property Poll $Poll
 * @property PollAnswer $PollAnswer
 */
class PollLog extends PollAppModel {
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'polling';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Poll' => array(
			'className' => 'Poll.Poll',
			'foreignKey' => 'poll_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PollAnswer' => array(
			'className' => 'Poll.PollAnswer',
			'foreignKey' => 'poll_answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
