<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_login.js"></script>
</head>
<body id="main">
	
	
	
<form id="adminLogin" name="login" method="post" action="admin_login.php?action=login">
	<fieldset>
		<legend>登陆后台管理</legend>
		<label>账　号：<input type="text" name="admin_user" class="text"></label>
		<label>密　码：<input type="password" name="admin_pass" class="text"></label>
		<label>验证码：<input type="text" name="code" class="text"></label>
		<label><img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm = ' + Math.random();" style="cursor: pointer;"></label>
		<input type="submit" value="登陆" class="submit" onclick="return checkLogin()" name="send">
	</fieldset>
</form>
	
	
	
</body>
</html>
