<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_content.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="navtie"><?php echo $this->_vars['title'];?></strong>
	</div>
	
	<ol>
		<li><a href="content.php?action=show" class="selected">管理文档列表</a></li>
		<li><a href="content.php?action=add">新增文档列表</a></li>
		<?php if (@$this->_vars['update']) {?>
		<li><a href="content.php?action=update&id=<?php echo $this->_vars['id'];?>">修改文档列表</a></li>
		<?php } ?>
	</ol>
	
	<?php if (@$this->_vars['show']) {?>
	<table>
		<tr><th>编号</th><th>标题</th><th>属性</th><th>类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
		<?php if (@$this->_vars['SearchContent']) {?>
		<?php foreach ($this->_vars['SearchContent'] as $key=>$value) { ?>
		<tr>
			<td><script>document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
			<td><a href="../details.php?id=<?php echo $value->id?>" target="_blank" title="{title->t}"><?php echo $value->title?></a></td>
			<td><?php echo $value->attr?></td>
			<td><a href="content.php?action=show&nav=<?php echo $value->nav?>"><?php echo $value->nav_name?></a></td>
			<td><?php echo $value->count?></td>
			<td><?php echo $value->date?></td>
			<td><a href="content.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="content.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		<?php } ?>
	</table>
	<div id="page">
		<?php echo $this->_vars['showpage'];?>
		<form action="?" method="get" style="display: inline;">
		<input type="hidden" name="action" value="show">
		<select name="nav" class="select">
			<option value="0">默认全部</option>
			<?php echo $this->_vars['nav'];?>
		</select>
		<input type="submit" value="查询">
		</form>
	</div>
	<?php } ?>
	
	<?php if (@$this->_vars['add']) {?>
	<form name="content" method="post" action="content.php?action=add">
	<table class="content_table">
		<tr><th><span>发布新文档</span></th></tr>
		<tr><td>文档标题：<input type="text" class="text" name="title"><span class="red"> [必填] </span>( 2 ~ 20 位标题 )</td></tr>
		<tr><td>栏　　目：<select name="nav"><option value="">请选择一个栏目名称</option><?php echo $this->_vars['nav'];?></select> <span class="red"> [必选] </span> </td></tr>
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
		<tr><td>作　　者：<input type="text" class="text" name="author" value="<?php echo $this->_vars['author'];?>"> (作者不得大于13位) </td></tr>
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
	<?php } ?>
	
	<?php if (@$this->_vars['update']) {?>
	<form name="content" method="post" action="content.php?action=update">
	<input type="hidden" name="id" value="<?php echo $this->_vars['id'];?>">
	<input type="hidden" name="prev_url" value="<?php echo $this->_vars['prev_url'];?>">
	<table class="content_table">
		<tr><th><span>发布新文档</span></th></tr>
		<tr><td>文档标题：<input type="text" class="text" name="title" value="<?php echo $this->_vars['titlec'];?>"><span class="red"> [必填] </span>( 2 ~ 20 位标题 )</td></tr>
		<tr><td>栏　　目：<select name="nav"><option value="">请选择一个栏目名称</option><?php echo $this->_vars['nav'];?></select> <span class="red"> [必选] </span> </td></tr>
		<tr><td>定义属性：<?php echo $this->_vars['attr'];?>
		</td></tr>
		<tr><td>标　　签：<input type="text" class="text" name="tag" value="<?php echo $this->_vars['tag'];?>"> (每个标签用,号隔开 不得大于三十位) </td></tr>
		<tr><td>关 键 字 ：<input type="text" class="text" name="keyword" value="<?php echo $this->_vars['keyword'];?>"> (每个关键字用,号隔开 不得大于三十位) </td></tr>
		<tr><td>缩 略 图 ：<input type="text" class="text" name="thumbnail_img" value="<?php echo $this->_vars['thumbnail'];?>" readonly>
									 <input id="thumbnail" type="button" value="上传">
									 <img name="pic" style="display: block;" src="<?php echo $this->_vars['thumbnail'];?>">
		</td></tr>
		<tr><td>文章来源：<input type="text" class="text" name="source" value="<?php echo $this->_vars['source'];?>"> (文章来源不得大于20位) </td></tr>
		<tr><td>作　　者：<input type="text" class="text" name="author" value="<?php echo $this->_vars['author'];?>"> (作者不得大于13位) </td></tr>
		<tr><td><span style="vertical-align: 43px;">内容摘要：</span><textarea name="info"><?php echo $this->_vars['info'];?></textarea> <span style="vertical-align: 43px;">(内容摘要不得大于233位) </span></td></tr>
		<tr><td class="ckeditor"><span style="vertical-align: 43px;">文章内容：</span><textarea id="editor" name="content"><?php echo $this->_vars['content'];?></textarea>
</tr>
		<tr><td>
						评论选项：	<?php echo $this->_vars['commend'];?>
										<span style="margin-left: 69.666666px;">浏览次数：</span><input type="text" name="count" value="<?php echo $this->_vars['count'];?>" class="text small">
		</td></tr>
		<tr><td>
						文档排序：  <select name="sort" style="width: 150px;">
											<?php echo $this->_vars['sort'];?>
										</select>
										<i style="font-style: normal; margin-left: 66.66666px;">消费金币：</i><input type="text" name="gold" value="<?php echo $this->_vars['gold'];?>" class="text small">
		</td></tr>
		<tr><td>
						阅读权限：  <select name="readlimit" style="width: 150px;">
											<?php echo $this->_vars['readlimit'];?>
										</select>
											<i style="font-style: normal; margin-left: 66.66666px;">标题颜色：</i>	<select name="color" style="width: 150px; position: relative; left: -3px;">
											<?php echo $this->_vars['color'];?>
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
	<?php } ?>
	
	
	
	
</div>



</body>
<script>CKEDITOR.replace('editor');</script>
</html>
