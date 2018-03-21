<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/index.css">
<script src="js/reg.js"></script>
<script src="config/static.php?type=index"></script>
</head>
<body>

{include file='header.tpl'}









<div id="user">
	{if $cache}
		{$member}
	{else}
		{if $login}
		<h2 class="h2">会员登陆</h2>
		<form method="post" action="register.php?action=login" name="login">
			<label>昵　　称：<input type="text" name="user" class="text"></label>
			<label>密　　码：<input type="text" name="pass" class="text"></label>
			<label class="yzm">验 证 码 ：<input type="text" name="code" class="text code"> <img src="config/code.php" class="code_img" onclick="this.src = 'config/code.php?tm = ' + Math.random()" alt=""></label>
			<p><input type="submit" name="send" value="登陆" onclick="return checkLogin();" class="submit"><a href="register.php?action=reg">注册会员</a><a href="#">忘记密码</a></p>
		</form>
		{else}
		<h2 class="h2">会员信息</h2>
		<div class="a">您好，<strong>{$user}</strong> 欢迎光临</div>
		<div class="b">
			<img src="images/{$face}" alt="{$user}">
			<a href="#">个人中心</a>
			<a href="#">我的评论</a>
			<a href="register.php?action=logout">退出</a>
		</div>
		{/if}
	{/if}
	<h3>最近登陆会员<span>─────────────────</span></h3>
		{if $AllLaterUser}
		{foreach $AllLaterUser(key,value)}
		<dl>
			<dt><img src="images/{@value->face}"></dt>
			<dd>{@value->user}</dd>
		</dl>
		{/foreach}
		{/if}
</div>
<div id="news">
	<h3><a href="details.php?id={$TopId}">{$TopTitle}</a></h3>
	<p><a href="details.php?id={$TopId}"> {$TopInfo} </a><a href="details.php?id={$TopId}">[查看全文]</a></p>
	<p class="link">
		{if $NewTopList}
		{foreach $NewTopList(key,value)}
			<a href="details.php?id={@value->id}" target="_blank">{@value->title}</a>　{@value->line}
		{/foreach}
		{/if}
	</p>
	<ul>
		{if $NewList}
		{foreach $NewList(key,value)}
			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="pic">
	<object width="268" height="193">
		<embed src="images/lbxml.swf" width="268" height="193">
	</object>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
		{if $NewRecList}
		{foreach $NewRecList(key,value)}
			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><script src="js/sidebar_adver.js"></script></div>
	<div class="hot">
		<h2>本月热点</h2>
		<ul>
			{if $MonthHotList}
			{foreach $MonthHotList(key,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/foreach}
			{/if}
		</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
		<ul>
			{if $MonthComment}
			{foreach $MonthComment(key,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/foreach}
			{/if}
		</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3>{$vote_title}</h3>
		<form method="post" action="cast.php" target="_blank">
			{if $vote_item}
			{foreach $vote_item(key,value)}
			<label><input type="radio" name="vote" value="{@value->id}" style="position: relative; top: 2.33px;"> {@value->title}</label>
			{/foreach}
			{/if}
			<p><input type="submit" value="投票" name="send"><input type="button" value="查看" onclick="javascript:window.open('cast.php')"></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文咨询</h2>
	{if $PicList}
	{foreach $PicList(key,value)}
		<dl>
			<dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}" alt="{@value->thumbnail}"></a></dt>
			<dd>{@value->title}</dd>
		</dl>
	{/foreach}
	{/if}
</div>
<div id="newslist">
	{if $FourNav}
	{foreach $FourNav(key,value)}
	<div class="{@value->class}">
		<h2>{@value->nav_name} <a href="list.php?id={@value->id}" target="_blank">更多</a></h2>
		<ul>
			{iff @value->list}
			{for @value->list(key,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			{/for}
			{else}
				<li>没有文档数据</li>
			{/iff}
		</ul>		
	</div>
	{/foreach}
	{/if}
</div>






{include file='footer.tpl'}






</body>
</html>
