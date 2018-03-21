




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
	if (fm.title.value == '' || fm.title.value.length < 2 || fm.title.value.length > 23) {
		alert('标题不得为空,并且在2到23位之间');
		fm.title.focus();
		return false;
	}
	if (fm.info.value.length > 233) {
		alert('描述不得大于233位');
		fm.info.focus();
		return false;
	}

	return true;

}