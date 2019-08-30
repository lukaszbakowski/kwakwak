<?php 

	session_start();

	if(!isset($_SESSION['zalogowany'])) {
		header('Location:zaloguj.php');
		$_SESSION['statement'] = '<span style="color:red;">musisz się zalogować</span>';
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
.list {
	width:100%;
	font-size:1rem;
	padding:0.3rem;
	display:flex;
	justify-content:space-between;
	align-items:center;
}
.list:hover {
	background-color:lightblue;
}
.b {
	font-weight:bold;
}
.c {
	background-color:lightgrey;
}
a {
	color:black;
}
.delete {
	color:orangered;
}
.delete:hover {
	color:blue;
}
.usun {
	width:1%;
}
.nadawca {
	width:15%;
}
.msgsub {
	width:55%;
	text-overflow: "...";
	overflow: hidden;
	white-space: nowrap;
}
.date {
	width:25%;
}
.menu {
	padding:1rem;
	color:grey;
}
.topmenu {
	width:95%;
	margin:0 auto;
	text-align:left;
	padding:1rem;
	border-bottom:1px solid grey;
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
<style>
.relcont {
	position:relative;
}
#readmsg, #remsg {
	display:none;
	width:100%;
	position:absolute;
	z-index:3;
	background-color:white;
	padding:3rem;
	border:1px solid dimgrey;
}
.readnadawca {
	width:50%;
	text-align:left;
}
.readdate {
	width:50%;
	text-align:right;
}
.readsubject {
	width:100%;
	text-align:left;
	padding:1rem 0;
}
.readtresc {
	width:100%;
	text-align:justify;
	padding:1rem 0;
}
.readbutton {
	width:100%;
	text-align:right;
	padding:1rem;
}
</style>
<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">
<div class="topmenu"><a class="menu" onclick="selectall();">zaznacz wszystkie</a><a class="menu" onclick="unselect();">odznacz</a><a class="menu" onclick="deleteselected()">usuń zaznaczone</a></div>

<div class="relcont"><main id="readmsg">

</main></div>
<div class="relcont"><main id="remsg">
<form>
	<p style="text-align:left; margin-left:3.75%;">Temat:</p>
	<input type="text" id="text" style="width:92.5%; padding:0.3rem;" value="" disabled>
	<p style="width:100%;"><textarea style="margin:0 auto;" id="wiadomosc" rows="10" maxlength="500" placeholder="treść wiadomości" autofocus></textarea></p>
	<p style="width:100%; text-align:right;"><input type="reset" class="submit reset" value="anuluj" onclick="remsg()">&nbsp;<input style="margin-right:3.75%;" id="sendmes" type="reset" class="submit" value="wyślij"></p>
</form>
</main></div>

<main><p class="usun">&nbsp;</p><p class="nadawca">nadawca</p><p class="msgsub">temat</p><p class="date">data</p></main>

<?php

require_once('php/connect.php');
$connect=connection_start();
$id_uzytkownika = $_SESSION['zalogowany'];
$sql = "SELECT (SELECT uzytkownicy.login FROM uzytkownicy WHERE uzytkownicy.id_uzytkownika = messages.id_nadawcy) AS logname, subject, readed, data, id_messages, id_nadawcy FROM messages
		WHERE id_odbiorcy = $id_uzytkownika
		ORDER BY data DESC LIMIT 30;";
if($result = $connect->query($sql)) {
	if($result->num_rows == 0) {
		echo 'Nie masz żadnych wiadomości';
	} else {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			if($i % 2 != 0) {$c = " c";} else {$c = "";}
			if($row['readed'] == "0") { $b = " b";} else {$b = "";}
				echo '<main class="list'.$b.$c.'"><input id_msg="'.$row['id_messages'].'" class="checkbox usun" type="checkbox"><a class="nadawca" href="profil.php?id='.$row['id_nadawcy'].'">'.$row['logname'].'</a><a class="msgsub" onclick="readmsg(this, '.$row['id_messages'].');">'.$row['subject'].'</a><div class="date">'.$row['data'].'</div></main>';
				$i++;
		}
	}
}

$connect->close();
?>
<output id="test"></output>
</div>
<script>
function readmsg(ele, x) {
	var msg = document.getElementById('readmsg');
	if(x) {
	ele.parentElement.classList.remove("b");
	var url = "ajax/ajax_messages.php?read=true&id=" + x;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		msg.innerHTML = this.responseText;
		msg.style.display = "flex";
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
	} else {
		msg.style.display = "none";
		msg.innerHTML = "";
	}
}
function remsg(x) {
	var remsg = document.getElementById('remsg');
	var sbj = document.getElementById('sbj');
	var text = document.getElementById('text');
	var readmsg = document.getElementById('readmsg');
	var sendmes = document.getElementById("sendmes");

	if(x) {
		remsg.style.display = "block";
		text.value = "re: " + sbj.innerHTML;
		readmsg.style.display = "none";
		readmsg.innerHTML = "";
		sendmes.setAttribute("onClick", "send("+x+")");
	} else {
		remsg.style.display = "none";
		text.value = "";
		sendmes.removeAttribute("onClick");
	}
}
function send(x) {
	let subject = document.getElementById('text').value;
	let tresc = document.getElementById('wiadomosc').value;
	let count = document.getElementById('remsg').innerHTML;
	let id_odb = x;
	let send = "send=true&tresc=" + tresc + "&temat=" + subject + "&id_uz=" + id_odb;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("remsg").innerHTML = this.responseText;
		}
	}
	xhttp.open("POST", "ajax/ajax_polubione.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
	setTimeout(function(){	document.getElementById('remsg').style.display="none";
							document.getElementById('remsg').innerHTML = count;}, 2000);
}
function selectall() {
	let checkbox = document.getElementsByClassName('usun');
	
	for(let i=0; i<checkbox.length; i++) {
		checkbox[i].checked = true;
	}
}
function unselect() {
	let checkbox = document.getElementsByClassName('usun');
	
	for(let i=0; i<checkbox.length; i++) {
		checkbox[i].checked = false;
	}
}
function deleteselected() {
	var checkbox = document.getElementsByClassName('usun');
	var i;
	var j = 1;
	var send = "";
	for(i = 1; i < checkbox.length; i++) {
		if(checkbox[i].checked === true) {
			let id = checkbox[i].getAttribute("id_msg");
			checkbox[i].parentElement.remove();
			send = send + "&id" + j + "=" + id;
			++j;
			--i;
		}
	}
	var url = "ajax/ajax_messages.php?delete=true" + send + "&howmany=" + j;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById('test').innerHTML = this.responseText;
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
	
	
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