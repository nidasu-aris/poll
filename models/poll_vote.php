<?php
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
class PollVote extends AppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
    var $name = 'PollVote';
	
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
}
?>