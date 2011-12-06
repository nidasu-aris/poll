<?php

App::uses('PollAppModel', 'Poll.Model');
/**
 * PollVote
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
class PollVote extends PollAppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
    var $name = 'PollVote';

	var $useDbConfig = 'polling';
	
	var $validate = array(
        'vote' => array(
            'rule' => 'notEmpty',
			'required' => true,
            'message' => 'Vote can not be empty',
			
        ),
		'poll_answer_id' => array(
            'rule' => 'notEmpty',
			'required' => true,
            'message' => 'Answer can not be empty',
			
        )
    );
    	
/**
 * Model associations: belongsTo
 *
 * @var array
 * @access public
 */
    var $belongsTo = array(
            'Poll' => array('className' => 'Poll.Poll',
                                'foreignKey' => 'poll_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
            ),
			'PollAnswer' => array('className' => 'Poll.PollAnswer',
                                'foreignKey' => 'poll_answer_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
            )
    );

	var $hasMany = array(
		'PollLog' => array(
			'className' => 'Poll.PollLog',
			'foreignKey' => 'poll_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			)
		);

	function saveLog($pollId, $pollAnswerId, $ip, $ua) {
		$Log = ClassRegistry::init('Poll.PollLog');
		$data = array(
			'poll_id' => $pollId,
			'poll_answer_id' => $pollAnswerId,
			'ip_address' => $ip,
			'user_agent' => $ua,
		);
		$Log->save($data);	
	}
}
?>
