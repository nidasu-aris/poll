<?php
/**
 * PollVotes Controller
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
class PollVotesController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    var $name = 'PollVotes';
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    var $uses = array('Poll.Poll','Poll.PollAnswer','Poll.PollVote');
	
	var $components = array('Poll.Cookie');

/**
 * Menu ID
 *
 * holds the current menu ID (if any)
 *
 * @var string
 * @access public
 */
   

    function beforeFilter() {
        parent::beforeFilter();

        if (isset($this->params['named']['menu']) && $this->params['named']['poll'] != null) {
            $poll = $this->params['named']['poll'];
            $this->pollId = $poll;
            
        } else {
            $poll = '';
            $this->pollId = $poll;
        }
		
		if (isset($this->params['slug'])) {
            $this->params['named']['slug'] = $this->params['slug'];
			
        }
		
		// CSRF Protection
        if (in_array($this->params['action'], array('add'))) {
            $this->Security->validatePost = false;
        }
		
        $this->set(compact('poll'));
    }

    function add(){
    	
		if (!empty($this->data)) {
	        	// CSRF Protection
	            if ($this->params['_Token']['key'] != $this->data['PollVotes']['token_key']) {
	                $blackHoleCallback = $this->Security->blackHoleCallback;
	                $this->$blackHoleCallback();
	            }
				
		    	$data = $this->data;
				
				$sslug = $this->Poll->find('first', array(
						'fields' => 'slug', 
						'conditions' => array(
							'Poll.id' => $data['PollVote']['poll_id']
					)));
				
		    	if(($this->Session->read('Poll.IP'.$data['PollVote']['poll_id']) == $data['PollVote']['poll_id'].'-'.$_SERVER['REMOTE_ADDR']) ||  ($this->Cookie->read('Poll.IP'.$data['PollVote']['poll_id']) == $data['PollVote']['poll_id'].'-'.$_SERVER['REMOTE_ADDR'])){ 	    	
					
					 $this->Session->setFlash(__('For this poll you have no rights to vote. Please choose another poll.', true));
					 $this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
		
				}else{
					$this->Session->write('Poll.IP'.$data['PollVote']['poll_id'], $data['PollVote']['poll_id'].'-'.$_SERVER['REMOTE_ADDR']);
					$this->Cookie->write('Poll.IP'.$data['PollVote']['poll_id'],$data['PollVote']['poll_id'].'-'.$_SERVER['REMOTE_ADDR'],false, 3600000);
					
					$votes = $this->PollVote->find('first', array(
						'conditions' => array(
							'PollVote.poll_id' => $data['PollVote']['poll_id'],
							'PollVote.poll_answer_id' => $data['PollVote']['poll_answer_id'],
						),
						'fields' => array('id','vote')
					));
					
					$reply = $this->PollAnswer->find('first', array(
						'conditions' => array(
							'PollAnswer.id' => $data['PollVote']['poll_answer_id'],
						)
					));
					
					if($votes['PollVote']['vote'] > 0){
						$data['PollVote']['id'] = $votes['PollVote']['id'];
					}else{
						$data['PollVote']['id'] = null;
					}
					
							
					$data['PollVote']['vote'] = $votes['PollVote']['vote'] + 1;
					
					$this->data = $data;			
			
	        
	            if ($this->PollVote->save($this->data)) {
	                $this->Session->setFlash(__('Your vote is saved.', true));
	                $this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
	            } else {
	                $this->Session->setFlash(__('Vote could not be saved. Please try again.', true));
					$this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
	            }
	        }
		}

    	
        
    }
	
	function results(){
			$polls = $this->Poll->find('all', array(
					'conditions' => array(
						'Poll.status' => 1
					)
				));
			
			$brojUk = count($polls)-1;				
			
			if(isset($this->params['named']['slug'])){
				for($i=0; $i<=$brojUk; $i++){
	  				if($polls[$i]['Poll']['slug'] == $this->params['named']['slug']){
	  					$idPoll = $i;
						break;
	  				}
	  			}
			}else{
				$idPoll = mt_rand(0,$brojUk);								
			}
			
			$poll = $polls[$idPoll];		
						
			$other = $polls;
			
			$total = 0;
		
			foreach($poll['PollAnswer'] as $key => $val){
				$poll['PollAnswer'][$key]['vote'] = 0;		
				foreach($poll['PollVote'] as $k => $v){				
					if($v['poll_answer_id'] == $val['id']){
						$poll['PollAnswer'][$key]['vote'] = $v['vote'];
					}
				}
			}
			
			foreach($poll['PollVote'] as $k => $v){
				$total = $total + $v['vote'];
			}
			
			if($total <= 0){
				$total = 1;
			}
			
			foreach($poll['PollAnswer'] as $key => $val){			
				(float)$poll['PollAnswer'][$key]['percent'] = (float)($val['vote']/$total)*100;				
			}
			
			$this->set('title_for_layout', __('Poll result - ', true).$poll['Poll']['question']);
			
			$this->set(compact('poll', 'other', 'total'));	
	}
	
	
	function index(){
			$polls = $this->Poll->find('all', array(
					'conditions' => array(
						'Poll.status' => 1
					)
				));
			
			$brojUk = count($polls)-1;	
			
			if(isset($this->params['named']['slug'])){
				for($i=0; $i<=$brojUk; $i++){
	  				if($polls[$i]['Poll']['slug'] == $this->params['named']['slug']){
	  					$idPoll = $i;
						break;
	  				}
	  			}
			}else{
				$idPoll = mt_rand(0,$brojUk);								
			}
			
			$poll = $polls[$idPoll];		
			
			$reply = $this->PollAnswer->find('list', array(
				'conditions' => array(
					'PollAnswer.poll_id' => $poll['Poll']['id'],
				),
				'fields' => array(
					'PollAnswer.id',
					'PollAnswer.title'
				)			
			));
			
			$other = $polls;
			
			$this->set('title_for_layout', __('Poll - ', true).$poll['Poll']['question']);
			
			$this->set(compact('poll', 'reply', 'other'));
		
	}

}
?>