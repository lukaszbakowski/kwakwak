<?php 
session_start(); 


?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ogłoszenia</title>
<link type="text/css" rel="stylesheet" href="css/styletest.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<script src="script/newtag.js"></script>
<script src="script/navbar.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
</head>
<body onload="choice()">
<main>

<header>
	<p><img src="grafika/newtest.png" alt="logo" width="50" style="vertical-align:middle">#<span style="color:orangered">k</span>wa<span style="color:orangered">k</span>wa<span style="color:orangered;">k</span>.pl darmowy serwis ogłoszeniowy</p>

</header>
<nav id="navbar">

		<ol class="navbar" onmouseover="activenav()" onmouseout="unactivenav()">
			<li><a href="#" id="unactive" class="active"><i class="icon-home"></i></a></li>
			<li><a href="#"><i class="icon-search"></i></a></li>
			<li><a href="#"><i class="icon-plus-squared"></i></a></li>
			<li><a href="#"><i class="icon-heart"></i></a></li>
			<li><a href="#"><i class="icon-user"></i></a></li>
		</ol>

</nav>
<section class="section col-10">
<div id="lewa" class="col-2">
	<div class="lewa">

		



		<hr>
		<aside>MOŻE REKLAMA</aside>
	
	</div>

</div>

<div id="srodek" class="col-8">
	<div class="srodek">
		<div class="searcher">

			<p class="new">	
						
				<select name="wojewodztwo" id="select" onchange="choice()" required>
					<optgroup label="WYBIERZ">
						<option value="kraj">cała Polska</option>
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
				</select>
			</p>
			<p class="new" id="miasta"></p>
						<p class="new">
				<input id="inputplus" class="tagin" type="text" maxlength="15" placeholder="słowo kluczowe" onkeyup="checkEnter(event)">&nbsp;<input onclick="newtag()" id="submitplus" type="submit" value="+">
			</p>
			</div>

		<fieldset id="categories">
		<legend>filtry</legend>
			<ol class="categories">
				<li class="filtr"><i class="icon-cab"></i><ul class="opis"><li class="ofiltr">ruchomości</li></ul><li>
				<li class="filtr"><i class="icon-commerical-building"></i><ul class="opis"><li class="ofiltr">nieruchomości</li></ul><li>
				<li class="filtr"><i class="icon-mobile"></i><ul class="opis"><li class="ofiltr">elektronika</li></ul><li>
				<li class="filtr"><i class="icon-gamepad"></i><ul class="opis"><li class="ofiltr">rozrywka</li></ul><li>
				<li class="filtr"><i class="icon-brush"></i><ul class="opis"><li class="ofiltr">sztuka</li></ul><li>
				<li class="filtr"><i class="icon-suitcase"></i><ul class="opis"><li class="ofiltr">praca</li></ul><li>
				<li class="filtr"><i class="icon-hammer"></i><ul class="opis"><li class="ofiltr">prawne</li></ul><li>
				<li class="filtr"><i class="icon-school"></i><ul class="opis"><li class="ofiltr">dla dzieci</li></ul><li>
				<li class="filtr"><i class="icon-diamond"></i><ul class="opis"><li class="ofiltr">moda i uroda</li></ul><li>
				<li class="filtr"><i class="icon-tennis"></i><ul class="opis"><li class="ofiltr">sport i zdrowie</li></ul><li>
				<li class="filtr"><i class="icon-handshake-o"></i><ul class="opis"><li class="ofiltr">oddam lub zamienie</li></ul><li>
				<li class="filtr"><i class="icon-users"></i><ul class="opis"><li class="ofiltr">społeczność</li></ul><li>
				<li class="filtr"><i class="icon-chart"></i><ul class="opis"><li class="ofiltr">biznes</li></ul><li>
				<li class="filtr"><i class="icon-graduation-cap"></i><ul class="opis"><li class="ofiltr">edukacja</li></ul><li>
				<li class="filtr"><i class="icon-scissors"></i><ul class="opis"><li class="ofiltr">hobby</li></ul><li>
				<li class="filtr"><i class="icon-fast-food"></i><ul class="opis"><li class="ofiltr">lokale i usługi</li></ul><li>
				<li class="filtr"><i class="icon-lightbulb"></i><ul class="opis"><li class="ofiltr">pomysły</li></ul><li>
				<li class="filtr"><i class="icon-megaphone-1"></i><ul class="opis"><li class="ofiltr">wydarzenia</li></ul><li>
				<li class="filtr"><i class="icon-guidedog"></i><ul class="opis"><li class="ofiltr">zwierzaki</li></ul><li>	


				<li class="filtr"><i class="icon-glass"></i><ul class="opis"><li class="ofiltr">imprezy</li></ul><li>

			</ol>
		</fieldset>
		<p><input type="reset" class="submit reset" value="wyczyść" onclick="resetall()"></p>

	<div id="tagkont"></div>
		<div class="ogloszenia">
		<p>Hej! Jestem Quaquak..</p>
			<p>wykwakaj światu co tylko zechcesz<br>
			dodawaj słowa kluczowe i znajdz co potrzebujesz<br>
			daj się odnaleźć innym<br>
			prowadz swoją tablicę ogłoszeniową<br>
			zdobywaj reputację<br>
			oceniaj innych</p>

		</div>
	</div>
	
</div>


<div id="prawa" class="col-2">
	<div class="prawa">


	<hr>
	<h1>REKLAMA</h1>
		<aside>MOŻE REKLAMA</aside>
	</div>

</div>
</section>
<aside>MOŻE REKLAMA</aside>
<footer>
<div><p>regulamin | cookies | polityka prywatności | kontakt | pomoc</p></div>
<p>Copyright &copy; 2018 kwakwak.pl all rights reserved</p>
</footer>

</main>


</body>
</html>