<?php

App::uses('PollAppModel', 'Poll.Model');
/**
 * PollAnswer
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
class PollAnswer extends PollAppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
    var $name = 'PollAnswer';

	var $useDbConfig = 'polling';
	
	var $actsAs = array(
        'Tree'
    );
	
    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Title could not be empty.',
        )
    );

/**
 * Model associations: hasMany
 *
 * @var array
 * @access public
 */
    var $hasMany = array(
            'PollVote' => array('className' => 'Poll.PollVote',
                                'foreignKey' => 'poll_answer_id',
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => 'poll_answer_id',
                                'limit' => '',
                                'offset' => '',
                                'exclusive' => '',
                                'finderQuery' => '',
                                'counterQuery' => ''
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
            )
    );
}
?>
