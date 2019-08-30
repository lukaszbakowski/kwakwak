function kategoria() {

	var header = document.getElementsByClassName('categories')[0];
	var btns = header.getElementsByClassName('filtr');

	for (var i = 0; i < btns.length; i++) {
		btns[i].addEventListener("click", replace);
	}
}

function replace() {
	var current = document.getElementsByClassName("catactive");
	current[0].className = current[0].className.replace(" catactive", "");
	this.className += " catactive";
}