<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_level.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理等级管理&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="level.php?action=show" class="selected">管理等级列表</a></li>
		<li><a href="level.php?action=add">新增管理等级</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="level.php?action=update&id=<?php echo $this->_vars['id'];?>">修改管理等级</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>管理等级名称</th><th>描述</th><th>权限设定</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllLevel']) {?>
		<?php foreach ($this->_vars['AllLevel'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->level_name?></td>
			<td><?php echo $value->level_info?></td>
			<td><?php echo $value->permission?></td>
			<td><a href="level.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="level.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
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
	<form method="post" name="addupdateForm">
		<table class="left">
			<tr><td>管理等级名称：<input type="text" name="level_name" class="text"> ( 等级名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="level_info"></textarea><span style="vertical-align: 36px;"> ( 等级描述不得大于200位 )</span></td></tr>
			<tr><td style="padding-left: 79px; padding-right: 55.6%;">
			<?php if (@$this->_vars['AllPermission']) {?>
			<?php foreach ($this->_vars['AllPermission'] as $key=>$value) { ?>
			<input type="checkbox" value="<?php echo $value->id?>" name="permission[]" id="p<?php echo $value->id?>" class="radio"> <label for="p<?php echo $value->id?>"><?php echo $value->name?></label>
			<?php } ?>
			<?php } ?>
			</td></tr>
			<tr><td><input type="submit" value="添加管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="addupdateForm">
	<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
	<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url">
		<table class="left">
			<tr><td>管理等级名称：<input type="text" name="level_name" value="<?php echo $this->_vars['level_name'];?>" class="text"></td></tr>
			<tr><td><textarea name="level_info"><?php echo $this->_vars['level_info'];?></textarea></td></tr>
			<tr><td style="padding-left: 79px; padding-right: 55.6%;">
			<?php if (@$this->_vars['AllPermission']) {?>
			<?php foreach ($this->_vars['AllPermission'] as $key=>$value) { ?>
			<input type="checkbox" value="<?php echo $value->id?>" name="permission[]" id="p<?php echo $value->id?>" class="radio"> <label for="p<?php echo $value->id?>"><?php echo $value->name?></label>
			<?php } ?>
			<?php } ?>
			</td></tr>
			<tr><td><input type="submit" value="修改管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
