<?php 
include_once('php/functions.php');
require_once('php/connect.php');
$connect=connection_start();
$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia=hashtagi.id_ogloszenia
		ORDER BY RAND() LIMIT 1";
function search() {
			if(isset($_SESSION['zalogowany'])) {$id_uzytkownika = $_SESSION['zalogowany'];}
			$kategoria = $_SESSION['kategoria'];
			$wojewodztwo = $_SESSION['wojewodztwo'];
			$miejscowosc = $_SESSION['miejscowosc'];
			$cena_min = $_SESSION['cenamin'];
			$cena_max = $_SESSION['cenamax'];
			for($i = 0; $i < 10; $i++) {
				$tag[$i]=$_SESSION['tag'.$i.''];
			}
			if($wojewodztwo=='0') {
				$sqlpart2 = "";
			} else {
				$sqlpart2 = "AND ogloszenia.id_lokalizacja = ANY (SELECT id_lokalizacja FROM lokalizacja WHERE wojewodztwo = '$wojewodztwo')";
			}
			if($miejscowosc=='0' || !$miejscowosc) {
				$sqlpart3 = "";
			} else {
				$sqlpart3 = "AND ogloszenia.id_lokalizacja = ANY (SELECT id_lokalizacja FROM lokalizacja WHERE miejscowosc = '$miejscowosc')";
			}
			if(!$cena_min) {
				$sqlpart4 = "AND cena BETWEEN 0";
			} else {
				$sqlpart4 = "AND cena BETWEEN $cena_min";
			}
			if(!$cena_max) {
				$sqlpart5 = "AND 99999999999";
			} else {
				$sqlpart5 = "AND $cena_max";
			}
			for($i=0;$i<10;$i++)
			{
				if(!$tag[$i]) $tag[$i] = "0";
			}
			if($tag[0] == "0" && $tag[1] == "0" && $tag[2] == "0" && $tag[3] == "0" && $tag[4] == "0" && $tag[5] == "0" && $tag[6] == "0" && $tag[7] == "0" && $tag[8] == "0" && $tag[9] == "0") {
				$sqlpart1 = "WHERE 1 = 1";
			} else {
				$sqlpart1 = "WHERE ogloszenia.id_ogloszenia = ANY (	SELECT hashtagi.id_ogloszenia FROM hashtagi
																	INNER JOIN taglist 	ON tag0 = id_taglist
																	WHERE tag0 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag1 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag2 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag3 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag4 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag5 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag6 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag7 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag8 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]'))
																	OR tag9 = ANY (SELECT id_taglist FROM taglist WHERE tagname IN ('$tag[0]', '$tag[1]', '$tag[2]', '$tag[3]', '$tag[4]', '$tag[5]', '$tag[6]', '$tag[7]', '$tag[8]', '$tag[9]')))";
			}
			if(isset($id_uzytkownika)) {
				$sqlpart6 = "AND ogloszenia.id_ogloszenia NOT IN (SELECT id_ogloszenia FROM alreadyseen WHERE id_uzytkownika = $id_uzytkownika)";
			} else {
				$sqlpart6 = "";
			}
			$sql = "SELECT * FROM ogloszenia
			INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
			INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
			INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
			INNER JOIN hashtagi ON ogloszenia.id_ogloszenia = hashtagi.id_ogloszenia
			$sqlpart1
			$sqlpart2
			$sqlpart3
			$sqlpart4 $sqlpart5
			AND kategoria = '$kategoria'
			AND (unactiv - now()) > 0
			$sqlpart6
			ORDER BY RAND() Limit 1";
			return $sql;
}
if(isset($_GET['game']) && isset($_SESSION['zalogowany'])) {
	$game = htmlentities($_GET['game'], ENT_QUOTES, "UTF-8");
	if($game == "true") {
		if(isset($_SESSION['search'])) {
			$sql = search();
			goto here;
		}
	}
}

