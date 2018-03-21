




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
	
	
	var thumbnail1 = document.getElementById('thumbnail1');
	if (thumbnail1) {
		thumbnail1.onclick = function () {
			WindowCenter('../config/upfile.php?type=adver&size=690x80', 'upfile', '433', '166');
		};
	}
	
	var thumbnail2 = document.getElementById('thumbnail2');
	if (thumbnail2) {
		thumbnail2.onclick = function () {
			WindowCenter('../config/upfile.php?type=adver&size=270x200', 'upfile', '433', '166');
		};
	}
	
	function WindowCenter(url, name, width, height) {
		var left = (screen.width - width) / 2;
		var top = (screen.height - height - 233) / 2;
		window.open(url, name, 'width = ' + width + ', height = ' + height + ', left = ' + left + ', top = ' + top);
	}
	
}

function adver(type) {
	var thumbnail = document.getElementById('tr_pic');
	var up = document.getElementById('up');
	
	var fm = document.content;
	if (fm.adv.value == type) return;
	fm.thumbnail_img.value = '';
	fm.pic.src = '';
	switch (type) {
		case 1 :
			thumbnail.style.display = 'none';
			up.innerHTML = '';
			fm.adv.value = 1;
			break;
		case 2 :
			thumbnail.style.display = 'block';
			up.innerHTML = "<input id=\"thumbnail1\" type=\"button\" value=\"上传头部广告\">";
			fm.adv.value = 2;
			break;
		case 3 :
			thumbnail.style.display = 'block';
			up.innerHTML = "<input id=\"thumbnail2\" type=\"button\" value=\"上传侧栏广告\">";
			fm.adv.value = 3;
			break;
	}
	
	var thumbnail1 = document.getElementById('thumbnail1');
	if (thumbnail1) {
		thumbnail1.onclick = function () {
			WindowCenter('../config/upfile.php?type=adver&size=690x80', 'upfile', '433', '166');
		};
	}
	
	var thumbnail2 = document.getElementById('thumbnail2');
	if (thumbnail2) {
		thumbnail2.onclick = function () {
			WindowCenter('../config/upfile.php?type=adver&size=270x200', 'upfile', '433', '166');
		};
	}
	
	function WindowCenter(url, name, width, height) {
		var left = (screen.width - width) / 2;
		var top = (screen.height - height - 233) / 2;
		window.open(url, name, 'width = ' + width + ', height = ' + height + ', left = ' + left + ', top = ' + top);
	}
	
}

function checkAdver() {
	var fm = document.content;

	if (fm.title.value == '' || fm.title.value.length > 23) {
		alert('广告标题不得为空不得大于23位');
		fm.title.value = '';
		fm.title.focus();
		return false;
	}
	
	if (fm.link.value.length == '') {
		alert('广告连接不得为空');
		fm.link.value = '';
		fm.link.focus();
		return false;
	}
	
	if (fm.type[1].checked || fm.type[2].checked) {
		if (fm.thumbnail_img.value == '') {
			alert('广告图片不得为空');
			return false;
		}
	}
	
	if (fm.info.value.length > 233) {
		alert('广告描述不得大于233位');
		fm.info.value = '';
		fm.info.focus();
		return false;
	}
	
}