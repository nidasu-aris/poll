<?php
/**
 * Poll Activation
 *
 * Activation class for Poll plugin.
 * This is optional, and is required only if you want to perform tasks when your plugin is activated/deactivated.
 *
 * @package  Croogo
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class PollActivation {
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }
/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
       	$controller->Croogo->addAco('Polls');
        $controller->Croogo->addAco('Polls/admin_index');
        $controller->Croogo->addAco('Polls/admin_edit');
        $controller->Croogo->addAco('Polls/admin_add');
		$controller->Croogo->addAco('Polls/admin_delete');
		$controller->Croogo->addAco('PollAnswers');
        $controller->Croogo->addAco('PollAnswers/admin_index');
        $controller->Croogo->addAco('PollAnswers/admin_edit');
        $controller->Croogo->addAco('PollAnswers/admin_add');
		$controller->Croogo->addAco('PollVotes');
        $controller->Croogo->addAco('PollVotes/admin_index');
        $controller->Croogo->addAco('PollVotes/admin_edit');
        $controller->Croogo->addAco('PollVotes/admin_add');
		$controller->Croogo->addAco('PollVotes/add',array('Registered','Public'));
        $controller->Croogo->addAco('PollVotes/index',array('Registered','Public'));
        $controller->Croogo->addAco('PollVotes/results',array('Registered','Public'));

        $controller->Block->save(array(
            'title' => 'Polls',
            'alias' => 'polls',
            'region_id' => 0,
			'class' => 'poll-block',
			'element' => 'poll.poll',
            'status' => 0,
        ));
		
		$sql = file_get_contents(APP.'plugins'.DS.'poll'.DS.'config'.DS.'poll.sql');
        if(!empty($sql)){
        	App::import('Core', 'File');
        	App::import('Model', 'ConnectionManager');
        	$db = ConnectionManager::getDataSource('default');
        	$statements = explode(';', $sql);

	        foreach ($statements as $statement) {
	            if (trim($statement) != '') {
	                $db->query($statement);
	            }
	        }
        }
    }
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Poll');
		$controller->Croogo->removeAco('PollAnswer');
		$controller->Croogo->removeAco('PollVote');
		$block = $controller->Block->find('first', array(
            'conditions' => array(
                'Block.alias' => 'polls'
            ),
        ));
        if (isset($block['Block']['id'])) {
            $controller->Block->delete($block['Block']['id']);
        }
		
		$sql = file_get_contents(APP.'plugins'.DS.'poll'.DS.'config'.DS.'poll_deactivate.sql');
        if(!empty($sql)){
        	App::import('Core', 'File');
        	App::import('Model', 'ConnectionManager');
        	$db = ConnectionManager::getDataSource('default');
        	$statements = explode(';', $sql);

	        foreach ($statements as $statement) {
	            if (trim($statement) != '') {
	                $db->query($statement);
	            }
	        }
        }
    }
}
?>