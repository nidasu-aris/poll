<?php
CroogoRouter::connect('/poll/results', array('plugin' => 'poll', 'controller' => 'poll_votes', 'action' => 'results'));
CroogoRouter::connect('/poll/:slug', array('plugin' => 'poll', 'controller' => 'poll_votes', 'action' => 'index'));
CroogoRouter::connect('/poll/results/:slug', array('plugin' => 'poll', 'controller' => 'poll_votes', 'action' => 'results'));	
?>