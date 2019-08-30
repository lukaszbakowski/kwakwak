<?php 
session_start();
require_once('php/connect.php');
$connect = connection_start();
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
<meta name="robots" content="index">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Niewątpliwie najlepszy i najszybciej rozwijający się darmowy serwis ogłoszeń lokalnych w zupełnie nowej odsłonie, wykwakaj światu co tylko zechcesz">
<meta name="author" content="Łukasz Bąkowski">
<meta name="keywords" content="kwakwak,kwakwa,kaczka,kaczuszka,ogłoszenia,praca,rozrywka,elektronika,nieruchomości,ruchomości,biznes,zwierzaki,wydarzenia,imprezy,społeczność,randki,moda,uroda,sport,zdrowie,sztuka,prawo,oddam,zamienie,hobby,usługi,restauracje,edukacja,dziecko,pomysł,kupie,sprzedam,kupię,szukam">
<title>Ogłoszenia kwakwak.pl jedyny taki</title>
<link rel="shortcut icon" href="./grafika/logo.svg" type="image/svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
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
	<div class="srodek">
	<div style="padding:2rem;">
	<p>STRONA W PRZEBUDOWIE</p>

	<?php
	if(!isset($_SESSION['zalogowany'])) {
		echo '<p>Pomóż nam się rozwijać i dorzuć coś od siebie, <a href="rejestracja.php" style="color:orangered">zarejestruj się</a>, dodawaj własne ogłoszenia.. bądź skorzystaj z mini <span style="color:grey;">#</span><strong>kwakChat</strong>\'u.</p>';
	}
	?>
	<p>Niech Twój głos <strong>dotrze</strong> do ludzi w Twojej okolicy, <span style="color:grey;">#</span><strong>wykwakaj</strong> światu co tylko zechcesz :)</p>
	<p style="font-size:0.9rem; text-align:justify;">kwakwak.pl to darmowe ogłoszenia lokalne, wykwakaj światu co tylko zechcesz,
	znajdziesz tu wszystko co potrzebujesz w kategoriach: praca, rozrywka, elektronika, nieruchomości,
	ruchomości, biznes, zwierzaki, wydarzenia, imprezy, społeczność, ludzie, randki, moda, uroda, sport, zdrowie, sztuka, prawo, oddam,
	zamienie, hobby, usługi, restauracje, edukacja, dziecko, pomysły, sprzedam, kupię itd. <a href="welcome.php">czytaj więcej...</a></p>
	</div>
<h2>Aktualnie najczęściej używane tagi</h2>
<main class="row" style="padding:0.5rem; background-color:whitesmoke; margin:1rem;">
<?php
//		$test = "SELECT tagname FROM taglist ORDER BY tagsum DESC LIMIT 20";
		$test = "SELECT DISTINCT tagname, id_taglist, tagsum FROM ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia = hashtagi.id_ogloszenia
		INNER JOIN taglist ON ogloszenia.id_ogloszenia = hashtagi.id_ogloszenia
		WHERE (unactiv - now()) > 0
		ORDER BY taglist.tagsum DESC LIMIT 20";
		$result3 = $connect->query($test);
		while($lool = $result3->fetch_assoc()) {
			echo '<p title="'.$lool['tagsum'].'" class="tagindex"><span style="color:dimgrey;">#</span><a href="przegladaj.php?tagvalue='.$lool['id_taglist'].'">'.$lool['tagname'].'</a></p>';
		}
?>
</main>
<h2>Nowe ogłoszenia</h2>
<main class="row">
<?php

