<?php 
	require_once('php/connect.php');
	$connect = connection_start();
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
<p><a href="profil.php"><button class="zakladka unactualzakladka">Podgląd profilu</button></a><button class="zakladka actualzakladka">Zarządzaj ogłoszeniami</button></p>
Ogłoszenia są aktywne siedem dni. Wygasłe już ogłoszenia mogą zostać ponownie reaktywowane dopiero po upływie bazowego czasu aktywności. Możesz mieć aktywnych maksymalnie pięć ogłoszeń jednocześnie, aby dodać kolejne lub reaktywować wcześniejsze ogłoszenie musisz zaczekać, aż zwolni się miejsce.<br>Aktywne ogłoszenia powinny różnić się od siebie, inaczej mogą zostać uznane za spam.<br>Ogłoszenia nieaktywne dłużej jak miesiąc będą sukcesywnie usuwane.</br>
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
</style>
		<main class="row">
		
<?php


	$id_uzytkownika = $_SESSION['zalogowany'];


$sql = "SELECT * FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		WHERE uzytkownicy.id_uzytkownika = '$id_uzytkownika'
		AND (unactiv - now()) < 0
		ORDER BY data DESC LIMIT 30";
$result4 = $connect->query($sql);
if(!$result4->num_rows) {
	echo '<p>nie masz żadnych wygasłych ogłoszeń</p>';
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
	
	
		echo '<div class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div><div class="hover"><a onclick="delpost(this.parentElement, '.$id_ogl.');">reaktywuj</a><a href="przegladaj.php?id='.$row['id_ogloszenia'].'">podgląd ogłoszenia</a></div></div>';
	}
}
$connect->close();
?>
</main>
<output id="test"></output>
<script>
function delpost(z, x) {
	
		var id_ogloszenia = (x);
		
		var url = "ajax/ajax_zarzadzaj.php?id_ogloszenia=" + id_ogloszenia + "&reactive=true";
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			z.parentElement.remove();

			}
		}
		xhttp.open("GET", url, true);
		xhttp.send();
	
}
</script>
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