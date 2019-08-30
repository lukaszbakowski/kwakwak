<?php 

	session_start();

	if(!isset($_SESSION['zalogowany'])) {
		header('Location:zaloguj.php');
		$_SESSION['statement']= '<span style="color:red;">musisz się zalogować</span>';
		exit;
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ogłoszenia</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
<script src="script/newtag.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="audio/quack.js"></script>
	<style>
.hover {
	display:none;
}
.cell:hover > .hover {
	display:flex;
	flex-direction:column;
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background-color:white;
	border:1px solid orangered;
	justify-content:center;
}
.relcont {
	position:relative;
}
#message {
	display:none;
	width:100%;
	position:absolute;
	z-index:3;
	background-color:white;
	padding: 3rem;
	border:1px solid dimgrey;
}
</style>
</head>
<body>
<?php include('index/header.php') ?>
<main class="section col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
<div id="lewa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="lewa">

<?php include('index/lewa.php'); ?>
	
	</div>

</div>

<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">
	<p><button class="zakladka actualzakladka">Ostatnio polubione</button><a href="ulubione.php"><button class="zakladka unactualzakladka">Obserwowani</button></a></p>
	<div class="srodek">

	przejdź do <a href="szukaj.php">wyszukiwarki</a> i polub interesujące Cię ogłoszenia, aby móc kontaktować się z ludzmi<br>
	możesz także obserwować interesujące Cie profile

	</div>
	<h2>Ostatnio polubione</h2>
	kontaktuj się z ludzmi spośród wybranych przez siebie ofert

<div class="relcont"><div id="message">
<form>
	<p style="text-align:left; margin-left:3.75%;">Temat:</p>
	<input type="text" id="text" style="width:92.5%; padding:0.3rem;" value="" disabled>
	<p style="width:100%;"><textarea style="margin:0 auto;" id="wiadomosc" rows="10" maxlength="500" placeholder="treść wiadomości" autofocus></textarea></p>
	<p style="width:100%; text-align:right;"><input type="reset" class="submit reset" value="anuluj" onclick="message()">&nbsp;<input style="margin-right:3.75%;" id="sendmes" type="reset" class="submit" value="wyślij" onclick="send()"></p>
</form>
</div></div>

<output id="start"></output>
<script>
	var url = "ajax/ajax_polubione.php?search=true";

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("start").innerHTML = this.responseText;
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
</script>
</div>
<script>
function delpost(z, x) {
	if(confirm("Jesteś pewny, że chcesz usunąć to ogłoszenie z listy?")) {
		var id_ogloszenia = (x);
		
		var url = "ajax/ajax_polubione.php?id_ogloszenia=" + id_ogloszenia + "&delete=true";
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			z.parentElement.remove();
			}
		}
		xhttp.open("GET", url, true);
		xhttp.send();
	}
}
function ubertest(x, y) {
	
	var x = (x);
	var y = (y);

	var url = "ajax/ajax_polubione.php?count=" + x + "&offset=" + y + "&search=true";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("start").innerHTML = this.responseText;
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
}
function message(x, y) {
	if(x && y) {
	document.getElementById('text').value = "Pytanie dotyczące ogłoszenia o numerze ID: " + x;
	document.getElementById('message').style.display="block";
	document.getElementById('sendmes').setAttribute("id_uz", y);
	} else {
		document.getElementById('message').style.display="none";
		document.getElementById('sendmes').removeAttribute("id_uz");
	}
}
function send() {
	
	let subject = document.getElementById('text').value;
	let tresc = document.getElementById('wiadomosc').value;
	let count = document.getElementById('message').innerHTML;
	let id_uz = document.getElementById('sendmes').getAttribute("id_uz");
	let send = "send=true&tresc=" + tresc + "&temat=" + subject + "&id_uz=" + id_uz;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("message").innerHTML = this.responseText;
		}
	}
	xhttp.open("POST", "ajax/ajax_polubione.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
	setTimeout(function(){	document.getElementById('message').style.display="none";
							document.getElementById('message').innerHTML = count;
							document.getElementById('sendmes').removeAttribute("id_uz");}, 2000);
}
</script>

<div id="prawa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="prawa">
<?php include('index/kwakchat.php') ?>
	</div>

</div>
</main>
<?php include('index/stopka.php') ?>
<?php include('index/footer.php') ?>
</body>
</html>