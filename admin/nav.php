<?php 




require substr(dirname(__FILE__), 0, -5).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('6', '你的权限不足');
$_nav = new NavAction($_tpl);
$_nav->_action();
$_tpl->display('nav.tpl');

?>