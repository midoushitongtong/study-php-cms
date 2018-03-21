<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>{$webname}</title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_manage.js"></script>
</head>
<body id="main">



<div class="main">

	<div class="map">
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="navtie">{$title}</strong>
	</div>
	
	<ol>
		<li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
		<li><a href="manage.php?action=add">新增管理员</a></li>
		{if $update}
		<li><a href="manage.php?action=update">修改管理员</a></li>
		{/if}
	</ol>
	
	{if $show}
	<table>
		<tr><th>编号</th><th>用户名</th><th>等级</th><th>登陆次数</th><th>最近登陆ip</th><th>最近登陆时间</th><th>操作</th></tr>
		{if $AllManage}
		{foreach $AllManage(key,value)}
		<tr>
			<td><script>document.write({@key+1}+{$num});</script></td>
			<td>{@value->admin_user}</td>
			<td>{@value->level_name}</td>
			<td>{@value->login_count}</td>
			<td>{@value->last_ip}</td>
			<td>{@value->last_time}</td>
			<td><a href="manage.php?action=update&id={@value->id}">修改</a> | <a href="manage.php?action=delete&id={@value->id}" onclick="return confirm('你确定删除吗') ? true : false">删除</a></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="7">对不起没有任何数据</td></tr>
		{/if}
	</table>
	<div id="page">{$showpage}</div>
	<p class="center">[ <a href="manage.php?action=add">新增管理员</a> ]</p>
	{/if}
	
	{if $add}
	<form method="post" name="add">
		<table class="left">
			<tr><td>用 户 名 ：<input type="text" name="admin_user" class="text"> ( 不得小于2位,不得大于20位 )</td></tr>
			<tr><td>密　　码：<input type="password" name="admin_pass" class="text"> ( 不得小于6位 )</td></tr>
			<tr><td>确认密码：<input type="password" name="admin_notpass" class="text"> ( 密码必须一致 )</td></tr>
			<tr>
					<td>等　　级：<select name="level">
												{foreach $AllLevel(key,value)}
												<option value="{@value->id}">{@value->level_name}</option>
												{/foreach}
									 </select>
					</td>
			</tr>
			<tr><td><input type="submit" value="添加管理员" name="send" onclick="return checkAddForm();" class="submit"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
	
	{if $update}
	<form method="post" name="update">
	<input type="hidden" value="{$id}" name="id">
	<input type="hidden" value="{$level}" name="level" id="level">
	<input type="hidden" value="{$admin_pass}" name="pass">
	<input type="hidden" value="{$prev_url}" name="prev_url">
		<table class="left">
			<tr><td>用户名：<input type="text" name="admin_user" value="{$admin_user}" class="text" readonly="readonly"></td></tr>
			<tr><td>密　码：<input type="text" name="admin_pass" class="text"></td></tr>
			<tr>
					<td>等　级：<select name="level">
												{foreach $AllLevel(key,value)}
												<option value="{@value->id}">{@value->level_name}</option>
												{/foreach}
									 </select>
					</td>
			</tr>
			<tr><td><input type="submit" value="修改管理员" name="send" onclick="return checkUpdateForm();" class="submit"> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
		</table>
	</form>
	{/if}
		
</div>



</body>
</html>
