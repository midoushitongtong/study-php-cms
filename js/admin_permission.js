




window.onload = function () {

	var title = document.getElementById('navtie');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
	for (var i = 0; i < a.length; i ++) {
		a[i].className = '';
		if (a[i].innerHTML == title.innerHTML) {
			a[i].className = 'selected';
		}
	}

}

function checkForm() {

	var fm = document.add;
	if (fm.name.value == '' || fm.name.value.length < 2 || fm.name.value.length > 103) {
		alert('管理权限名称不得为空,并且在2到103位之间');
		fm.name.focus();
		return false;
	}
	if (fm.info.value.length > 233) {
		alert('管理权限描述不得大于233位');
		fm.info.focus();
		return false;
	}

	return true;

}