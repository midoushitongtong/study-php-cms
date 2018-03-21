<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('12', '你的权限不足');
$_link = new LinkAction($_tpl);
$_link->_action();
$_tpl->display('link.tpl');
	
?>