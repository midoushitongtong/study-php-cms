<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_link.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理友情链接&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="link.php?action=show" class="selected">管理友情列表</a></li>
		<li><a href="link.php?action=add">新增友情链接</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="link.php?action=update">修改友情链接</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>网站名称</th><th>网站地址</th><th>网站logo</th><th>站长名称</th><th>类型</th><th>状态</th><th>操作</th></tr>
		<?php if (@$this->_vars['AllLink']) {?>
		<?php foreach ($this->_vars['AllLink'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><?php echo $value->webname?></td>
			<td title="<?php echo $value->fullweburl?>"><?php echo $value->weburl?></td>
			<td title="<?php echo $value->fulllogoul?>"><?php echo $value->logourl?></td>
			<td><?php echo $value->user?></td>
			<td><?php echo $value->type?></td>
			<td><?php echo $value->state?></td>
			<td><a href="link.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="link.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="8">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form method="post" name="friendlink">
		<input type="hidden" name="state" value="1">
		<table class="left">
			<tr><td>
							　网 站 类 型：<input type="radio" class="type_radio" name="type" id="type1" value="1" checked><label for="type1">文字链接</label>
											<input type="radio" class="type_radio" name="type" id="type2" value="2"><label for="type2">图片链接</label>
			</td></tr>
			<tr><td>　网 站 名 称：<input type="text" class="text" name="webname"> <span class="orange"> [必填]</span>　(网站名称不得为空,不得大于23位)</td></tr>
			<tr><td>　网 站 地 址：<input type="text" class="text" name="weburl"> <span class="orange"> [必填]</span>　(网站地址不得为空,不得大于236位)</td></tr>
			<tr id="logo" style="display: none;"><td>　LOGO地址：<input type="text" class="text" name="weblogo"> <span class="orange"> [必填]</span>　(LOGO地址不得为空)</td></tr>
			<tr><td>　站 长 名 称：<input type="text" class="text" name="user"> <span class="orange"></span></td></tr>
			<tr><td><input type="submit" class="submit" name="send" onclick="return checkForm()" value="新增友情链接" style="margin-left: 79px;"> <a href="<?php echo $this->_vars['prev_url'];?>"> [返回列表]</a></td></tr>
		</table>
	</form>
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form method="post" name="friendlink">
		<input type="hidden" name="id" value="<?php echo $this->_vars['id'];?>">
		<input type="hidden" name="state" value="<?php echo $this->_vars['state'];?>">
		<input type="hidden" name="prev_url" value="<?php echo $this->_vars['prev_url'];?>">
		<input type="hidden" name="state" value="<?php echo $this->_vars['state'];?>">
		<table class="left">
			<tr><td>
							　网 站 类 型：<input type="radio" class="type_radio" name="type" id="type1" value="1" <?php echo $this->_vars['text_type'];?>><label for="type1">文字链接</label>
											<input type="radio" class="type_radio" name="type" id="type2" value="2" <?php echo $this->_vars['logo_type'];?>><label for="type2">图片链接</label>
			</td></tr>
			<tr><td>　网 站 名 称：<input type="text" class="text" name="webname" value="<?php echo $this->_vars['webname'];?>"> <span class="orange"> [必填]</span>　(网站名称不得为空,不得大于23位)</td></tr>
			<tr><td>　网 站 地 址：<input type="text" class="text" name="weburl" value="<?php echo $this->_vars['weburl'];?>"> <span class="orange"> [必填]</span>　(网站地址不得为空,不得大于236位)</td></tr>
			<tr id="logo" <?php echo $this->_vars['logo'];?>><td>　LOGO地址：<input type="text" class="text" name="weblogo" value="<?php echo $this->_vars['logourl'];?>"> <span class="orange"> [必填]</span>　(LOGO地址不得为空)</td></tr>
			<tr><td>　站 长 名 称：<input type="text" class="text" name="user" value="<?php echo $this->_vars['user'];?>"> <span class="orange"></span></td></tr>
			<tr><td><input type="submit" class="submit" name="send" onclick="return checkForm()" value="新增友情链接" style="margin-left: 79px;"> <a href="<?php echo $this->_vars['prev_url'];?>"> [返回列表]</a></td></tr>
		</table>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
