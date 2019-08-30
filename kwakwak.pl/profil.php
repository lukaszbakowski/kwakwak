<?php 
	require_once('php/connect.php');
	$connect = connection_start();
	session_start();

	if(!isset($_SESSION['zalogowany'])) {
		header('Location:zaloguj.php');
		$_SESSION['statement']= '<span style="color:red;">musisz się zalogować</span>';
		exit;
	}
	if(isset($_GET['id'])) {
			$id1 = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
			$id2 = filter_var($id1, FILTER_SANITIZE_NUMBER_INT);
			if($id1 != $id2) {
				header('Location:profil.php');
				exit;
			} else {
				$sql = "SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id2";
				$res = $connect->query($sql);
				if($res->num_rows == 0) {
				header('Location:profil.php');
				exit;
				}
			}
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
<link type="text/css" rel="stylesheet" href="css/search.css">
<link type="text/css" rel="stylesheet" href="css/przegladaj.css">
<script src="script/newtag.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="audio/quack.js"></script>
</head>
<body onload="choice()">
<?php include('index/header.php') ?>
<main class="section col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
<div id="lewa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="lewa">

<?php include('index/lewa.php'); ?>
	
	</div>

</div>

<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">
<p><button class="zakladka actualzakladka">Podgląd profilu</button><a href="zarzadzaj.php"><button class="zakladka unactualzakladka">Zarządzaj ogłoszeniami</button></a></p>
<style>
.relcont {
	position:relative;
}
#message, #rekomendacja, #viewrek {
	display:none;
	width:100%;
	position:absolute;
	z-index:3;
	background-color:white;
	padding: 3rem;
	border:1px solid dimgrey;
}
</style>
<div class="relcont"><div id="message">
<form>
	<p style="text-align:left; margin-left:3.75%;">Temat:</p>
	<input type="text" id="text" style="width:92.5%; padding:0.3rem;" placeholder="temat..">
	<p style="width:100%;"><textarea style="margin:0 auto;" id="wiadomosc" rows="10" maxlength="500" placeholder="treść wiadomości" autofocus></textarea></p>
	<p style="width:100%; text-align:right;"><input type="reset" class="submit reset" value="anuluj" onclick="message()">&nbsp;<input style="margin-right:3.75%;" id="sendmes" type="reset" class="submit" value="wyślij" onclick="send()"></p>
</form>
</div></div>
<div class="relcont"><div id="rekomendacja">
<div>Jeśli miałeś styczność z <?php
if(isset($id2)) {
	$row = $res->fetch_array(MYSQLI_NUM);
	$login = $row[0];
	echo $login;
} ?>, podziel się swoją opinią z innymi</div>
<form>
<p style="width:90%; text-align:left; margin-left:3.75%;">
<select id="ocena">
	<option value="9">10</option>
	<option value="8">9</option>
	<option value="7">8</option>
	<option value="6">7</option>
	<option value="5">6</option>
	<option value="4">5</option>
	<option value="3">4</option>
	<option value="2">3</option>
	<option value="1">2</option>
	<option value="0">1</option>
</select>&nbsp;Jak oceniasz tego użytkownika?</p>
	<p style="width:100%;"><textarea style="margin:0 auto;" id="rektext" rows="10" maxlength="500" placeholder="Czy użytkownik jest godny polecenia? Napisz swoją rekomendację" autofocus></textarea></p>
	<p style="width:100%; text-align:right;"><input type="reset" class="submit reset" value="anuluj" onclick="rekomendacja()">&nbsp;<input style="margin-right:3.75%;" id="sendrek" type="reset" class="submit" value="Oceń" onclick="reksend()"></p>
