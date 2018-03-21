




<div id="link">
	<h2>友情链接 <span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span></h2>
	<ul>
	{if $text}
	{foreach $text(key,value)}
	<li><a href="{@value->weburl}" target="_blank" class="friendlink" style="color: #06f;">{@value->webname}</a></li>	
	{/foreach}	
	{/if}
	</ul>
	{if $logo}
	{foreach $logo(key,value)}
	<dl>
		<dd><a href="{@value->weburl}" target="_blank"><img src="{@value->logourl}"></a></dd>
	</dl>
	{/foreach}	
	{/if}
</div>
<div id="footer">
	<p>版权信息显示</p>
	<p>版权信息显示</p>
</div>