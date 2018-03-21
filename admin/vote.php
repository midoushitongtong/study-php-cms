<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('11', '你的权限不足');
$_vote = new VoteAction($_tpl);
$_vote->_action();
$_tpl->display('vote.tpl');
	
?>