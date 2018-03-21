<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_vote.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理调查投票&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
		<li><a href="vote.php?action=add">新增投票主题</a></li>
		<?php if (@$this->_vars['showchild']) {?>
		<li><a href="vote.php?action=showchild&id=<?php echo $this->_vars['id'];?>">投票项目列表</a></li>
		<?php } ?>
		<?php if (@$this->_vars['addchild']) {?>
		<li><a href="vote.php?action=addchild&id=<?php echo $this->_vars['id'];?>">新增投票项目</a></li>
		<?php } ?>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="vote.php?action=update">修改投票主题</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>投票主题名称</th><th>投票项目</th><th>状态</th><th>参与人数</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllVote']) {?>
		<?php foreach ($this->_vars['AllVote'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->title?></td>
			<td><a href="vote.php?action=showchild&id=<?php echo $value->id?>">查看</a> | <a href="vote.php?action=addchild&id=<?php echo $value->id?>">增加项目</a></td>
			<td><?php echo $value->state?></td>
			<td><?php echo $value->pcount?></td>
			<td><a href="vote.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="vote.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="6">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<?php } ?>
	
	<?php if (@$this->_vars['showchild']) {?>
	<table>
		<tr><th>编号</th><th>投票项目</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllChildVote']) {?>
		<?php foreach ($this->_vars['AllChildVote'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->title?></td>
			<td><a href="vote.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="vote.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="3">对不起没有任何数据</td></tr>
		<?php } ?>
		<tr><td colspan="3">所属主题：<?php echo $this->_vars['titlec'];?> <a href="?action=addchild&id=<?php echo $this->_vars['id'];?>">[增加项目]</a> <a href="<?php echo $this->_vars['prev_url'];?>">[返回列表]</a></td></tr>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form method="post" name="addupdateForm">
		<table class="left">
			<tr><td>投票主题名称：<input type="text" name="title" class="text"> ( 投票主题名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 投票主题描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加投票主题" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['addchild']) {?>
	<form method="post" name="addupdateForm">
		<input type="hidden" name="id" value="<?php echo $this->_vars['id'];?>">
		<table class="left">
			<tr><td>项目所属主题：<input type="text" value="<?php echo $this->_vars['titlec'];?>"></td></tr>
			<tr><td>投票项目名称：<input type="text" name="title" class="text"> ( 投票项目名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 投票项目描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加投票项目" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="addupdateForm">
	<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
	<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url">
		<table class="left">
			<tr><td>修改主题名称：<input type="text" name="title" class="text" value="<?php echo $this->_vars['titlec'];?>"> ( 投票主题名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info"><?php echo $this->_vars['info'];?></textarea><span style="vertical-align: 36px;"> ( 投票主题描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="修改" name="send" onclick="return checkForm();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
