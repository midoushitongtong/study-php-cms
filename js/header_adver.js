var header = [];
header[1] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/20160702100431168.jpg',
	'link' : '#'
};
header[2] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/2016070210041667.jpg',
	'link' : '#'
};
header[3] = {
	'title' : '风景',
	'pic' : '/customsize/uploads/20160702/2016070210033892.jpg',
	'link' : '#'
};
var i = Math.floor(Math.random() * 3 + 1);document.write('<a href="' + header[i].link + '" target="_blank"><img src="' + header[i].pic + '"></a>')