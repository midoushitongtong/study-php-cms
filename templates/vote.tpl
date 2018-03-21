<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_vote.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理调查投票&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
		<li><a href="vote.php?action=add">新增投票主题</a></li>
		{if $showchild}
		<li><a href="vote.php?action=showchild&id={$id}">投票项目列表</a></li>
		{/if}
		{if $addchild}
		<li><a href="vote.php?action=addchild&id={$id}">新增投票项目</a></li>
		{/if}
		{if $update}
		<li><a href="vote.php?action=update">修改投票主题</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>投票主题名称</th><th>投票项目</th><th>状态</th><th>参与人数</th><th>操作</th></tr>
		{if $AllVote}
		{foreach $AllVote(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->title}</td>
			<td><a href="vote.php?action=showchild&id={@value->id}">查看</a> | <a href="vote.php?action=addchild&id={@value->id}">增加项目</a></td>
			<td>{@value->state}</td>
			<td>{@value->pcount}</td>
			<td><a href="vote.php?action=update&id={@value->id}">修改</a> | <a href="vote.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="6">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">{$showpage}</div>
	{/if}
	
	{if $showchild}
	<table>
		<tr><th>编号</th><th>投票项目</th><th>操作</th></tr>
		{if $AllChildVote}
		{foreach $AllChildVote(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->title}</td>
			<td><a href="vote.php?action=update&id={@value->id}">修改</a> | <a href="vote.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="3">对不起没有任何数据</td></tr>
		{/if}
		<tr><td colspan="3">所属主题：{$titlec} <a href="?action=addchild&id={$id}">[增加项目]</a> <a href="{$prev_url}">[返回列表]</a></td></tr>
	</table>
	<div id="page">{$showpage}</div>
	{/if}
	
	{if $add}
	<form method="post" name="addupdateForm">
		<table class="left">
			<tr><td>投票主题名称：<input type="text" name="title" class="text"> ( 投票主题名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 投票主题描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加投票主题" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $addchild}
	<form method="post" name="addupdateForm">
		<input type="hidden" name="id" value="{$id}">
		<table class="left">
			<tr><td>项目所属主题：<input type="text" value="{$titlec}"></td></tr>
			<tr><td>投票项目名称：<input type="text" name="title" class="text"> ( 投票项目名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 投票项目描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加投票项目" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="addupdateForm">
	<input type="hidden" value="{$id}" name="id">
	<input type="hidden" value="{$prev_url}" name="prev_url">
		<table class="left">
			<tr><td>修改主题名称：<input type="text" name="title" class="text" value="{$titlec}"> ( 投票主题名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="info">{$info}</textarea><span style="vertical-align: 36px;"> ( 投票主题描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="修改" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
		
</div>



</body>
</html>
