<?php
/**
 * PollModel
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
class Poll extends AppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
    var $name = 'Poll';
	
	
    var $validate = array(
        'slug' => array(
            'rule' => 'isUnique',
            'message' => 'Slug must be unique',
        ),
    );

/**
 * Model associations: hasMany
 *
 * @var array
 * @access public
 */
    var $hasMany = array(            
            'PollAnswer' => array('className' => 'Poll.PollAnswer',
                                'foreignKey' => 'poll_id',
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => 'PollAnswer.title ASC',
                                'limit' => '',
                                'offset' => '',
                                'exclusive' => '',
                                'finderQuery' => '',
                                'counterQuery' => ''
            ),
            'PollVote' => array('className' => 'Poll.PollVote',
                                'foreignKey' => 'poll_id',
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
								'order' => 'PollVote.poll_answer_id ASC',
                                'limit' => '',
                                'offset' => '',
                                'exclusive' => '',
                                'finderQuery' => '',
                                'counterQuery' => ''
            )
    );
}
?>