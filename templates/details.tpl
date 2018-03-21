<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/details.css">
<script src="js/details.js"></script>
<script src="config/static.php?id={$id}&type=details"></script>
</head>
<body style="overflow-y: scroll;">


{include file='header.tpl'}









<div id="details">
	<h2>当前位置 &gt; {$nav}</h2>
	<h3>{$titlec}</h3>
	<div class="d1">时间：{$date} 来源：{$source} 点击量：{$count} 作者：{$author}</div>
	<div class="d2">{$info}</div>
	<div class="d3">{$content}</div>
	<div class="d4">tag标签：{$tag}</div>
	<div class="d6">
		<h2><a href="feedback.php?cid={$id}" target="_blank">已有<span>{$comment}</span>人参与评论</a>最新评论</h2>
		{if $NewThreeComment}
		{foreach $NewThreeComment(key,value)}
		<dl>
			<dt><img src="images/{@value->face}"></dt>
			<dd><em>{@value->date}</em><span>[{@value->user}]</span></dd>
			<dd class="info">[{@value->manner}] {@value->content}</dd>
			<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">[{@value->sustain}] 支持</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}] 反对</a></dd>
		</dl>
		{/foreach}
		{else}
		<dl>
			<dd style="float: left; padding: 0 0 13px 0;">暂无任何评论</dd>
		</dl>
		{/if}
	</div>
	<div class="d5">
		<form method="post" action="feedback.php?cid={$id}" target="_black" name="comment">
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
</div>
<div id="sidebar">
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
