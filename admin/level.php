<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('4', '你的权限不足');
$_level = new LevelAction($_tpl);
$_level->_action();
$_tpl->display('level.tpl');
	
?>