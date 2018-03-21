<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_adver.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理等级管理&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="adver.php?action=show" class="selected">广告列表</a></li>
		<li><a href="adver.php?action=add">新增广告</a></li>
		{if $update}
		<li><a href="adver.php?action=update">修改广告</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>广告标题</th><th>广告链接</th><th>广告类型</th><th>是否显示广告</th><th>操作</th></tr>
		{if $AllAdver}
		{foreach $AllAdver(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->title}</td>
			<td>{@value->link}</td>
			<td>{@value->type}</td>
			<td>{@value->state}</td>
			<td><a href="adver.php?action=update&id={@value->id}">修改</a> | <a href="adver.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		<tr><td colspan="6">
						<input type="button" value="生成文字广告" onclick="location.href='?action=text'">
						<input type="button" value="生成头部广告" onclick="location.href='?action=header'">
						<input type="button" value="生成侧栏广告" onclick="location.href='?action=sidebar'">
		</td></tr>
		{else}
		<tr><td colspan="6">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<form method="get">
	<input type="hidden" name="action" value="show">
	<div id="page">
		{$showpage}
		<select class="select" name="kind">
			<option value="0">默认全部</option>
			<option value="1">文字广告</option>
			<option value="2">头部广告</option>
			<option value="3">侧栏广告</option>
		</select>
		<input type="submit" name="send" value="查询">
	</div>
	</form>
	{/if}
	
	{if $add}
	<form method="post" name="content">
		<input type="hidden" name="adv">
		<table class="left">
			<tr><td>　广 告 类 型：<input type="radio" name="type" value="1" class="radio" onclick="adver(1)" id="type1" checked> <label for="type1">文字广告</label>
												<input type="radio" name="type" value="2" class="radio" onclick="adver(2)" id="type2"> <label for="type2">头部广告</label>
												<input type="radio" name="type" value="3" class="radio" onclick="adver(3)" id="type3"> <label for="type3">侧栏广告</label>
			</td></tr>
			<tr><td>　广 告 标 题：<input type="text" name="title" class="text"> ( 广告标题不得大于23位 )</td></tr>
			<tr><td>　广 告 连 接：<input type="text" name="link" class="text"> ( 广告连接不得为空 )</td></tr>
			<tr style="display: none" id="tr_pic"><td>　广 告 图 片：<input type="text" class="text" name="thumbnail_img" readonly>
											 	<span id="up"></span>
											 	<img name="pic" style="display: none; margin-left: 83.6666px;">
			</td></tr>
			<tr><td><textarea name="info"></textarea><span style="vertical-align: 36px;"> ( 广告描述不得大于233位 )</span></td></tr>
			<tr><td><input type="submit" value="新增广告" name="send" onclick="return checkAdver();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="content">
		<input type="hidden" name="id" value="{$id}">
		<input type="hidden" name="prev_url" value="{$prev_url}">
		<input type="hidden" name="adv">
		<table class="left">
			<tr><td>　广 告 类 型：<input type="radio" name="type" value="1" class="radio" onclick="adver(1)" id="type1" {$type1}> <label for="type1">文字广告</label>
												<input type="radio" name="type" value="2" class="radio" onclick="adver(2)" id="type2" {$type2}> <label for="type2">头部广告</label>
												<input type="radio" name="type" value="3" class="radio" onclick="adver(3)" id="type3" {$type3}> <label for="type3">侧栏广告</label>
			</td></tr>
			<tr><td>　广 告 标 题：<input type="text" name="title" class="text" value="{$titlec}"> ( 广告标题不得大于23位 )</td></tr>
			<tr><td>　广 告 连 接：<input type="text" name="link" class="text" value="{$link}"> ( 广告连接不得为空 )</td></tr>
			<tr id="tr_pic" style="{$pic}"><td>　广 告 图 片：<input type="text" class="text" value="{$thumbnail}" name="thumbnail_img" readonly>
											 	<span id="up">{$up}</span>
											 	<img name="pic" src="{$thumbnail}" style="display: block; margin-left: 83.6666px;">
			</td></tr>
			<tr><td><textarea name="info">{$info}</textarea><span style="vertical-align: 36px;"> ( 广告描述不得大于233位 )</span></td></tr>
			<tr><td>　是 否 生 成：<input type="radio" name="state" value="1" class="radio" {$left_state}>是
												<input type="radio" name="state" value="0" class="radio" {$right_state}>否
			</td></tr>
			<tr><td><input type="submit" value="修改广告" name="send" onclick="return checkAdver();" class="submit level"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
		
</div>



</body>
</html>
