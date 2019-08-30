function activenav() 
{
	if(document.getElementsByClassName("active")[0]) {
	let hehe=document.getElementsByClassName("active")[0];
	hehe.classList.remove("active");
	}
}
function unactivenav()
{
	if(document.getElementById("unactive")) {
	let haha=document.getElementById("unactive");
	haha.classList.add("active");
	}
}
function curnav() {
	function test(i) {
	let cur = tag[i];
	cur.href = "#";
	cur.classList.add('active');
	cur.id = 'unactive';
	}
	let ele = window.location.pathname;
	let cont = document.getElementById('navbar');
	let tag = cont.getElementsByTagName('a');

	if(ele=="/index.php" || ele=="/") {test(0);}
	else if(ele=="/szukaj.php" || ele=="/przegladaj.php") {test(1);}
	else if(ele=="/dodaj.php" || ele=="/kwakchat.php") {test(2);}
	else if(ele=="/polubione.php" || ele=="/ulubione.php") {test(3);}
	else if(ele=="/profil.php" || ele=="/zarzadzaj.php") {test(4);}
}