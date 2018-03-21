var sidebar = [];
sidebar[1] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/2016070210094473.jpg',
	'link' : '#'
};
sidebar[2] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/2016070210093172.jpg',
	'link' : '#'
};
sidebar[3] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/2016070210085693.jpg',
	'link' : '#'
};
var i = Math.floor(Math.random() * 3 + 1);
document.write('<a href="sidebar[i].link" target="_blank"><img src="' + sidebar[i].pic + '"></a>')