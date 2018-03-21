




<div id="link">
	<h2>友情链接 <span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span></h2>
	<ul>
	<?php if (@$this->_vars['text']) {?>
	<?php foreach ($this->_vars['text'] as $key=>$value) { ?>
	<li><a href="<?php echo $value->weburl?>" target="_blank" class="friendlink" style="color: #06f;"><?php echo $value->webname?></a></li>	
	<?php } ?>	
	<?php } ?>
	</ul>
	<?php if (@$this->_vars['logo']) {?>
	<?php foreach ($this->_vars['logo'] as $key=>$value) { ?>
	<dl>
		<dd><a href="<?php echo $value->weburl?>" target="_blank"><img src="<?php echo $value->logourl?>"></a></dd>
	</dl>
	<?php } ?>	
	<?php } ?>
</div>
<div id="footer">
	<p>版权信息显示</p>
	<p>版权信息显示</p>
</div>