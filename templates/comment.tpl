<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_manage.js"></script>
</head>
<body id="main">



<div class="main">

	<div class="map">
		管理首页&gt;&gt;内容管理&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li style="width: 100%;"><a href="comment.php?action=show" class="selected">评论列表</a></li>
	</ol>
	
	{if $show}
	<form method="post" action="?action=states">
	<table>
		<tr><th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
		{if $CommentList}
		{foreach $CommentList(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td title="{@value->full}">{@value->content}</td>
			<td>{@value->user}</td>
			<td><a href="../details.php?id={@value->cid}" title="{@value->title}" target="_blank">查看</a></td>
			<td>{@value->state}</td>
			<td><input type="text" name="states[{@value->id}]" value="{@value->num}" class="sort"></td>
			<td><a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><input type="submit" value="批审" name="send" class="submit" style="margin: 0; width: 43px;"></td>
			<td></td>
		</tr>
		{else}
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">{$showpage}</div>
	</form>
	{/if}
		
</div>



</body>
</html>
