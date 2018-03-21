<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_manage.js"></script>
</head>
<body id="main">



<div class="main">

	<div class="map">
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
		<li><a href="manage.php?action=add">新增管理员</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="manage.php?action=update">修改管理员</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>用户名</th><th>等级</th><th>登陆次数</th><th>最近登陆ip</th><th>最近登陆时间</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllManage']) {?>
		<?php foreach ($this->_vars['AllManage'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->admin_user?></td>
			<td><?php echo $value->level_name?></td>
			<td><?php echo $value->login_count?></td>
			<td><?php echo $value->last_ip?></td>
			<td><?php echo $value->last_time?></td>
			<td><a href="manage.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="manage.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<p class="center">[ <a href="manage.php?action=add">新增管理员</a> ]</p>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form method="post" name="add">
		<table class="left">
			<tr><td>用 户 名 ：<input type="text" name="admin_user" class="text"> ( 不得小于2位,不得大于20位 )</td></tr>
			<tr><td>密　　码：<input type="password" name="admin_pass" class="text"> ( 不得小于6位 )</td></tr>
			<tr><td>确认密码：<input type="password" name="admin_notpass" class="text"> ( 密码必须一致 )</td></tr>
			<tr>
					<td>等　　级：<select name="level">
												<?php foreach ($this->_vars['AllLevel'] as $key=>$value) { ?>
												<option value="<?php echo $value->id?>"><?php echo $value->level_name?></option>
												<?php } ?>
									 </select>
					</td>
			</tr>
			<tr><td><input type="submit" value="添加管理员" name="send" onclick="return checkAddForm();" class="submit"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="update">
	<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
	<input type="hidden" value="<?php echo $this->_vars['level'];?>" name="level" id="level">
	<input type="hidden" value="<?php echo $this->_vars['admin_pass'];?>" name="pass">
	<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url">
		<table class="left">
			<tr><td>用户名：<input type="text" name="admin_user" value="<?php echo $this->_vars['admin_user'];?>" class="text" readonly="readonly"></td></tr>
			<tr><td>密　码：<input type="text" name="admin_pass" class="text"></td></tr>
			<tr>
					<td>等　级：<select name="level">
												<?php foreach ($this->_vars['AllLevel'] as $key=>$value) { ?>
												<option value="<?php echo $value->id?>"><?php echo $value->level_name?></option>
												<?php } ?>
									 </select>
					</td>
			</tr>
			<tr><td><input type="submit" value="修改管理员" name="send" onclick="return checkUpdateForm();" class="submit"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
