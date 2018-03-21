




window.onload = function () {

	var title = document.getElementById('navtie');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
	for (var i = 0; i < a.length; i ++) {
		a[i].className = '';
		if (title.innerHTML == a[i].innerHTML) {
			a[i].className = 'selected';
		}
	}
	
	document.getElementById('thumbnail').onclick = function () {
		WindowCenter('../config/upfile.php?type=content', 'upfile', '433', '166');
	};

	
	function WindowCenter(url, name, width, height) {
		var left = (screen.width - width) / 2;
		var top = (screen.height - height - 233) / 2;
		window.open(url, name, 'width = ' + width + ', height = ' + height + ', left = ' + left + ', top = ' + top);
	}

}

function checkAddContent() {
	var fm = document.content;

	if (fm.title.value.length == '' || fm.title.value.length < 2 || fm.title.value.length > 66) {
		alert('标题不得为空不得小于两位不得大于66位');
		fm.title.value = '';
		fm.title.focus();
		return false;
	}
	if (fm.nav.value.length == '') {
		alert('至少选择一个栏目');
		fm.nav.value = '';
		fm.nav.focus();
		return false;
	}
	if (fm.tag.value.length > 30) {
		alert('tag标签不得大于30位');
		fm.tag.focus();
		return false;
	}
	if (fm.keyword.value.length > 30) {
		alert('关键字不得大于30位');
		fm.keyword.focus();
		return false;
	}
	if (fm.source.value.length > 23) {
		alert('文章来源不得大于23位');
		fm.source.focus();
		return false;
	}
	if (fm.author.value.length > 13) {
		alert('作者不得大于13位');
		fm.author.focus();
		return false;
	}
	if (fm.info.value.length > 233) {
		alert('内容摘要不得大于233位');
		fm.info.focus();
		return false;
	}
	if (CKEDITOR.instances.editor.getData() == '') {
		alert('内容不得为空');
		CKEDITOR.instances.editor.focus();
		return false;
	}
	if (isNaN(fm.count.value)) {
		alert('浏览次数必须是数字');
		fm.count.focus();
		return false;
	}
	if (isNaN(fm.gold.value)) {
		alert('消费金币必须是数字');
		fm.gold.focus();
		return false;
	}
}