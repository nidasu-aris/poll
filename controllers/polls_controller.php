<?php
/**
 * Polls Controller
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
class PollsController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    var $name = 'Polls';	
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    var $uses = array('Poll.Poll','Poll.PollAnswer','Poll.PollVote');

    function beforeFilter() {
        parent::beforeFilter();
    }

    function admin_index() {
        $this->set('title_for_layout', __('Polls', true));

        $this->Poll->recursive = 0;
		$polls = $this->paginate();
        $this->set('polls', $polls);
    }

    function admin_add() {
    	$this->set('title_for_layout', __('Add poll', true));
        if (!empty($this->data)) {
            $this->Poll->create();
			if(empty($this->data['Poll']['slug'])){
				$this->data['Poll']['slug'] = $this->__make_slug($this->data['Poll']['question']);
			}			
            if ($this->Poll->save($this->data)) {
                $this->Session->setFlash(__('Poll is saved.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Poll could not be saved. Please try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
    	$this->set('title_for_layout', __('Edit poll', true));
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid poll.', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
        	if(empty($this->data['Poll']['slug'])){
				$this->data['Poll']['slug'] = $this->__make_slug($this->data['Poll']['question']);
			}
            if ($this->Poll->save($this->data)) {
                $this->Session->setFlash(__('Poll is saved.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Poll could not be saved. Please try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Poll->read(null, $id);
        }
        
    }

    
    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid poll ID.', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Poll->delete($id)) {
            $this->Session->setFlash(__('Poll is deleted.', true));
            $this->redirect(array('action' => 'index'));
        }
    }
	
	function __make_slug($str){
		
		// croatian letters	
		$diacritics = array ('ć' => 'c','č' => 'c','ž' =>'z','đ' => 'd', 'š' => 's', '.' => '-');

		$find = '_';
		$change = '-';
		
		$str = str_replace(array_keys($diacritics),array_values( $diacritics),$str);
		
		$transformator = array(
			$find => $change,
			"\s+" => $change,
			"[^a-z0-9".$change."]" => '',
			$change."+" => $change,
			$change."$" => '',
			"^".$change => ''
		);
		
		$str = strip_tags(strtolower($str));
		
		foreach ($transformator as $key => $val) {		
			$str = preg_replace("#".$key."#", $val, $str);				
		}
		
		return trim(stripslashes($str));
	}   
}
?>