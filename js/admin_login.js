




function checkLogin() {
	
	var fm = document.login;
	if (fm.admin_user.value == '' || fm.admin_user.value.length < 2 || fm.admin_user.value.length > 23) {
		alert('用户名不能为空,并且2和23位之间');
		fm.admin_user.focus();
		return false;
	}
	if (fm.admin_pass.value == '' || fm.admin_pass.value.length < 6) {
		alert('密码不能为空,并且不能小于6位');
		fm.admin_pass.focus();
		return false;
	}
	if (fm.code.value.length != 4) {
		alert('验证码必须为4位');
		fm.code.focus();
		return false;
	}
	
	return true;
}