</form>
</div></div>
<div class="relcont"><div id="viewrek">
<output id="viewoutput"></output>
<p style="width:100%; text-align:right; margin-top:3rem;"><input type="button" class="submit reset" onclick="viewrek();" value="zamknij"></p>
</div></div>
<main class="row">
<style>
.cellina {

	background-color:white;
	margin:1rem;
	display:flex;
	flex-wrap:wrap;
	flex: 1 1 30%;
	align-content:space-around;
	justify-content:center;
	max-width:calc((100% * 0.3) - 2rem);

}
.spell {
	background-color:white;
	margin:1rem;
	display:flex;
	padding:0 1rem 1rem 2rem;
	flex-wrap:wrap;
	flex: 1 1 70%;
	text-align:justify;
	align-content:flex-start;
	justify-content:space-between;
	max-width:calc((100% * 0.7) - 2rem);

}
.uikon {
	width:100%;
	font-size:5rem;
	color:grey;
}
.mikon {
	width:33.3%;
	font-size:1.5rem;
	text-align:left;
	padding:0.3rem 0 0.3rem 1rem;
	background-color:lightgrey;
	border-top:1px solid grey;
}
.sikon {
	width:33.3%;
	font-size:1.5rem;
	text-align:right;
	padding:0.3rem 1rem 0.3rem 0;
	background-color:lightgrey;
	border-top:1px solid grey;
}
.ocena {
	width:100%;
	font-size:1.3rem;
}
.childocena {
	width:50%;
	text-align:left;
	background-color:white;
	padding:0.5rem 0.3rem 0.3rem 1rem;
}
.iloscg {
	width:50%;
	text-align:right;
	background-color:white;
	padding:0.5rem 1rem 0.3rem 0.3rem;
}
.opinie {
	width:100%;
	padding:0 0 1rem;
}
.hicon {
	width:33.3%;
	font-size:1.5rem;
	background-color:lightgrey;
	padding:0.3rem;
	border-top:1px solid grey;
}
.hicon:hover, .sikon:hover, .mikon:hover, .opinie:hover {
	color:orangered;
	cursor:pointer;
}
.hicon::before {
	content:"+";
}
.uname {
	width:100%;
	font-size:1.5rem;
	background-color:lightgrey;
	padding:0.3rem;
	border-bottom:1px solid grey;

}
.comline {
	display:block; text-align:justify; width:100%; padding:1rem;"
}
</style>

<div class="cellina">

	<main class="ocena"><div class="childocena">Ocena: 
	<?php
		if(isset($id2)) {
				$sql = "SELECT CAST(avg(`ocena`) AS decimal(2,1)) AS srednia FROM `opinia` WHERE `id_ocenianego` = $id2";
		} else {
			$id_uzytkownika = $_SESSION['zalogowany'];
			$sql = "SELECT CAST(avg(`ocena`) AS decimal(2,1)) AS srednia FROM `opinia` WHERE `id_ocenianego` = $id_uzytkownika";
		}
		if($result = $connect->query($sql)) {

			$row = $result->fetch_array(MYSQLI_NUM);
				if($row[0] !="") {
					$srednia = $row[0];
					echo $srednia.'/10';
				} else echo "0/10";
		}
	?>
	
	
		</div>
		<div class="iloscg">
		<?php if(isset($id2)) {
			$sql = "SELECT count(*) AS result FROM opinia WHERE id_ocenianego = $id2;";
		} else {
			$id_uzytkownika = $_SESSION['zalogowany'];
			$sql = "SELECT count(*) AS result FROM opinia WHERE id_ocenianego = $id_uzytkownika;";
		}
		if($result = $connect->query($sql)) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				echo $row['result'];
		}
		?> głosów</div>
		
	</main>
<div class="uname">
<?php
if(isset($id2)) {
	echo $login;
} else {
	echo '<script>document.write(localStorage.nick)</script>';
}
?>

</div>
	<div class="uikon"><i class="icon-user" title=""></i></div>
	<div class="opinie"><i style="text-align:right;" class="icon-heart-empty" title="zobacz opinię" onclick="viewrek(1);">zobacz opinię</i></div>
	<script>
	function viewrek(x) {
		
		let id_uz = <?php if(isset($id2)) {echo $id2;} else { echo $_SESSION['zalogowany'];} ?>;
		
		if(x) {
			document.getElementById('viewrek').style.display="block";
			
			let url = "ajax/ajax_profil.php?viewrek=true&id_uzytkownika="+ id_uz;
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('viewoutput').innerHTML = this.responseText;
				}
			}
			xhttp.open("GET", url, true);
			xhttp.send();
		} else {
			document.getElementById('viewrek').style.display="none";
			document.getElementById('viewoutput').innerHTML = "";
		}
		
	}
	</script>
	

	

	<?php
	if((isset($id2)) && $id2 != $_SESSION['zalogowany']) {
		$id_uzytkownika = $_SESSION['zalogowany'];
			echo '<div class="mikon" onclick="message('.$id2.');"><i class="icon-mail" title="napisz do użytkownika"></i></div>';
			
		$sql = "SELECT * FROM opinia WHERE id_ocenianego = $id2 AND id_oceniajacego = $id_uzytkownika";
		$result = $connect->query($sql);
		if($result->num_rows == 0) {
			echo '<div id="rek" class="hicon" onclick="rekomendacja('.$id2.');"><i class="icon-heart-empty" title="dodaj opinię"></i></div>';
		} else {
			echo '<div id="rek" class="hicon" onclick="rekomendacja('.$id2.');"><i class="icon-heart" title="dodaj opinię"></i></div>';
		}
			
			
		$sql = "SELECT id_ulubione FROM ulubione WHERE id_obserwowanego = $id2 AND id_obserwujacego = $id_uzytkownika";
		$result = $connect->query($sql);
		if($result->num_rows == 0) {
			echo '<div id="fav" class="sikon" onclick="ulubione('.$id2.',0);"><i class="icon-star-empty" title="dodaj do ulubionych"></i></div>';
		} else {
			echo '<div id="fav" class="sikon" onclick="ulubione('.$id2.',1);"><i class="icon-star" title="dodaj do ulubionych"></i></div>';
		}
	} else {
			echo '<div class="mikon" style="cursor:not-allowed;"><i class="icon-mail"></i></div>';
			echo '<div class="hicon" style="cursor:not-allowed;"><i class="icon-heart-empty"></i></div>';
			echo '<div class="sikon" style="cursor:not-allowed;"><i class="icon-star-empty"></i></div>';
	}
	?>
	
	
