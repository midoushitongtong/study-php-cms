




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
	if (fm.nav_name.value == '' || fm.nav_name.value.length < 2 || fm.nav_name.value.length > 23) {
		alert('网站导航名称不得为空,并且在2到23位之间');
		fm.nav_name.focus();
		return false;
	}
	if (fm.nav_info.value.length > 233) {
		alert('网站导航描述不得大于233位');
		fm.nav_info.focus();
		return false;
	}

	return true;

}
