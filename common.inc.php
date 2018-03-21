<?php 




//缓存开关
define('IS_CACHE', true);
//模板句柄
global $_tpl, $_cache;
if (IS_CACHE && !$_cache->noCache()) {
	ob_start();
	$_tpl->cache(Tool::tplName().'.tpl');
}
$_nav = new NavAction($_tpl);
$_nav->showfront();
$_tag = new TagAction($_tpl);
$_tag->getFiveTag();
$_tpl->assign('webname', WEBNAME);

$_cookie = new Cookie('user');
if (IS_CACHE) {
	$_tpl->assign('header', '<script>getHeader();</script>');
} else {
	if ($_cookie->getCookie()) {
		$_tpl->assign('header', $_cookie->getCookie().', 您好 <a href="register.php?action=logout">退出</a>');
	} else {
		$_tpl->assign('header', '<a href="register.php?action=reg" class="user" style="color: #06f;">注册</a> <a href="register.php?action=login" class="login" style="color: #06f;">登陆</a>');
	}
}


//link
$_link = new FriendLinkAction($_tpl);
$_link->index();


?>