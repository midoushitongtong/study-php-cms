<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/reg.css">
<script src="js/reg.js"></script>
</head>
<body style="overflow-y: scroll">



<?php $_tpl->create('header.tpl')?>








<?php if (@$this->_vars['reg']) {?>
<div id="reg">
	<h2>会员注册</h2>
	<form method="post" action="?action=reg" name="reg">
		<dl>
			<dd>用 户 名 ：<input type="text" class="text" name="user"> <span class="orange"> [必填]</span>　(用户名2~23位之间)</dd>
			<dd>密　　码：<input type="password" class="text" name="pass"> <span class="orange"> [必填]</span>　(密码不得小于6位)</dd>
			<dd>密码确认：<input type="password" class="text" name="notpass"> <span class="orange"> [必填]</span>　(和密码必须一致)</dd>
			<dd>电子邮件：<input type="text" class="text" name="email"> <span class="orange"> [必填]</span>　(每个邮件只能注册一次)</dd>
			<dd>选择头像：<select name="face">
										<?php foreach ($this->_vars['OptionFaceOne'] as $key=>$value) { ?>
										<option value="0<?php echo $value?>.gif">0<?php echo $value?>.gif</option>
										<?php } ?>
										<?php foreach ($this->_vars['OptionFaceTwo'] as $key=>$value) { ?>
										<option value="<?php echo $value?>.gif"><?php echo $value?>.gif</option>
										<?php } ?>
									</select>
			</dd>
			<dd><img src="images/06.gif" name="faceimg"></dd>
			<dd>安全问题：<select name="question">
										<option value="">没有任何安全问题</option>
										<option value="你父亲的姓名？">您父亲的姓名？</option>
										<option value="你母亲的姓名？">您母亲的姓名？</option>
										<option value="你配偶的姓名？">您配偶的姓名？</option>
									</select>
			</dd>
			<dd>问题回答：<input type="text" class="text" name="anwser"></dd>
			<dd>验 证 码 ：<input type="text" class="text" name="code"> <span class="orange"> [必填]</span> </dd>
			<dd><img src="config/code.php" onclick="this.src='config/code.php?tm=' + Math.random()"></dd>
			<dd><input type="submit" name="send" onclick="return checkReg()" value="注册会员"></dd>
		</dl>
	</form>
</div>
<?php } ?>


<?php if (@$this->_vars['login']) {?>
<div id="reg">
	<h2>会员登陆</h2>
	<form method="post" action="?action=login" name="login">
		<dl>
			<dd>用 户 名 ：<input type="text" class="text" name="user"> <span class="orange"> [必填]</span>　(用户名2~23位之间)</dd>
			<dd>密　　码：<input type="password" class="text" name="pass"> <span class="orange"> [必填]</span>　(密码不得小于6位)</dd>
			<dd>登陆保留：<input type="radio" name="time" checked="checked" value="0" id="time0"> <label for="time0">不保留</label>
									<input type="radio" name="time" value="86400" id="time1"> <label for="time1">一天</label>
									<input type="radio" name="time" value="604800" id="time2"> <label for="time2">一周</label>
									<input type="radio" name="time" value="2592000" id="time3"> <label for="time3">一月</label>
			</dd>
			<dd>验 证 码 ：<input type="text" class="text" name="code"> <span class="orange"> [必填]</span> </dd>
			<dd><img src="config/code.php" onclick="this.src='config/code.php?tm=' + Math.random()"></dd>
			<dd><input type="submit" name="send" onclick="return checkLogin()" value="登陆"></dd>
		</dl>
	</form>
</div>
<?php } ?>






<?php $_tpl->create('footer.tpl')?>



</body>
</html>
