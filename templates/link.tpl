<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_link.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理友情链接&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="link.php?action=show" class="selected">管理友情列表</a></li>
		<li><a href="link.php?action=add">新增友情链接</a></li>
		{if $update}
		<li><a href="link.php?action=update">修改友情链接</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>网站名称</th><th>网站地址</th><th>网站logo</th><th>站长名称</th><th>类型</th><th>状态</th><th>操作</th></tr>
		{if $AllLink}
		{foreach $AllLink(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->webname}</td>
			<td title="{@value->fullweburl}">{@value->weburl}</td>
			<td title="{@value->fulllogoul}">{@value->logourl}</td>
			<td>{@value->user}</td>
			<td>{@value->type}</td>
			<td>{@value->state}</td>
			<td><a href="link.php?action=update&id={@value->id}">修改</a> | <a href="link.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="8">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">{$showpage}</div>
	{/if}
	
	{if $add}
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
			<tr><td><input type="submit" class="submit" name="send" onclick="return checkForm()" value="新增友情链接" style="margin-left: 79px;"> <a href="{$prev_url}"> [返回列表]</a></td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="friendlink">
		<input type="hidden" name="id" value="{$id}">
		<input type="hidden" name="state" value="{$state}">
		<input type="hidden" name="prev_url" value="{$prev_url}">
		<input type="hidden" name="state" value="{$state}">
		<table class="left">
			<tr><td>
							　网 站 类 型：<input type="radio" class="type_radio" name="type" id="type1" value="1" {$text_type}><label for="type1">文字链接</label>
											<input type="radio" class="type_radio" name="type" id="type2" value="2" {$logo_type}><label for="type2">图片链接</label>
			</td></tr>
			<tr><td>　网 站 名 称：<input type="text" class="text" name="webname" value="{$webname}"> <span class="orange"> [必填]</span>　(网站名称不得为空,不得大于23位)</td></tr>
			<tr><td>　网 站 地 址：<input type="text" class="text" name="weburl" value="{$weburl}"> <span class="orange"> [必填]</span>　(网站地址不得为空,不得大于236位)</td></tr>
			<tr id="logo" {$logo}><td>　LOGO地址：<input type="text" class="text" name="weblogo" value="{$logourl}"> <span class="orange"> [必填]</span>　(LOGO地址不得为空)</td></tr>
			<tr><td>　站 长 名 称：<input type="text" class="text" name="user" value="{$user}"> <span class="orange"></span></td></tr>
			<tr><td><input type="submit" class="submit" name="send" onclick="return checkForm()" value="新增友情链接" style="margin-left: 79px;"> <a href="{$prev_url}"> [返回列表]</a></td></tr>
		</table>
	</form>
	{/if}
		
</div>



</body>
</html>
