




function checkReg() {
	
	var fm = document.reg;
	
	if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 23) {
		alert('用户名不得为空并且不得小于两位不得大于23位');
		fm.user.focus();
		return false;
	}
	if (fm.pass.value == '' || fm.pass.value.length < 6) {
		alert('密码不得为空并且不得小于6位');
		fm.pass.focus();
		return false;
	}
	if (fm.notpass.value != fm.pass.value) {
		alert('密码和确认密码不一致');
		fm.notpass.focus();
		return false;
	}
	if (fm.email.value == '') {
		alert('电子邮件不得为空');
		fm.email.focus();
		return false;
	}
	if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
		alert('电子邮件格式不正确');
		fm.email.focus();
		return false;
	}
	if (fm.code.value.length < 4) {
		alert('验证码必须是4位');
		fm.code.focus()
		return false;
	}
	
	return true;
	
}

function checkLogin() {
	
	var fm = document.login;
	
	if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 23) {
		alert('用户名不得为空并且不得小于两位不得大于23位');
		fm.user.focus();
		return false;
	}
	if (fm.pass.value == '' || fm.pass.value.length < 6) {
		alert('密码不得为空并且不得小于6位');
		fm.pass.focus();
		return false;
	}
	if (fm.code.value.length < 4) {
		alert('验证码必须是4位');
		fm.code.focus()
		return false;
	}
	
	return true;
	
}

window.onload = function () {
	var fm = document.reg;
	if (fm != undefined) {
		var face = fm.face;
		face.onchange = function () {
			var index = this.selectedIndex;
			var imgsrc = this.options[index].value;
			fm.faceimg.src = 'images/' + imgsrc;
		}
	}
}
