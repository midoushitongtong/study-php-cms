<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_content.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="content.php?action=show" class="selected">管理文档列表</a></li>
		<li><a href="content.php?action=add">新增文档列表</a></li>
		{if $update}
		<li><a href="content.php?action=update&id={$id}">修改文档列表</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>标题</th><th>属性</th><th>类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
		{if $SearchContent}
		{foreach $SearchContent(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td><a href="../details.php?id={@value->id}" target="_blank" title="{title->t}">{@value->title}</a></td>
			<td>{@value->attr}</td>
			<td><a href="content.php?action=show&nav={@value->nav}">{@value->nav_name}</a></td>
			<td>{@value->count}</td>
			<td>{@value->date}</td>
			<td><a href="content.php?action=update&id={@value->id}">修改</a> | <a href="content.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">
		{$showpage}
		<form action="?" method="get" style="display: inline;">
		<input type="hidden" name="action" value="show">
		<select name="nav" class="select">
			<option value="0">默认全部</option>
			{$nav}
		</select>
		<input type="submit" value="查询">
		</form>
	</div>
	{/if}
	
	{if $add}
	<form name="content" method="post" action="content.php?action=add">
	<table class="content_table">
		<tr><th><span>发布新文档</span></th></tr>
		<tr><td>文档标题：<input type="text" class="text" name="title"><span class="red"> [必填] </span>( 2 ~ 20 位标题 )</td></tr>
		<tr><td>栏　　目：<select name="nav"><option value="">请选择一个栏目名称</option>{$nav}</select> <span class="red"> [必选] </span> </td></tr>
		<tr><td>定义属性：
									 <input type="checkbox" name="attr[]" value="头条" id="label_top"><label for="label_top">头条</label>
									 <input type="checkbox" name="attr[]" value="推荐" id="label_tj"><label for="label_tj">推荐</label>
									 <input type="checkbox" name="attr[]" value="加粗" id="label_strong"><label for="label_strong">加粗</label>
									 <input type="checkbox" name="attr[]" value="跳转" id="label_location"><label for="label_location">跳转</label>
		</td></tr>
		<tr><td>标　　签：<input type="text" class="text" name="tag"> (每个标签用,号隔开 不得大于三十位) </td></tr>
		<tr><td>关 键 字 ：<input type="text" class="text" name="keyword"> (每个关键字用,号隔开 不得大于三十位) </td></tr>
		<tr><td>缩 略 图 ：<input type="text" class="text" name="thumbnail_img" readonly>
									 <input id="thumbnail" type="button" value="上传">
									 <img name="pic" style="display: none;">
		</td></tr>
		<tr><td>文章来源：<input type="text" class="text" name="source"> (文章来源不得大于20位) </td></tr>
		<tr><td>作　　者：<input type="text" class="text" name="author" value="{$author}"> (作者不得大于13位) </td></tr>
		<tr><td><span style="vertical-align: 43px;">内容摘要：</span><textarea name="info"></textarea> <span style="vertical-align: 43px;">(内容摘要不得大于233位) </span></td></tr>
		<tr><td class="ckeditor"><span style="vertical-align: 43px;">文章内容：</span><textarea id="editor" name="content"></textarea>
</tr>
		<tr><td>
						评论选项：  <input type="radio" name="commend" value="1" id="comment_1" checked> <label for="comment_1">允许评论</label>
									  <input type="radio" name="commend" value="0" id="comment_0"> <label for="comment_0">禁止评论</label>
						　　　　　  浏览次数：<input type="text" name="count" value="6" class="text small">
		</td></tr>
		<tr><td>
						文档排序：  <select name="sort" style="width: 150px;">
														<option value="0">默认排序</option>
														<option value="1">置顶一天</option>
														<option value="2">置顶一周</option>
														<option value="3">置顶一月</option>
														<option value="4">置顶一年</option>
										</select>
						　　　　　  消费金币：<input type="text" name="gold" value="0" class="text small">
		</td></tr>
		<tr><td>
						阅读权限：  <select name="readlimit" style="width: 150px;">
														<option selected="selected" value="0">开放浏览</option>
														<option value="1">初级会员</option>
														<option value="2">中级会员</option>
														<option value="3">高级会员</option>
														<option value="4">VIP会员</option>
										</select>
						<i style="font-style: normal; margin-left: 63.66666px;">标题颜色：</i>	<select name="color" style="width: 150px; position: relative; left: -3px;">
														<option value="">默认颜色</option>
														<option value="yellow">黄色</option>
														<option value="orange">橙色</option>
														<option value="blue">蓝色</option>
										</select>
		</td></tr>
		<tr><td><input type="submit" class="submit" name="send" value="发布文档" onclick="return checkAddContent();"></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
	</table>
	</form>
	{/if}
	
	{if $update}
	<form name="content" method="post" action="content.php?action=update">
	<input type="hidden" name="id" value="{$id}">
	<input type="hidden" name="prev_url" value="{$prev_url}">
	<table class="content_table">
		<tr><th><span>发布新文档</span></th></tr>
		<tr><td>文档标题：<input type="text" class="text" name="title" value="{$titlec}"><span class="red"> [必填] </span>( 2 ~ 20 位标题 )</td></tr>
		<tr><td>栏　　目：<select name="nav"><option value="">请选择一个栏目名称</option>{$nav}</select> <span class="red"> [必选] </span> </td></tr>
		<tr><td>定义属性：{$attr}
		</td></tr>
		<tr><td>标　　签：<input type="text" class="text" name="tag" value="{$tag}"> (每个标签用,号隔开 不得大于三十位) </td></tr>
		<tr><td>关 键 字 ：<input type="text" class="text" name="keyword" value="{$keyword}"> (每个关键字用,号隔开 不得大于三十位) </td></tr>
		<tr><td>缩 略 图 ：<input type="text" class="text" name="thumbnail_img" value="{$thumbnail}" readonly>
									 <input id="thumbnail" type="button" value="上传">
									 <img name="pic" style="display: block;" src="{$thumbnail}">
		</td></tr>
		<tr><td>文章来源：<input type="text" class="text" name="source" value="{$source}"> (文章来源不得大于20位) </td></tr>
		<tr><td>作　　者：<input type="text" class="text" name="author" value="{$author}"> (作者不得大于13位) </td></tr>
		<tr><td><span style="vertical-align: 43px;">内容摘要：</span><textarea name="info">{$info}</textarea> <span style="vertical-align: 43px;">(内容摘要不得大于233位) </span></td></tr>
		<tr><td class="ckeditor"><span style="vertical-align: 43px;">文章内容：</span><textarea id="editor" name="content">{$content}</textarea>
</tr>
		<tr><td>
						评论选项：	{$commend}
										<span style="margin-left: 69.666666px;">浏览次数：</span><input type="text" name="count" value="{$count}" class="text small">
		</td></tr>
		<tr><td>
						文档排序：  <select name="sort" style="width: 150px;">
											{$sort}
										</select>
										<i style="font-style: normal; margin-left: 66.66666px;">消费金币：</i><input type="text" name="gold" value="{$gold}" class="text small">
		</td></tr>
		<tr><td>
						阅读权限：  <select name="readlimit" style="width: 150px;">
											{$readlimit}
										</select>
											<i style="font-style: normal; margin-left: 66.66666px;">标题颜色：</i>	<select name="color" style="width: 150px; position: relative; left: -3px;">
											{$color}
										</select>
		</td></tr>
		<tr><td><input type="submit" class="submit" name="send" value="修改文党" onclick="return checkAddContent();" style="margin-left: 66px;"></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
	</table>
	</form>
	{/if}
	
	
	
	
</div>



</body>
<script>CKEDITOR.replace('editor');</script>
</html>
