<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_permission.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理权限管理&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="permission.php?action=show" class="selected">管理权限列表</a></li>
		<li><a href="permission.php?action=add">新增管理权限</a></li>
		{if $update}
		<li><a href="permission.php?action=update">修改管理权限</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>管理等级名称</th><th>标示</th><th>操作</th></tr>
		{if $AllPermission}
		{foreach $AllPermission(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->name}</td>
			<td>{@value->id}</td>
			<td><a href="permission.php?action=update&id={@value->id}">修改</a> | <a href="permission.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="4">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">{$showpage}</div>
	<p class="center">[ <a href="level.php?action=add">新增管理等级</a> ]</p>
	{/if}
	
	{if $add}
	<form method="post" name="add">
		<table class="left">
			<tr><td>管理权限名称：<input type="text" name="name" class="text"> ( 权限名称不得小于2位，不得大于23位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 权限描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="addupdateForm">
	<input type="hidden" value="{$id}" name="id">
	<input type="hidden" value="{$prev_url}" name="prev_url">
		<table class="left">
			<tr><td>管理等级名称：<input type="text" name="name" value="{$name}" class="text"></td></tr>
			<tr><td><textarea name="info">{$info}</textarea></td></tr>
			<tr><td><input type="submit" value="修改管理等级" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
		
</div>



</body>
</html>
