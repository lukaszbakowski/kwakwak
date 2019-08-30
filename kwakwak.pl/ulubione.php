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

<p><a href="polubione.php"><button class="zakladka unactualzakladka">Ostatnio polubione</button></a><button class="zakladka  actualzakladka">Obserwowani</button></p>
	<div class="srodek">

	przejdź do <a href="szukaj.php">wyszukiwarki</a> i polub interesujące Cię ogłoszenia, aby móc kontaktować się z ludzmi<br>
	możesz także obserwować interesujące Cie profile

	</div>
	<h2>Obserwowni</h2>
	śledź nowe ogłoszenia Twoich <a href="viewobs.php">ulubionych</a> kwakowiczów
	
	<main class="row">

<?php

require_once('php/connect.php');
$connect=connection_start();

$logedAS = $_SESSION['zalogowany'];
$sql = "SELECT * FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN ulubione ON ulubione.id_obserwowanego = ogloszenia.id_uzytkownika
		WHERE ulubione.id_obserwujacego = $logedAS
		ORDER BY data DESC LIMIT 30";
$result4 = $connect->query($sql);
while($row = $result4->fetch_assoc()) {
	

				$cena =				$row["cena"];
				$subject =			$row["subject"];
				$url =				$row['img0'];
				$id_ogl =			$row['id_ogloszenia'];
				$id_uzytkownika = 	$row['id_uzytkownika'];
				
				if(!$url) $url = "img.png";
	
					$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;
				
				$ask = "SELECT * FROM alreadyseen WHERE id_ogloszenia = $id_ogl AND dislike = 0";
				$result2 = $connect->query($ask);
				$ilosc2 = $result2->num_rows;
	
	
	echo '<a href="przegladaj.php?id='.$id_ogl.'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
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