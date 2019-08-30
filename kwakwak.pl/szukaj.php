<?php
	session_start(); 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3690304735816428",
    enable_page_level_ads: true
  });
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ogłoszenia</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/search.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
<link type="text/css" rel="stylesheet" href="css/add.css">
<noscript><meta http-equiv="refresh" content="0; url=index/whatyouwant.php"></noscript>
<script src="script/newtag.js"></script>

<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="script/catactive.js"></script>
<script src="audio/quack.js"></script>
<style>
.infocolor {color:DodgerBlue ;}
.infocolor:hover {color:black;}

</style>
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
<p><button class="zakladka actualzakladka">Kryteria wyszukiwania</button><a href="przegladaj.php"><button class="zakladka unactualzakladka">Chybił trafił</button></a></p>


	<div class="line" style="justify-content:center; background-color:rgb(255,199,0); padding:1rem;margin:1rem 0.5rem; border-radius:1rem;">
		
				<div><i class="icon-location ispan"></i>
				<select name="wojewodztwo" id="wojewodztwo" form="noweogloszenie" onchange="choice()" required>
					<optgroup label="WYBIERZ">
						<option value="0">cała Polska</option>
					</optgroup>
					<optgroup label="WOJEWÓDŹTWA">
						<option value="dolnoslaskie">dolnośląskie</option>
						<option value="kujawskopomorskie">kujawsko-pomorskie</option>
						<option value="lubelskie">lubelskie</option>
						<option value="lubuskie">lubuskie</option>
						<option value="lodzkie">łódzkie</option>
						<option value="malopolskie">małopolskie</option>
						<option value="mazowieckie">mazowieckie</option>
						<option value="opolskie">opolskie</option>
						<option value="podkarpackie">podkarpackie</option>
						<option value="podlaskie">podlaskie</option>
						<option value="pomorskie">pomorskie</option>
						<option value="slaskie">śląskie</option>
						<option value="swietokrzyskie">świętokrzyskie</option>
						<option value="warminskomazurskie">warmińsko-mazurskie</option>
						<option value="wielkopolskie">wielkopolskie</option>
						<option value="zachodniopomorskie">zachodniopomorskie</option>
					</optgroup>
				</select></div>
				<span id="miasta" style="width:13rem;"></span>
		

				
					<div><i class="icon-hashtag ispan"></i><input id="inputplus" class="inputplus" type="text" maxlength="17" placeholder="słowo kluczowe" onkeyup="checkEnter(event)" autocomplete="off" onkeypress="return validateSEARCH(event);" onpaste="return false"><button onclick="newtag()" id="submitplus"><i class="icon-plus-circled"></i></button></div>
			

	</div>
	<div class="srodek">

	
		

		<fieldset id="categories">
		<legend>Kategoria</legend>
			<ol class="categories">
				<li class="filtr catactive"><label for="ruchomosci"><i class="icon-cab"></i></label><ul class="opis"><li class="ofiltr">ruchomości</li></ul></li>
				<li class="filtr"><label for="nieruchomosci"><i class="icon-commerical-building"></i></label><ul class="opis"><li class="ofiltr">nieruchomości</li></ul></li>
				<li class="filtr"><label for="elektronika"><i class="icon-mobile"></i></label><ul class="opis"><li class="ofiltr">elektronika</li></ul></li>
				<li class="filtr"><label for="rozrywka"><i class="icon-gamepad"></i></label><ul class="opis"><li class="ofiltr">rozrywka</li></ul></li>
				<li class="filtr"><label for="sztuka"><i class="icon-brush"></i></label><ul class="opis"><li class="ofiltr">sztuka</li></ul></li>
				<li class="filtr"><label for="praca"><i class="icon-suitcase"></i></label><ul class="opis"><li class="ofiltr">praca</li></ul></li>
				<li class="filtr"><label for="prawne"><i class="icon-hammer"></i></label><ul class="opis"><li class="ofiltr">prawne</li></ul></li>
				<li class="filtr"><label for="dzieci"><i class="icon-school"></i></label><ul class="opis"><li class="ofiltr">dla dzieci</li></ul></li>
				<li class="filtr"><label for="modauroda"><i class="icon-diamond"></i></label><ul class="opis"><li class="ofiltr">moda i uroda</li></ul></li>
				<li class="filtr"><label for="sportzdrowie"><i class="icon-tennis"></i></label><ul class="opis"><li class="ofiltr">sport i zdrowie</li></ul></li>
				<li class="filtr"><label for="oddamzamienie"><i class="icon-handshake-o"></i></label><ul class="opis"><li class="ofiltr">oddam lub zamienie</li></ul></li>
				<li class="filtr"><label for="spolecznosc"><i class="icon-users"></i></label><ul class="opis"><li class="ofiltr">społeczność</li></ul></li>
				<li class="filtr"><label for="biznes"><i class="icon-chart"></i></label><ul class="opis"><li class="ofiltr">biznes</li></ul></li>
				<li class="filtr"><label for="edukacja"><i class="icon-graduation-cap"></i></label><ul class="opis"><li class="ofiltr">edukacja</li></ul></li>
				<li class="filtr"><label for="hobby"><i class="icon-scissors"></i></label><ul class="opis"><li class="ofiltr">hobby</li></ul></li>
				<li class="filtr"><label for="uslugi"><i class="icon-fast-food"></i></label><ul class="opis"><li class="ofiltr">usługi i restauracje</li></ul></li>
				<li class="filtr"><label for="pomysly"><i class="icon-lightbulb"></i></label><ul class="opis"><li class="ofiltr">pomysły</li></ul></li>
				<li class="filtr"><label for="wydarzenia"><i class="icon-megaphone-1"></i></label><ul class="opis"><li class="ofiltr">wydarzenia</li></ul></li>
				<li class="filtr"><label for="zwierzaki"><i class="icon-guidedog"></i></label><ul class="opis"><li class="ofiltr">zwierzaki</li></ul></li>	
				<li class="filtr"><label for="imprezy"><i class="icon-glass"></i></label><ul class="opis"><li class="ofiltr">imprezy</li></ul><li>

			</ol>
		</fieldset>
	<input type="radio" name="kategoria" id="ruchomosci" value="ruchomosci" form="noweogloszenie" checked hidden>
	<input type="radio" name="kategoria" id="nieruchomosci" value="nieruchomosci" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="elektronika" value="elektronika" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="rozrywka" value="rozrywka" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="sztuka" value="sztuka" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="praca" value="praca" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="prawne" value="prawne" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="dzieci" value="dzieci" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="modauroda" value="modauroda" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="sportzdrowie" value="sportzdrowie" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="oddamzamienie" value="oddamzamienie" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="spolecznosc" value="spolecznosc" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="biznes" value="biznes" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="edukacja" value="edukacja" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="hobby" value="hobby" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="uslugi" value="uslugi" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="pomysly" value="pomysly" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="wydarzenia" value="wydarzenia" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="zwierzaki" value="zwierzaki" form="noweogloszenie" hidden>
	<input type="radio" name="kategoria" id="imprezy" value="imprezy" form="noweogloszenie" hidden>
	

			<form method="post" id="noweogloszenie"><div id="tagkont"></div></form>
			

		
			

			<div class="line" style="padding:1rem; justify-content:end;">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">jeśli nie ma, pozostaw te pola puste</li>
				</ul>
				Cena: od&nbsp;
				<input style="width:7rem;" id="min" form="noweogloszenie" name="min" onpaste="return false" type="number" class="number" title="tylko liczba całkowita" pattern="[0-9]" placeholder="0" autocomplete="off" id="txtIdNum" onkeypress="return AllowOnlyNumbers(event);">
				&nbsp;do&nbsp;
				<input form="noweogloszenie" id="max" name="max" style="width:7rem;" onpaste="return false" type="number" class="number" title="tylko liczba całkowita" pattern="[0-9]" placeholder="0" autocomplete="off" id="txtIdNum" onkeypress="return AllowOnlyNumbers(event);">
				&nbsp;pln
			</div> 
			
	</div>		
			
			
			<p>	<input type="reset" class="submit reset" value="wyczyść" form="noweogloszenie" onclick="resetall()">
			
			<?php if(isset($_GET['reset'])) {
				if(isset($_SESSION['search'])) {
					unset($_SESSION['search']);
					unset($_SESSION['kategoria']);
					unset($_SESSION['wojewodztwo']);
					unset($_SESSION['miejscowosc']);
					unset($_SESSION['cenamin']);
					unset($_SESSION['cenamax']);
					for($i = 0; $i < 10; $i++) {
						unset($_SESSION['tag'.$i.'']);
					}
				}
			}

			?>
			
				<input type="button" name="search" class="submit" onclick="searchstore(); ultratest();" form="noweogloszenie" value="SZUKAJ">
			</p>

	<output id="ubertest"></output>
