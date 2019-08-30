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
<link type="text/css" rel="stylesheet" href="css/search.css">
<link type="text/css" rel="stylesheet" href="css/add.css">
<noscript><meta http-equiv="refresh" content="0; url=index/whatyouwant.php"></noscript>
<script src="script/newtag.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="script/catactive.js"></script>
<script src="img/img.js"></script>
<style>
.infocolor {color:DodgerBlue ;}
.infocolor:hover {color:black;}
</style>
</head>

<body>
<?php include('index/header.php');?>

<main class="section col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
<div id="lewa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="lewa">

<?php include('index/lewa.php'); ?>
	
	</div>
</div>

<div id="srodek" class="col-xl-6 col-l-8 col-m-12 col-s-12 col-xs-12">
	<div class="srodek">
<p><button class="zakladka actualzakladka">Dodaj ogłoszenie</button><a href="kwakchat.php"><button class="zakladka unactualzakladka">kwakChat</button></a></p>

			<div class="line" style="justify-content:center; background-color:rgb(255,199,0); padding:1rem;margin:1rem 0.5rem; border-radius:1rem;">
		
				<span style="color:red;">*</span><i class="icon-location ispan"></i>
				<select title="lokalizacja" name="wojewodztwo" id="wojewodztwo" form="noweogloszenie" id="select" onchange="choice()" required>
					<optgroup label="WYBIERZ">
						<option value="0">wybierz</option>
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
				<span id="miasta" style="width:13rem;"></span>
		

				
					&nbsp;<span style="color:red;">*</span><i class="icon-hashtag ispan"></i><input title="Dodaj minimum jeden tag, hasło najbardziej zbliżone temu co przedstawiasz (maksymalnie 10)" id="inputplus" class="inputplus" type="text" maxlength="17" placeholder="słowo kluczowe" onkeyup="checkEnter(event)" autocomplete="off" onkeypress="return validateSEARCH(event);" onpaste="return false"><button onclick="newtag()" id="submitplus"><i class="icon-plus-circled"></i></button>
			

	</div>
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

		
		
		
	</div>
<main>
<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">				
		
		<form method="post" action="php/action_dodaj.php" id="noweogloszenie" enctype="multipart/form-data"><div id="tagkont"></div></form></section>
<section class="maincont col-xl-9 col-l-9 col-m-9 col-s-9 col-xs-9">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">(maksymalnie 50 znaków)</li>
				</ul>Temat:&nbsp;<span style="color:red;">*</span>
			</div>
		<input type="text" form="noweogloszenie" name="subject" class="subject" maxlength="50" placeholder="temat.."></section>
<section style="text-align:left;" class="maincont col-xl-3 col-l-3 col-m-3 col-s-3 col-xs-3">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">jeśli nie ma, pozostaw to pole puste</li>
				</ul>Cena:
			</div>
			<input type="number" form="noweogloszenie" name="cena" class="number" maxlength="10" title="tylko liczba całkowita" pattern="[0-9]" placeholder="0" autocomplete="off" id="txtIdNum" onkeypress="return AllowOnlyNumbers(event);" onpaste="return false">&nbsp;pln</section>
<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">		<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">krótki, ale zwięzły - dla własnego bezpieczeństwa zalecamy nie podawać danych kontaktowych (maksymalnie 999 znaków)</li>
				</ul>Opis:&nbsp;<span style="color:red;">*</span>
			</div>
				<textarea form="noweogloszenie" name="opis" rows="11" maxlength="999" placeholder="wykwakaj światu co tylko zechcesz, ogłoszenie będzie aktywne 7 dni z możliwością jego przedłużenia "></textarea>
</section>


<section class="maincont col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">	<div class="line">
				<ul class="infoi"><i class="icon-info-circled infocolor"></i>
					<li class="opisi">pierwsze powinno jak najlepiej przedstawiać treść ogłoszenia, dozwolone formaty: JPG JPEG PNG, plik nie może być większy jak 1 MB</li>
				</ul>Zdjęcia:
			</div>
		<main class="imgMain">
			
				<label class="img activimg" for="image_uploads0"><i class="icon-camera"></i></label>
				<label class="img" for="image_uploads1"><i class="icon-camera"></i></label>
				<label class="img" for="image_uploads2"><i class="icon-camera"></i></label>
				<label class="img" for="image_uploads3"><i class="icon-camera"></i></label>
				<label class="img" for="image_uploads4"><i class="icon-camera"></i></label>
			
			<button class="btn activbtn">1</button>
			<button class="btn">2</button>
			<button class="btn">3</button>
			<button class="btn">4</button>
			<button class="btn">5</button>
		</main>
		<input type="file" id="image_uploads0" onchange="readURL(event)" form="noweogloszenie" name="image_uploads0" accept="image/jpg, image/jpeg, image/png" hidden>
		<input type="file" id="image_uploads1" onchange="readURL(event)" form="noweogloszenie" name="image_uploads1" accept="image/jpg, image/jpeg, image/png" hidden>
		<input type="file" id="image_uploads2" onchange="readURL(event)" form="noweogloszenie" name="image_uploads2" accept="image/jpg, image/jpeg, image/png" hidden>
		<input type="file" id="image_uploads3" onchange="readURL(event)" form="noweogloszenie" name="image_uploads3" accept="image/jpg, image/jpeg, image/png" hidden>
		<input type="file" id="image_uploads4" onchange="readURL(event)" form="noweogloszenie" name="image_uploads4" accept="image/jpg, image/jpeg, image/png" hidden>
</section>




			
		<main style="justify-content:flex-end; width:100%; padding:2rem;"><input type="submit" form="noweogloszenie" name="search" class="submit" value="gotowe"></main>

		<p><i style="font-size:0.9rem;">Uwaga: dla własnego bezpieczeństwa zalecamy nie umieszczać danych kontaktowych w niniejszym formularzu, zainteresowani ogłoszeniem otrzymają możliwość wysłania wiadomości za pośrednictwem naszego serwisu</i></p>

		
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
<script>
document.onload=kategoria();
document.onload=btns();
</script>

</body>
</html>