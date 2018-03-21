<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
$_premission = new PremissionAction($_tpl);
$_premission->_action();
$_tpl->display('premission.tpl');
	
?>