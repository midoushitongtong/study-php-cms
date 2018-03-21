




window.onload = function () {
	
	var level = document.getElementById('level');
	var options = document.getElementsByTagName('option');
	if (level) {
		for (var i = 0; i < options.length; i ++) {
			if (options[i].value == level.value) {
				options[i].setAttribute('selected', 'selected');
			}
		}
	}
	
	
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

function checkAddForm() {

	var fm = document.add;
	if (fm.admin_user.value == '' || fm.admin_user.value.length < 2 || fm.admin_user.value.length > 23) {
		alert('用户名不得为空,并且2至23位之间');
		fm.admin_user.focus();
		return false;
	}
	if (fm.admin_pass.value == '' || fm.admin_pass.value.length < 6) {
		alert('密码不得为空,并且不得小于6位');
		fm.admin_pass.focus();
		return false;
	}
	if (fm.admin_pass.value != fm.admin_notpass.value) {
		alert('确认密码必须和密码一致');
		fm.admin_notpass.focus();
		return false;
	}

	return true;

}

function checkUpdateForm() {

	var fm = document.update;
	if (fm.admin_pass.value != '') {
		if (fm.admin_pass.value.length < 6) {
			alert('密码不得小于6位');
			fm.admin_pass.focus();
			return false;
		}
	}
	return true;
	
}