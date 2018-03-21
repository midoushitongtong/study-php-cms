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








<div id="list">
	<h2>当前位置 &gt; {$nav}</h2>
	{if $AllListContent}
	{foreach $AllListContent(key,value)}
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
<div id="sidebar">
	<div class="nav">
		<h2>栏目列表</h2>
		{if $childnav}
		{foreach $childnav(key,value)}
		<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
		{/foreach}
		{else}
		<span>栏目还未添加子类</span>
		{/if}
	</div>
	<div class="right">
		<h2>本月本类推荐</h2>
		<ul>
			{if $MonthNavRec}
			{foreach $MonthNavRec(ket,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/foreach}
			{else}
				<li>暂无</li>
			{/if}
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
			{if $MonthNavHot}
			{foreach $MonthNavHot(ket,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/foreach}
			{else}
				<li>暂无</li>
			{/if}
		</ul>
	</div>
	<div class="right">
		<h2>本月图文推荐</h2>
		<ul>
			{if $MonthNavPic}
			{foreach $MonthNavPic(ket,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/foreach}
			{else}
				<li>暂无</li>
			{/if}
		</ul>
	</div>
</div>











{include file='footer.tpl'}






</body>
</html>
