function resetall()
{
document.getElementById('miasta').innerHTML="";
document.getElementById('tagkont').innerHTML="";
	var current = document.getElementsByClassName("catactive");
	current[0].classList.remove("catactive");
	var btn = document.getElementsByClassName('filtr')[0];
		btn.classList.add('catactive');
		location.href="szukaj.php?reset=1";
}