$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia=hashtagi.id_ogloszenia
		ORDER BY data DESC LIMIT 6";
	if($result = $connect->query($sql)) {
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$miejscowosc = 	$row["miejscowosc"];
				$wojewodztwo = 	$row['wojewodztwo'];
				$cena =			$row["cena"];
				$opis =			$row["opis"];
				$subject =		$row["subject"];
				$url =			$row['img0'];
				$login =		$row["login"];
				$tagREAD = [	$row['tag0'],
								$row['tag1'],
								$row['tag2'],
								$row['tag3'],
								$row['tag4'],
								$row['tag5'],
								$row['tag6'],
								$row['tag7'],
								$row['tag8'],
								$row['tag9']];
				$data =			$row['data'];
				$id_ogl =		$row['id_ogloszenia'];
				
				if(!$url) $url = "img.png";
				
				$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;
				
				$ask = "SELECT * FROM alreadyseen WHERE id_ogloszenia = $id_ogl AND dislike = 0";
				$result2 = $connect->query($ask);
				$ilosc2 = $result2->num_rows;
				
				
				
				if(!$url) $url = "img.png";
				
				echo '<a href="przegladaj.php?id='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
			}
		}
		} else {echo "brak polaczenia";}
		
		

?>

</main>
<h2>Last minute</h2>
<main class="row">
<?php

$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia=hashtagi.id_ogloszenia
		WHERE (unactiv - now()) BETWEEN 0 AND 999999
		ORDER BY rand() LIMIT 6";
	if($result = $connect->query($sql)) {
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$miejscowosc = 	$row["miejscowosc"];
				$wojewodztwo = 	$row['wojewodztwo'];
				$cena =			$row["cena"];
				$opis =			$row["opis"];
				$subject =		$row["subject"];
				$url =			$row['img0'];
				$login =		$row["login"];
				$tagREAD = [	$row['tag0'],
								$row['tag1'],
								$row['tag2'],
								$row['tag3'],
								$row['tag4'],
								$row['tag5'],
								$row['tag6'],
								$row['tag7'],
								$row['tag8'],
								$row['tag9']];
				$data =			$row['data'];
				$id_ogl =		$row['id_ogloszenia'];
				
				if(!$url) $url = "img.png";
				
				$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;
				
				$ask = "SELECT * FROM alreadyseen WHERE id_ogloszenia = $id_ogl AND dislike = 0";
				$result2 = $connect->query($ask);
				$ilosc2 = $result2->num_rows;
				
				
				
				if(!$url) $url = "img.png";
				
				echo '<a href="przegladaj.php?id='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
			}
		}
		} else {echo "brak polaczenia";}
		


?>
</main>
<h2>Popularne</h2>
<main class="row">
<?php
$sql = "SELECT *, count(*) AS lol FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN alreadyseen ON ogloszenia.id_ogloszenia=alreadyseen.id_ogloszenia
		WHERE alreadyseen.dislike = 0
		AND (unactiv - now()) > 0
		GROUP BY alreadyseen.id_ogloszenia
		ORDER BY count(*) DESC LIMIT 6";
$result4 = $connect->query($sql);
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
	
	
	echo '<a href="przegladaj.php?id='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
}
?>
</main>
<h2>Gorące dyskusje</h2>

<main class="row">
<?php
$sql = "SELECT *, count(*) AS lol FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN comment ON ogloszenia.id_ogloszenia=comment.id_ogloszenia
		WHERE (unactiv - now()) > 0
		GROUP BY comment.id_ogloszenia
		ORDER BY count(*) DESC LIMIT 6";
$result4 = $connect->query($sql);
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
	
	
	echo '<a href="przegladaj.php?id='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
}
$connect->close();
?>
</main>

<h2>Najgłośniejsi kwakowicze</h2>
<p><i style="color:dodgerblue;">wciąż w budowie</i></p>
<p>cały czas rośniemy w siłę.. i zapewne jeszcze wiele się tu zmieni :)</p>
<p><strong>pomóż nam się rozwijać</strong>, <i style="color:dodgerblue;">polub</i> nas na <a href="https://www.facebook.com/ogloszenia.kwakwak" target="_blank">Facebook</a>'u  i <u>podziel się swoją opinią</u></P>
<p>dziękujemy, że z nami jesteś</p>

	</div>
	
</div>


<div id="prawa" class="col-xl-2 col-l-2 col-m-12 col-s-12 col-xs-12">
	<div class="prawa">
<?php include('index/kwakchat.php') ?>
	</div>

</div>
</main>
<?php include('index/stopka.php') ?>

<?php include('index/footer.php') ?>

<output id="ciastko"></output>
<script src="script/cookies.js"></script>
<script>window.onload=ciasteczko();</script>


</body>
</html>