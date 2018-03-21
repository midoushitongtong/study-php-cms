<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_rotation.js"></script>
</head>
<body id="main">



<div class="main">

	<div class="map">
		管理首页&gt;&gt;内容管理&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="rotation.php?action=show" class="selected">管理轮播器</a></li>
		<li><a href="rotation.php?action=add">新增轮播器</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="rotation.php?action=update">修改轮播器</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>标题</th><th>连接</th><th>是否显示轮播</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllRotation']) {?>
		<?php foreach ($this->_vars['AllRotation'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><a href="<?php echo $value->full?>" target="_blank"><?php echo $value->title?></a></td>
			<td><?php echo $value->link?></td>
			<td><?php echo $value->state?></td>
			<td><a href="rotation.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="rotation.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<tr><td colspan="5"><input type="button" value="更新首页轮播" onclick="javascript:location.href = '?action=xml'"></td></tr>
		<?php } else { ?>
		<tr><td colspan="5">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form method="post" name="content" action="rotation.php?action=add">
		<table class="left">
			<tr><td>　轮播图地址：<input type="text" name="thumbnail_img" class="text" readonly="readonly">
												 <input id="thumbnail" type="button" value="上传">
												 <img name="pic" style="display: none;margin-left: 83px;">
			</td></tr>
			<tr><td>　轮播图连接：<input type="text" name="link" class="text"> ( 轮播图连接 )</td></tr>
			<tr><td>　轮播图标题：<input type="text" name="title" class="text"> ( 轮播图标题不得小于2位,不得大于23位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 轮播图描述不得大于666位 )</span></td></tr>
			<tr><td><input type="submit" value="添加轮播图" name="send" onclick="return checkRotation();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="content" action="rotation.php?action=update">
		<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id">
		<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url">
		<table class="left">
			<tr><td>　轮播图地址：<input type="text" name="thumbnail_img" class="text" value="<?php echo $this->_vars['thumbnail'];?>" readonly="readonly">
												 <input id="thumbnail" type="button" value="上传">
												 <img src="<?php echo $this->_vars['thumbnail'];?>" name="pic" style="display: block;margin-left: 83px;">
			</td></tr>
			<tr><td>　轮播图连接：<input type="text" name="link" class="text" value="<?php echo $this->_vars['link'];?>"> ( 轮播图连接 )</td></tr>
			<tr><td>　轮播图标题：<input type="text" name="title" class="text" value="<?php echo $this->_vars['titlec'];?>"> ( 轮播图标题不得小于2位,不得大于23位 )</td></tr>
			<tr><td><textarea name="info"><?php echo $this->_vars['info'];?></textarea><span style="vertical-align: 36px;"> ( 轮播图描述不得大于666位 )</span></td></tr>
			<tr><td>　是 否 轮 播：<input type="radio" name="state" value="1" class="radio" id="state1" <?php echo $this->_vars['left_state'];?>> <label for="state1">是 </label>
												<input type="radio" name="state" value="0" class="radio" id="state0" <?php echo $this->_vars['right_state'];?>> <label for="state0">否</label> 
			</td></tr>
			<tr><td><input type="submit" value="修改轮播图" name="send" onclick="return checkRotation();" class="submit level"> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
