
<main class="row">
<?php
session_start();
if(isset($_POST['search']) || isset($_GET['search']) || isset($_GET['session'])) {

	$kategoria =	@htmlentities($_POST['kategoria'], ENT_QUOTES, "UTF-8");
	$wojewodztwo = 	@htmlentities($_POST['wojewodztwo'], ENT_QUOTES, "UTF-8");
	$miejscowosc =	@htmlentities($_POST['miejscowosc'], ENT_QUOTES, "UTF-8");
	$tag = [		@htmlentities($_POST['tag0'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag1'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag2'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag3'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag4'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag5'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag6'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag7'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag8'], ENT_QUOTES, "UTF-8"),
					@htmlentities($_POST['tag9'], ENT_QUOTES, "UTF-8")];
	$cena_min =		@htmlentities($_POST['min'], ENT_QUOTES, "UTF-8");
	$cena_max = 	@htmlentities($_POST['max'], ENT_QUOTES, "UTF-8");


	if(!isset($_POST['search'])) {
		$kategoria = $_SESSION['kategoria'];
		$wojewodztwo = $_SESSION['wojewodztwo'];
		$miejscowosc = $_SESSION['miejscowosc'];
		$cena_min = $_SESSION['cenamin'];
		$cena_max = $_SESSION['cenamax'];
		for($i = 0; $i < 10; $i++) {
			$tag[$i]=$_SESSION['tag'.$i.''];
		}
	} else {
		$_SESSION['search'] = true;
		$_SESSION['kategoria'] = $kategoria;
		$_SESSION['wojewodztwo'] = $wojewodztwo;
		$_SESSION['miejscowosc'] = $miejscowosc;
		$_SESSION['cenamin'] = $cena_min;
		$_SESSION['cenamax'] = $cena_max;
		for($i = 0; $i < 10; $i++) {
			$_SESSION['tag'.$i.'']=$tag[$i];
		}
	}

	if($wojewodztwo=='0') {
		$sqlpart2 = "AND 1 = 1";
	} else {
		$sqlpart2 = "AND ogloszenia.id_lokalizacja = ANY (SELECT id_lokalizacja FROM lokalizacja WHERE wojewodztwo = '$wojewodztwo')";
	}
	if($miejscowosc=='0' || !$miejscowosc) {
		$sqlpart3 = "AND 1 = 1";
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
	if(isset($_SESSION['zalogowany'])) {
		$id_uzytkownika = $_SESSION['zalogowany'];
		$sqlpart6 = "AND ogloszenia.id_ogloszenia NOT IN (SELECT id_ogloszenia FROM alreadyseen WHERE id_uzytkownika = $id_uzytkownika)";
	} else {
		$sqlpart6 = "";
	}

require_once('../php/connect.php');
$connect = connection_start();


 //Pobranie danych z $_GET jezsli ustawione i wartosci pierwotne
 if(isset($_GET['count'])) {
	 $count = $_GET['count'];
 } else  $count=30;
 if(isset($_GET['offset'])) {
	 $offset = $count * $_GET['offset']; //numer strony
 } else $offset=0;
 //Pobranie liczby rekordów
 $sql = "SELECT count(*) AS lol FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia = zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia = hashtagi.id_ogloszenia
		$sqlpart1
		$sqlpart2
		$sqlpart3
		$sqlpart4 $sqlpart5
		AND kategoria = '$kategoria'
		AND (unactiv - now()) > 0
		";
 $result = $connect->query($sql);
 $r = $result->fetch_array(MYSQLI_NUM);
 //Liczba stron, użycie ceil - zaokrąglenie w górę, w celu zapewnienia, że żadna strona się nie straci
 $pages = ceil($r[0]/$count);

 //Pobranie odpowieniej paczki
$sql = "SELECT * FROM ogloszenia
		INNER JOIN lokalizacja ON ogloszenia.id_lokalizacja=lokalizacja.id_lokalizacja
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia = zdjecia.id_ogloszenia
		INNER JOIN hashtagi ON ogloszenia.id_ogloszenia = hashtagi.id_ogloszenia
		$sqlpart1
		$sqlpart2
		$sqlpart3
		$sqlpart4 $sqlpart5
		AND kategoria = '$kategoria'
		AND (unactiv - now()) > 0
		$sqlpart6
		ORDER BY data Limit $count OFFSET $offset";
		
	if($result = $connect->query($sql)) {
		$rows = $result->num_rows;
			if($rows == 0) {
				$pages = 0;
			} else {
				while($row = $result->fetch_assoc()) {
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
					
					
					if(!$url) $url = "img.png";
					
					echo '<a href="przegladaj.php?id='.$row['id_ogloszenia'].'" class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt="lool"></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div></a>';
				}
			}

	} else {echo "brak polaczenia";}
		
		
$connect->close();

}
?>

</main>
<main style="flex-wrap:nowrap; align-items:baseline;">
<?php
if(isset($pages)) {
	//Pętla po stronach
	if($pages==0) {
		echo "brak wyników wyszukiwania";
	} else {
		for($i=0;$i<$pages;$i++){
			//jeśli obecna strona, nie twórz linku do strony
			if($i*$count==$offset){
				$j = $i+1;
				echo '<span style="padding:1rem">'.$j.'</span>';
			}else{
				$j = $i+1;
				echo '<a id="uber" onclick="ubertest('.$count.', '.$i.');" style="padding:1rem;"> '.$j.' </a>';
			}
		}
	}
}
?>
</main>