</div>

<div class="spell">
<div style="width:100%; text-align:right; padding:0.5rem 1rem;">
<?php 
	if(isset($id2)) {
		$sql = "SELECT count(*) AS obsy FROM ulubione WHERE id_obserwowanego = $id2";
	} else {
		$id_uzytkownika = $_SESSION['zalogowany'];
		$sql = "SELECT count(*) AS obsy FROM ulubione WHERE id_obserwowanego = $id_uzytkownika";
	}
	if($result = $connect->query($sql)) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo $row['obsy'];
	}
?> obserwujących</div>
<div style="padding:2rem;"><?php
if(isset($id2)) {
			$sql = "SELECT * FROM `ustawienia` WHERE `id_uzytkownika` = $id2";
} else {
	$id_uzytkownika = $_SESSION['zalogowany'];
	$sql = "SELECT * FROM `ustawienia` WHERE `id_uzytkownika` = $id_uzytkownika";
}
if($result = $connect->query($sql)) {
	if($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$opis = $row['opis'];
	echo $opis;
	}
}

?></div>
</div>
</main>


<script>
function rekomendacja(x) {
	if(x) {
	document.getElementById('rekomendacja').style.display="block";
	document.getElementById('sendrek').setAttribute("id_uz", x);
	} else {
		document.getElementById('rekomendacja').style.display="none";
		document.getElementById('sendrek').removeAttribute("id_uz");
	}
}
function reksend() {
	let ocena = document.getElementById('ocena').value;
	let tresc = document.getElementById('rektext').value;
	let count = document.getElementById('rekomendacja').innerHTML;
	let id_uz = document.getElementById('sendrek').getAttribute("id_uz");
	let send = "rek=true&tresc=" + tresc + "&ocena=" + ocena + "&id_uz=" + id_uz;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("rekomendacja").innerHTML = this.responseText;
		}
	}
	xhttp.open("POST", "ajax/ajax_profil.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
	setTimeout(function(){	document.getElementById('rekomendacja').style.display="none";
							document.getElementById('rekomendacja').innerHTML = count;
							document.getElementById('sendrek').removeAttribute("id_uz");
							document.getElementById('rek').innerHTML = '<i class="icon-heart" title="dodaj opinię"></i>';}, 2000);
}
function ulubione(y, x) {
	var fav = document.getElementById('fav');
	if(x == "0") {
		fav.innerHTML = '<i class="icon-star" title="dodaj do ulubionych"></i>';
		fav.removeAttribute('onClick');
		fav.setAttribute('onClick', 'ulubione('+y+',1);')
		var url = "ajax/ajax_profil.php?fav=0&id="+y;
	} else if(x == "1") {
		fav.innerHTML = '<i class="icon-star-empty" title="dodaj do ulubionych"></i>';
		fav.removeAttribute('onClick');
		fav.setAttribute('onClick', 'ulubione('+y+',0);')
		var url = "ajax/ajax_profil.php?fav=1&id="+y;
	}
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		this.responseText;
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
}
function message(y) {
	if(y) {
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




<h2>Ostatnio dodane ogłoszenia</h2>

		<main class="row">
		
<?php

if(isset($id2)) {
	$id_uzytkownika = $id2;
	unset($id2);
} else {
	$id_uzytkownika = $_SESSION['zalogowany'];
}

$sql = "SELECT * FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		WHERE uzytkownicy.id_uzytkownika = '$id_uzytkownika'
		ORDER BY data DESC LIMIT 30";
$result4 = $connect->query($sql);
if(!$result4->num_rows) {
	echo '<p>nie dodałeś jeszcze żadnych ogłoszeń</p>';
} else {
	

	while($row = $result4->fetch_assoc()) {
	

				$cena =			$row["cena"];
				$subject =		$row["subject"];
				$url =			$row['img0'];
				$id_ogl =		$row['id_ogloszenia'];
				
				if(!$url) $url = "img.png";
	
					$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;
				
				$ask = "SELECT * FROM alreadyseen WHERE id_ogloszenia = $id_ogl AND dislike = 0";
				$result2 = $connect->query($ask);
				$ilosc2 = $result2->num_rows;
	
	
		echo '<a href="przegladaj.php?value='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
	}
}
$connect->close();
?>
</main>
</div>

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