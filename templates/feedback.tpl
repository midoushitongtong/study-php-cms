<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/feedback.css">
<script src="js/details.js"></script>
</head>
<body>

{include file='header.tpl'}

<div id="feedback">
	<h2>评论列表</h2>
	<h3>{$titlec}</h3>
	<p class="info">{$info} <a href="details.php?id={$id}">[详细]</a></p>
	{if $HotThreeComment}
	{foreach $HotThreeComment(key,value)}
	<dl>
		<dt><img src="images/{@value->face}"></dt>
		<dd style="position: relative;"><em>{@value->date}</em><span>[{@value->user}]</span> <img src="images/hot.gif" style="position: relative; top: 5.6px;"></dd>
		<dd class="info">[{@value->manner}] {@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}] 支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}] 反对</a></dd>
	</dl>
	{/foreach}
	{/if}
	<h4>
		最新评论
	</h4>
	{if $AllComment}
	{foreach $AllComment(key,value)}
	<dl>
		<dt><img src="images/{@value->face}"></dt>
		<dd><em>{@value->date}</em><span>[{@value->user}]</span></dd>
		<dd class="info">[{@value->manner}] {@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}] 支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}] 反对</a></dd>
	</dl>
	{/foreach}
	<div id="page" style="clear:both;">{$showpage}</div>
	{else}
	<dl>
		<dd style="padding-bottom: 23px; width: 100%; margin-top: 6px;">此文档没有任何评论</dd>
	</dl>
	{/if}
</div>
<div id="sidebar">
	<h2>热评文档</h2>
	<ul>
		{if $TwentyComment}
		{foreach $TwentyComment(key,value)}
		<li><em>66-66</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>



<div class="d5">
		<form method="post" action="feedback.php?cid={$cid}" name="comment">
			你对本文的态度：<input type="radio" name="manner" value="1" class="radio" id="s1" checked> <label for="s1">支持</label>
									<input type="radio" name="manner" value="0" class="radio" id="s2"> <label for="s2">中立</label>
									<input type="radio" name="manner" value="-1" class="radio" id="s3"> <label for="s3">反对</label>
			<p class="orange">请遵从互联网规则，不要发表关于政治，反动，色情之类的评论。</p>
			<p><textarea name="content"></textarea></p>
			<p>
				<input type="text" name="code" class="code">
				<img src="config/code.php" onclick="this.src = 'config/code.php?tm = ' + Math.random()" style="cursor: pointer;">
				<input type="submit" name="send" value="提交" class="submit">
			</p>
		</form>
	</div>

{include file='footer.tpl'}



</body>
</html>
