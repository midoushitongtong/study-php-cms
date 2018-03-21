<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_premission.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理权限管理&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="premission.php?action=show" class="selected">管理权限列表</a></li>
		<li><a href="premission.php?action=add">新增管理权限</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="premission.php?action=update">修改管理权限</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>管理等级名称</th><th>标示</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllPremission']) {?>
		<?php foreach ($this->_vars['AllPremission'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->name?></td>
			<td><?php echo $value->id?></td>
			<td><a href="premission.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="premission.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="4">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<p class="center">[ <a href="level.php?action=add">新增管理等级</a> ]</p>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form method="post" name="add">
		<table class="left">
			<tr><td>管理权限名称：<input type="text" name="name" class="text"> ( 权限名称不得小于2位，不得大于23位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 权限描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="addupdateForm">
	<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
	<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url">
		<table class="left">
			<tr><td>管理等级名称：<input type="text" name="name" value="<?php echo $this->_vars['name'];?>" class="text"></td></tr>
			<tr><td><textarea name="info"><?php echo $this->_vars['info'];?></textarea></td></tr>
			<tr><td><input type="submit" value="修改管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
