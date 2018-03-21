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
		管理首页&gt;&gt;内容管理&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li style="width: 100%;"><a href="comment.php?action=show" class="selected">评论列表</a></li>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<form method="post" action="?action=states">
	<table>
		<tr><th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
		<?php if (@$this->_vars['CommentList']) {?>
		<?php foreach ($this->_vars['CommentList'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td title="<?php echo $value->full?>"><?php echo $value->content?></td>
			<td><?php echo $value->user?></td>
			<td><a href="../details.php?id=<?php echo $value->cid?>" title="<?php echo $value->title?>" target="_blank">查看</a></td>
			<td><?php echo $value->state?></td>
			<td><input type="text" name="states[<?php echo $value->id?>]" value="<?php echo $value->num?>" class="sort"></td>
			<td><a href="comment.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><input type="submit" value="批审" name="send" class="submit" style="margin: 0; width: 43px;"></td>
			<td></td>
		</tr>
		<?php } else { ?>
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
	</form>
	<?php } ?>
		
</div>



</body>
</html>
