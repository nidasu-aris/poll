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
class PollVotesController extends PollAppController {
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
	
	var $components = array('Cookie');

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

        if (isset($this->request->params['named']['menu']) && $this->request->params['named']['poll'] != null) {
            $poll = $this->request->params['named']['poll'];
            $this->pollId = $poll;
            
        } else {
            $poll = '';
            $this->pollId = $poll;
        }
		
		if (isset($this->request->params['slug'])) {
            $this->request->params['named']['slug'] = $this->request->params['slug'];
			
        }
		
		// CSRF Protection
        if (in_array($this->request->params['action'], array('add'))) {
            $this->Security->validatePost = false;
        }
	//	$this->_setupSessionInfo();
		
        $this->set(compact('poll'));
    }

    function add(){
    	
		if (!empty($this->request->data)) {
	        	// CSRF Protection
//	            if ($this->params['_Token']['key'] != $this->request->data['PollVotes']['token_key']) {
//	                $blackHoleCallback = $this->Security->blackHoleCallback;
//	                $this->$blackHoleCallback();
//	            }

			$data = $this->request->data;

			$sslug = $this->Poll->find('first', array(
					'fields' => 'slug',
					'conditions' => array(
						'Poll.id' => $data['PollVote']['poll_id']
			)));

			$ip = $this->Session->read('SessionInfo.ip');
			$isPoll = $this->PollVote->PollLog->find('first', array(
				'conditions' => array(
					'PollLog.poll_id' => $data['PollVote']['poll_id'],
					'PollLog.ip_address' => $ip
					)
				)
			);

			if ($isPoll) {
				$this->Session->setFlash(__('For this poll you have no rights to vote. Please choose another poll.', true));
				$this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
			}

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

			$this->request->data = $data;

			$this->createLog($data['PollVote']['poll_id'], $data['PollVote']['poll_answer_id']);

			if ($this->PollVote->save($this->request->data)) {
				$this->Session->setFlash(__('Your vote is saved.', true));
				$this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
			} else {
				$this->Session->setFlash(__('Vote could not be saved. Please try again.', true));
				$this->redirect(array('action' => 'results', 'slug' => $sslug['Poll']['slug']));
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

	public function createLog($pollId, $pollAnswerId) {
		$si = $this->Session->read('SessionInfo');
		$ip = $si['ip'];
		$ua = $si['user_agent'];
		$this->PollVote->saveLog($pollId, $pollAnswerId, $ip, $ua);
	}

	function _setupSessionInfo() {
		if (!$this->Session->check('SessionInfo.start')) {
			$this->Session->write('SessionInfo.start', date('Y-m-d H:i:s'));
			$this->Session->write('SessionInfo.ip', env('REMOTE_ADDR'));
			$this->Session->write('SessionInfo.user_agent', env('HTTP_USER_AGENT'));
		}
	}

}
