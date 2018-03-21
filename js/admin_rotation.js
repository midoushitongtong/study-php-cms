




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
	
	
	var thumbnail = document.getElementById('thumbnail')
	if (thumbnail) {
		thumbnail.onclick = function () {
			WindowCenter('../config/upfile.php?type=rotation', 'upfile', '433', '166');
		};
	}
	
	function WindowCenter(url, name, width, height) {
		var left = (screen.width - width) / 2;
		var top = (screen.height - height - 233) / 2;
		window.open(url, name, 'width = ' + width + ', height = ' + height + ', left = ' + left + ', top = ' + top);
	}

}

function checkRotation() {
	var fm = document.content;
	if (fm.thumbnail_img.value == '') {
		alert('轮播图不得为空');
		fm.thumbnail_img.focus();
		return false;
	}
	if (fm.link == '') {
		alert('连接不得为空');
		fm.link.focus();
		return false;
	}
	if (fm.title.value.length > 23) {
		alert('标题不得大于23位');
		fm.title.focus();
		return false;
	}
	if (fm.info.value.length > 666) {
		alert('简介不得大于666位');
		fm.info.value = '';
		fm.info.focus();
		return false;
	}
	
}