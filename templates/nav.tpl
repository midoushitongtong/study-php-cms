<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_nav.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		内容管理&gt;&gt;设置网站导航&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="nav.php?action=show" class="selected">管理导航列表</a></li>
		<li><a href="nav.php?action=add">新增导航列表</a></li>
		{if $update}
		<li><a href="nav.php?action=update">修改导航列表</a></li>
		{/if}
		{if $addchild}
		<li><a href="nav.php?action=addchild&id={$id}">新增子导航</a></li>
		{/if}
		{if $showchild}
		<li><a href="nav.php?action=showchild&id={$id}">查看子导航</a></li>
		{/if}
	</ol>
	
	{if $show}
	<form method="post" action="nav.php?action=sort">
	<table>
		<tr><th>编号</th><th>网站导航名称</th><th>描述</th><th>子类</th><th>操作</th><th>排序</th></tr>
		{if $AllNav}
		{foreach $AllNav(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->nav_name}</td>
			<td>{@value->nav_info}</td>
			<td><a href="nav.php?action=showchild&id={@value->id}">查看</a> | <a href="nav.php?action=addchild&id={@value->id}">增加导航子类</a></td>
			<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
			<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="6">对不起没有任何数据</td></tr>
		{/if}
		<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor: pointer; width: 49px;"></td></tr>
	</table>
	<div id="page">{$showpage}</div>
	<p class="center">[ <a href="nav.php?action=add">新增导航列表</a> ]</p>
	</form>
	{/if}
	
	{if $showchild}
	<form method="post" action="nav.php?action=sort">
	<table>
		<tr><th>编号</th><th>网站导航名称</th><th>描述</th><th>操作</th><th>排序</th></tr>
		{if $AllNavChild}
		{foreach $AllNavChild(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->nav_name}</td>
			<td>{@value->nav_info}</td>
			<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
			<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="5">对不起没有任何数据</td></tr>
		{/if}
		<tr><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor: pointer; width: 49px;"></td></tr>
		<tr><td colspan="5">本类隶属 ：{$prev_name} [ <a href="nav.php?action=addchild&id={$id}">继续增加子类 </a> ] [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
	</table>
	<div id="page">{$showpage}</div>
	</form>
	{/if}
	
	{if $add}
	<form method="post" name="addupdateForm">
	<input type="hidden" value="0" name="pid">
		<table class="left">
			<tr><td>网站导航名称：<input type="text" name="nav_name" class="text"> ( 网站导航名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="nav_info"></textarea><span style="vertical-align: 36px;"> ( 网站导航描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加网站导航" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $addchild}
	<form method="post" name="addupdateForm">
		<input type="hidden" value="{$id}" name="pid">
		<table class="left">
			<tr><td><strong>上级导航名称：{$prev_name}</strong></td></tr>
			<tr><td>&nbsp;&nbsp;&nbsp;子导航名称：<input type="text" name="nav_name" class="text"> ( 子导航名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="nav_info"></textarea><span style="vertical-align: 36px;"> ( 子导航描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加子导航" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="addupdateForm">
		<input type="hidden" value="{$id}" name="id">
		<input type="hidden" value="{$prev_url}" name="prev_url">
		<table class="left">
			<tr><td>网站导航名称：<input type="text" name="nav_name" value="{$nav_name}" class="text"> ( 网站导航名称不得小于2位,不得大于20位 )</td></tr>
			<tr><td><textarea name="nav_info">{$nav_info}</textarea><span style="vertical-align: 36px;"> ( 网站导航描述不得大于200位 )</span></td></tr>
			<tr><td><input type="submit" value="添加网站导航" name="send" onclick="return checkForm();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	


</body>
</html>
