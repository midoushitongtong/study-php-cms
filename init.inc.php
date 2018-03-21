<?php




session_start();
header('Content-Type:text/html;charset=utf-8');							//设置utf-8编码
define('ROOT_PATH', dirname(__FILE__));											//网站根目录
require 'config/profile.inc.php';														//引入配置文件
date_default_timezone_set('Asia/Shanghai');									//设置
//自动加载类
function __autoload($_className) {
	if (substr($_className, -6) == 'Action') {
		require ROOT_PATH.'/action/'.$_className.'.class.php';
	} else if (substr($_className, -5) == 'Model') {
		require ROOT_PATH.'/model/'.$_className.'.class.php';
	} else {
		if (!file_exists(ROOT_PATH.'/includes/'.$_className.'.class.php') && $_className == 'mysqli') {
			exit('服务器不支持mysqli扩展');
		}
		require ROOT_PATH.'/includes/'.$_className.'.class.php';
	}
}
//设置不缓存
$_cache = new Cache(array('code', 'cheup', 'upload', 'static', 'register', 'feedback', 'cast', 'friendlink', 'search'));
//实例化模板类
$_tpl = new Templates($_cache);
//初始化
require 'common.inc.php';			



?>