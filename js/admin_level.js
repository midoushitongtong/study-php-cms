




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

}

function checkForm() {

	var fm = document.addupdateForm;
	if (fm.level_name.value == '' || fm.level_name.value.length < 2 || fm.level_name.value.length > 23) {
		alert('管理等级名称不得为空,并且在2到23位之间');
		fm.level_name.focus();
		return false;
	}
	if (fm.level_info.value.length > 233) {
		alert('管理等级描述不得大于233位');
		fm.level_info.focus();
		return false;
	}

	return true;

}