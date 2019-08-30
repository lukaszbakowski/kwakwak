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
<script src="script/newtag.js"></script>
<script src="script/navbar.js"></script>
<script src="script/choice.js"></script>
<script src="script/reset.js"></script>
<script src="script/validate.js"></script>
<script src="script/catactive.js"></script>
<script src="img/img.js"></script>
<script src="audio/quack.js"></script>
<style>
.infocolor {color:DodgerBlue ;}
.infocolor:hover {color:black;}
iframe {
	border:none;
	padding:0;
	margin:0 auto;
}
</style>
</head>

<body>


 <form action="framename.php" method="post" target="output_frame">
 
 <select id="select" required>
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

<div class="rightlocation">
				<select name="miejscowosc" id="select" multiple size="11">


		<optgroup label="MIEJSCOWOŚĆ">
			<option value="">wszystkie miasta</option>
		</optgroup>
<optgroup label="B">

    <option value="barlinek">Barlinek</option>
    <option value="barwice">Barwice</option>
    <option value="bialogard">Białogard</option>
    <option value="bialybor">Biały Bór</option>
    <option value="bobolice">Bobolice</option>
    <option value="bornesulinowo">Borne Sulinowo</option>
</optgroup>
<optgroup label="C">

    <option value="cedynia">Cedynia</option>
    <option value="chociwel">Chociwel</option>
    <option value="chojna">Chojna</option>
    <option value="choszczno">Choszczno</option>
    <option value="czaplinek">Czaplinek</option>
    <option value="czlopa">Człopa</option>
</optgroup>
<optgroup label="D">

    <option value="darlowo">Darłowo</option>
    <option value="debno">Dębno</option>
    <option value="dobra">Dobra (łobeski)</option>
    <option value="dobrzany">Dobrzany</option>
    <option value="drawno">Drawno</option>
    <option value="drawskopomorskie">Drawsko Pomorskie</option>
    <option value="dziwnow">Dziwnów</option>
</optgroup>
<optgroup label="G">

    <option value="golczewo">Golczewo</option>
    <option value="goleniow">Goleniów</option>
    <option value="goscino">Gościno</option>
    <option value="gryfice">Gryfice</option>
    <option value="gryfino">Gryfino</option>
</optgroup>
<optgroup label="I">

    <option value="insko">Ińsko</option>
</optgroup>
<optgroup label="K">

    <option value="kaliszpomorski">Kalisz Pomorski</option>
    <option value="kamienpomorski">Kamień Pomorski</option>
    <option value="karlino">Karlino</option>
    <option value="kolobrzeg">Kołobrzeg</option>
    <option value="koszalin">Koszalin</option>
</optgroup>
<optgroup label="L">

    <option value="lipiany">Lipiany</option>
</optgroup>
<optgroup label="Ł">

    <option value="lobez">Łobez</option>
</optgroup>
<optgroup label="M">

    <option value="maszewo">Maszewo</option>
    <option value="mielno">Mielno</option>
    <option value="mieszkowice">Mieszkowice</option>
    <option value="miedzyzdroje">Międzyzdroje</option>
    <option value="miroslawiec">Mirosławiec</option>
    <option value="moryn">Moryń</option>
    <option value="mysliborz">Myślibórz</option>
</optgroup>
<optgroup label="N">

    <option value="nowewarpno">Nowe Warpno</option>
    <option value="nowogard">Nowogard</option>
</optgroup>
<optgroup label="P">

    <option value="polczyce">Pełczyce</option>
    <option value="ploty">Płoty</option>
    <option value="polanow">Polanów</option>
    <option value="police">Police</option>
    <option value="polczynzdroj">Połczyn-Zdrój</option>
    <option value="pyrzyce">Pyrzyce</option>
</optgroup>
<optgroup label="R">

    <option value="recz">Recz</option>
    <option value="resko">Resko</option>
</optgroup>
<optgroup label="S">

    <option value="sianow">Sianów</option>
    <option value="slawno">Sławno</option>
    <option value="stargard">Stargard</option>
    <option value="stepnica">Stepnica</option>
    <option value="suchan">Suchań</option>
    <option value="szczecin">Szczecin</option>
    <option value="szczecinek">Szczecinek</option>
</optgroup>
<optgroup label="Ś">

    <option value="swidwin">Świdwin</option>
    <option value="swinoujscie">Świnoujście</option>
</optgroup>
<optgroup label="T">

    <option value="trzcinskozdroj">Trzcińsko-Zdrój</option>
    <option value="trzebiatow">Trzebiatów</option>
    <option value="tuczno">Tuczno</option>
    <option value="tychowo">Tychowo</option>
</optgroup>
<optgroup label="W">

    <option value="walcz">Wałcz</option>
    <option value="wegorzyno">Węgorzyno</option>
    <option value="wolin">Wolin</option>
</optgroup>
<optgroup label="Z">

    <option value="zlocieniec">Złocieniec</option>
</optgroup>
	</select>
</div>

				
				<input type="submit" name="submit">		</form>

				



			<iframe name="output_frame" id="output_frame" src="framename.php">
			</iframe>  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>