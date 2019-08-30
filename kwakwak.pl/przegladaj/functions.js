function viewcomm() {
	let xyz = document.getElementsByClassName('xyzrow');
	var offset = xyz.length;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("viewcomment").innerHTML = this.responseText;
		}
	}
	if(offset == 0) {
	var url = "ajax/ajax_przegladaj.php?view=true";
	
	xhttp.open("GET", url, true);
	xhttp.send();
	} else {
		document.getElementById("viewcomment").innerHTML = "";
	}
}
function morecomm() {
	let xyz = document.getElementsByClassName('xyzrow');
	var offset = xyz.length;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			document.getElementById('showme').remove();
			var show = document.getElementById("viewcomment");
			show.insertAdjacentHTML("beforeend", this.responseText);
			}
		}
		

		let url = "ajax/ajax_przegladaj.php?more=true&offset=" + offset;
		xhttp.open("GET", url, true);
		xhttp.send();

}
function addcomment() {



	let tresc = document.getElementById('komentarz').value;

	let send = "addcomment=true&tresc=" + tresc;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("newcomment").innerHTML = this.responseText;
		}
	}
	xhttp.open("POST", "ajax/ajax_przegladaj.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
	viewcomm();
}