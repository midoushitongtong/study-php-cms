var text = [];
text[1] = {
	'title' : '这里文字广告',
	'link' : '#'
};
var i = Math.floor(Math.random() * 1 + 1);
document.write('<a href="' + text[i].link + '" target="_blank" style="color: #06f;">' + text[i].title + '</a>');