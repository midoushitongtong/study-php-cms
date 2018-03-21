




document.addEventListener('DOMContentLoaded', function () {
	var fm = document.friendlink;
	var logo = document.getElementById('logo');
	if (fm.type[1].checked) logo.style.display = 'block';
	fm.type[0].onclick = function () {
		logo.style.display = 'none';
	}
	fm.type[1].onclick = function () {
		logo.style.display = 'block';
	}
}, false);

function checkForm() {
	var fm = document.friendlink;

	if (fm.webname.value == '' || fm.webname.value.length > 23) {
		alert('网站名称不得为空并且不得大于23位');
		fm.webname.focus();
		return false;
	}
	if (fm.weburl.value == '' || fm.weburl.value.length > 233) {
		alert('网站地址不得为空并且不得大于233位');
		fm.weburl.focus();
		return false;
	}
	if (fm.type[1].checked) {
		if (fm.weblogo.value == '' || fm.weblogo.value.length > 233) {
			alert('网站logo地址不得空并且不得大于233位');
			fm.weblogo.focus();
			return false;
		}
	}
	if (fm.user.value.length > 23) {
		alert('站长名称不得大于23位');
		fm.user.focus();
		return false;
	}
	if (fm.code.value.length != 4) {
		alert('验证码必须是4位');
		fm.code.focus();
		return false;
	}


	return true;
}