</div>


<div id="prawa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="prawa">
<?php include('index/kwakchat.php') ?>
	</div>

</div>
</main>
<?php include('index/stopka.php') ?>
<?php include('index/footer.php') ?>

<script>
function searchstore() {
	sessionStorage.search = document.getElementById('srodek').innerHTML;
}
function searchrestore() {
	if(sessionStorage.search) {
	document.getElementById('srodek').innerHTML = sessionStorage.search;
	}
}
function ultratest() {
	
	var wojewodztwo = document.getElementById('wojewodztwo').value;
	if(document.getElementById('miejscowosc')) {
	var miejscowosc = document.getElementById('miejscowosc').value;
	} else miejscowosc = "";
	var min = document.getElementById('min').value;
	var max = document.getElementById('max').value;

	var kategoria = document.getElementsByName('kategoria');
	
	for(var i = 0; i < kategoria.length; i++) {
		if(kategoria[i].checked==true) {
			kategoria = kategoria[i].value;
			break;
		}
	}
	var troll = "";
	if(document.getElementsByClassName('inputtag')) {
		var tag = document.getElementsByClassName('inputtag');
		for(var i = 0; i < tag.length; i++) {
			troll += "&tag"+i+"="+tag[i].value;
		}
	}


	// Returns successful data submission message when the entered information is stored in database.
	var send = "search=true&kategoria=" + kategoria + "&wojewodztwo=" + wojewodztwo + "&miejscowosc=" + miejscowosc + "&min=" + min + "&max=" + max + troll;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("ubertest").innerHTML = this.responseText;
		}
	}
  xhttp.open("POST", "ajax/ajax_search.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(send);
}
function ubertest(x, y) {
	
	var x = (x);
	var y = (y);

	var url = "ajax/ajax_search.php?count=" + x + "&offset=" + y + "&search=true";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("ubertest").innerHTML = this.responseText;
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
}
function demonAlive() {
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("ubertest").innerHTML = this.responseText;
		}
	}
	xhttp.open("GET", "ajax/ajax_search.php?session=true", true);
	xhttp.send();
}
</script>
<script>document.onload=kategoria();</script>
<?php if(isset($_SESSION['search'])) { echo '<script>document.onload=demonAlive();</script>';} ?>
</body>
</html>