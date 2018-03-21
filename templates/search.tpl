<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/list.css">
</head>
<body style="overflow-y: scroll;">













{include file='header.tpl'}









<div id="list" style="width: 100%;">
	<h2>当前位置 &gt; 搜索</h2>
	{if $SearchContent}
	{foreach $SearchContent(key,value)}
	<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}" alt=""></a></dt>
		<dd>[ <strong>{@value->nav_name}</strong> ] <a href="details.php?id={@value->id}">{@value->title}</a></dd>
		<dd>日期：{@value->date} 点击量：{@value->count} 关键字：{@value->keyword}</dd>
		<dd>{@value->info}</dd>
	</dl>
	{/foreach}
	{else}
	<p class="none">还没有任何数据</p>
	{/if}
	<div id="page">{$showpage}</div>
</div>












{include file='footer.tpl'}



</body>
</html>