if(isset($_GET['id'])) {
		$id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
		$id2 = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($id != $id2) statement('index', 'przegladaj.php', 'Whatever You trying to do.. to bad for You but it wont works');
	
$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia=hashtagi.id_ogloszenia
		WHERE ogloszenia.id_ogloszenia = $id2
		LIMIT 1";
} else if(isset($_SESSION['zalogowany'])) {
	
	if(isset($_SESSION['search'])) {
	$sql = search();
	} else {
	
		$id_login = $_SESSION['zalogowany'];
$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN uzytkownicy ON ogloszenia.id_uzytkownika=uzytkownicy.id_uzytkownika
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia=hashtagi.id_ogloszenia
		WHERE ogloszenia.id_ogloszenia NOT IN (SELECT id_ogloszenia FROM alreadyseen WHERE id_uzytkownika = $id_login)
		ORDER BY RAND() LIMIT 1";
	}
} here:

	if($result = $connect->query($sql)) {
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$miejscowosc = 	$row["miejscowosc"];
				$wojewodztwo = 	$row['wojewodztwo'];
				$cena =			$row["cena"];
				$opis =			$row["opis"];
				$subject =		$row["subject"];
				$url =	[		$row['img0'],
								$row['img1'],
								$row['img2'],
								$row['img3'],
								$row['img4']];
				$login =		$row['login'];
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
				$id_ogl = 		$row['id_ogloszenia'];
				$id_uz = 		$row['id_uzytkownika'];

				$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;

				$_SESSION['id_ogloszenia'] = $id_ogl;
			
				for($i=0; $i<10; $i++) {
					$sql = "SELECT tagname FROM taglist WHERE id_taglist = $tagREAD[$i]";
					$result = $connect->query($sql);
					${'tag'.$i} = $result->fetch_array(MYSQLI_NUM);
				}
			}
		} else statement('index', 'szukaj.php', 'brak wyników, zmień preferencje <a href="szukaj.php">wyszukiwania</a>');
	} else statement('index', 'przegladaj.php', 'przepraszamy, baza danych nie odpowiada, spróbuj ponownie później');


		$connect->close();

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
<title>Przeglądaj ogłoszenia</title>
<link rel="Shortcut icon" href="grafika/logo.svg">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
<link type="text/css" rel="stylesheet" href="css/global.css">
<link type="text/css" rel="stylesheet" href="css/input.css">
<link type="text/css" rel="stylesheet" href="css/search.css">
<link type="text/css" rel="stylesheet" href="css/nav.css">
<link type="text/css" rel="stylesheet" href="css/add.css">
<link type="text/css" rel="stylesheet" href="przegladaj/przegladaj.css">
<script src="przegladaj/functions.js"></script>
<script src="przegladaj/przegladaj.js"></script>
<script src="index/global.js"></script>
<script src="audio/quack.js"></script>
<style>
pre {
	display: block;
    font-family: monospace;
    white-space: pre-wrap;
    margin: 1em 0;
	text-align:left;
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

<p><a href="szukaj.php"><button class="zakladka unactualzakladka">Kryteria wyszukiwania</button></a><button class="zakladka actualzakladka">Chybił trafił</button></p>


<?php
$photo="";
$result="";
for($i=1; $i<5; $i++) {
	if($url[$i]) {
		$result = $result.'<img class="imgdisplaj" src="img/'.$url[$i].'" alt="BRAK ZDJĘCIA">';
		$photo = $photo.'<div class="curently"></div>';
	}
} ?>
<output id="yesornot">
	<main id="outputMAIN" class="col-xl-12 col-l-12 col-m-12 col-s-12 col-xs-12">
		<div class="header"> Kwakowicz:&nbsp;<?php echo '<a href="profil.php?id='.$id_uz.'">'.$login.'</a>'; ?></div>
		<div class="header3">Data dodania:&nbsp;<?php echo $data; ?></div>
	<main id="recont" class="" style="width:100%;">
		<div id="zdj">
			<div class="switch">
				<main class="inline"><i class="icon-left-open prev" id="prev" onclick="imgchange(this);"></i>
					<main class="resizephoto"><i class="icon-resize-full-alt resizei" onclick="test();"></i></main>
				<i class="icon-right-open next" id="next" onclick="imgchange(this);"></i></main>
				<main class="current">
					<div class="curently curact"></div>
			<?php echo $photo; ?>
				</main>
			</div>
			<img class="imgdisplaj activeimg" src="<?php if($url[0]) echo 'img/'.$url[0]; else echo 'img/img.png'; ?>" alt="BRAK ZDJĘCIA">
			<?php 	echo $result;	?>

		</div>
	</main>
		
		
		
		
	<div class="temat"><?php echo $subject; ?></div>
		<div class="opis"><pre><?php echo $opis; ?></pre></div>
<div class="header2"><?php echo 'Województwo: '.$wojewodztwo.' Miejscowość: '.$miejscowosc; ?></div>
		<div style="display:flex; width:100%; align-items:flex-start; flex-wrap:nowrap; align-content:center; justify-content:space-between;"><div class="tagcont"><?php for($i=0;$i<10;$i++) {if(${'tag'.$i}[0])echo '<i class="tag">#<a href="przegladaj.php?tagvalue='.${'tag'.$i}[0].'">'.${'tag'.$i}[0].'</a></i>';} ?></div>
	
		<div class="cena"><?php if($cena) echo $cena.' zł'; else echo 'brak ceny'; ?></div></div>
	</main>
			<main class="minibar">
				<div class="comment"><?php echo $ilosc ?>&nbsp;<i onclick="viewcomm();" title="zobacz komentarze" class="icon-chat">&nbsp;komentarzy</i></div>
<?php if(isset($_SESSION['zalogowany'])) { ?>
				<div class="report"><i title="Uważasz, że ogłoszenie jest niestosowne? Zgłoś użytkownika" class="icon-warning">&nbsp;Reportuj</i></div>
<?php } ?>
			</main>
</output>
<?php if(isset($_SESSION['zalogowany'])) { ?>
		<main id="footcont">
			<div class="button"><a href="ajax/ajax_przegladaj.php?game=0"><button class="ynbtn" style="background-color:#f44336;"><i class="icon-cancel"></i></button></a></div>
			<div class="button"><a href="ajax/ajax_przegladaj.php?game=1"><button class="ynbtn" style="background-color:#4CAF50;"><i class="icon-ok"></i></button></a></div>
		</main> 
<?php } ?>

<output id="viewcomment"></output>
<output id="another"></output>

<?php if(isset($_SESSION['zalogowany'])) { ?>
	<form method="post">
		<p style="text-align:left; widht:100%; margin-left:3.75%;">Dodaj komentarz:</p>
		<p style="width:100%;"><textarea style="margin:0 auto;" id="komentarz" name="komentarz" rows="10" maxlength="500" placeholder="dodaj komentarz"></textarea></p>
		<p style="width:100%; text-align:right;"><input style="margin-right:3.75%;" type="button" name="submit" onclick="addcomment();" class="submit reset" value="publikuj"></p>
	</form>
	<output id="newcomment"></output>
<?php } ?>


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