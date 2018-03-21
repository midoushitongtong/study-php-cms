




function checkComment() {
	var fm = document.comment;
	
	if (fm.content.value == '' || fm.content.value.length > 233) {
		alert('内容不得为空并且不得大于233位');
		fm.content.focus();
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
	var fm = document.comment;
	fm.send.onclick = function () {
		return checkComment();
	}
}
