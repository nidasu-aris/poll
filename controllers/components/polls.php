<?php
/**
 * PollHook Component
 *
 * An example hook component for demonstrating hook system.
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Zijad Redžić <zijad.redzic@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.demoveo.org
 */
class PollsComponent extends Object {
/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
    function startup(&$controller) {
        //$controller->set('pollComponent', 'PollComponent startup');
    }
/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
    function beforeRender(&$controller) {

        // Admin menu: admin_menu element of Poll plugin will be shown in admin panel's navigation
        Configure::write('Admin.menus.poll', 1);
		
		$polls = ClassRegistry::init('Poll')->find('all', array(
					'conditions' => array(
						'Poll.status' => 1
					)
				));
			
			$brojUk = count($polls)-1;				
			
			if(count($polls) > 0){
				
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
			
				$poll['answers'] = ClassRegistry::init('PollAnswer')->find('list', array(
					'conditions' => array(
						'PollAnswer.poll_id' => $poll['Poll']['id'],
					),
					'fields' => array(
						'PollAnswer.id',
						'PollAnswer.title'
					)			
				));
			}else{
				$poll = NULL;
			}
		$controller->set('polls_for_layout', $poll);
    }

    /**
     * Called after Controller::render() and before the output is printed to the browser.
     *
     * @param object $controller Controller with components to shutdown
     * @return void
     */
        public function shutdown(&$controller) {
        }
}
?>