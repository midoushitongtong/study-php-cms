<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
Validate::checkSession();
Validate::checkPermission('10', '你的权限不足');
global $_tpl;
$_adver = new AdverAction($_tpl);
$_adver->_action();
$_tpl->display('adver.tpl');




?>