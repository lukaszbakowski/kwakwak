<?php
include_once('../php/connect.php');
session_start();
$connect = connection_start();
if(!isset($_SESSION['zalogowany'])) {
	header('Location:../index.php');
	exit;
}
if(isset($_POST['send'])) {
	if($_POST['send']=="true") {
		$tresc = $_POST['tresc'];
		$temat = $_POST['temat'];
		$id_odbiorcy = $_POST['id_uz'];
		$id_nadawcy = $_SESSION['zalogowany'];
		
		$sql="INSERT INTO `messages`(`id_messages`, `id_nadawcy`, `id_odbiorcy`, `subject`, `tresc`, `readed`, `data`) VALUES (NULL, $id_nadawcy, $id_odbiorcy, '$temat', '$tresc', 0, now());";
		if($result = $connect->query($sql)) {
			echo 'Wiadomość została pomyślnie wysłana';
		}
	}
}

if(isset($_GET['search'])) {
	if($_GET['search'] == "true") {

echo '<main class="row">';


 //Pobranie danych z $_GET jezsli ustawione i wartosci pierwotne
 if(isset($_GET['count'])) {
	 $count = $_GET['count'];
 } else  $count=15;
 if(isset($_GET['offset'])) {
	 $offset = $count * $_GET['offset']; //numer strony
 } else $offset=0;
 
 $logedAS = $_SESSION['zalogowany'];
 //Pobranie liczby rekordów
 $sql = "SELECT count(*) AS lol FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN alreadyseen ON ogloszenia.id_ogloszenia=alreadyseen.id_ogloszenia
		WHERE alreadyseen.dislike = 0 AND alreadyseen.id_uzytkownika = $logedAS";
 $result = $connect->query($sql);
//Liczba stron, użycie ceil - zaokrąglenie w górę, w celu zapewnienia, że żadna strona się nie straci
 $r = $result->fetch_array(MYSQLI_NUM);
 if($r[0] == 0) {
	 $pages = 0;
 } else {
 $pages = ceil($r[0]/$count);
 }

$sql = "SELECT *, ogloszenia.id_uzytkownika AS id_uz FROM ogloszenia
		INNER JOIN zdjecia ON ogloszenia.id_ogloszenia=zdjecia.id_ogloszenia
		INNER JOIN alreadyseen ON ogloszenia.id_ogloszenia=alreadyseen.id_ogloszenia
		WHERE alreadyseen.dislike = 0 AND alreadyseen.id_uzytkownika = $logedAS
		ORDER BY data DESC Limit $count OFFSET $offset";
$result4 = $connect->query($sql);
while($row = $result4->fetch_assoc()) {
	

				$cena =				$row["cena"];
				$subject =			$row["subject"];
				$url =				$row['img0'];
				$id_ogl =			$row['id_ogloszenia'];
				$id_uzytkownika = 	$row['id_uz'];
				
				if(!$url) $url = "img.png";
	
					$ask = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogl";
				$result2 = $connect->query($ask);
				$ilosc = $result2->num_rows;
				
				$ask = "SELECT * FROM alreadyseen WHERE id_ogloszenia = $id_ogl AND dislike = 0";
				$result2 = $connect->query($ask);
				$ilosc2 = $result2->num_rows;
	
	
	echo '<div class="cell" title="'.$subject.'"><div class="sbj">'.$subject.'</div><div class="omgimg"><img src="img/'.$url.'" alt=""></div><div class="price"><span style="float:left;">'.$ilosc.'&nbsp;<i class="icon-chat"></i>&nbsp;'.$ilosc2.'&nbsp;<i class="icon-heart"></i></span><span style="float:right;">'.$cena.'zł</span><span class="clear:both;"></span></div><div class="hover"><a href="profil.php?id='.$id_uzytkownika.'">obejrzyj profil</a><a href="przegladaj.php?id='.$row['id_ogloszenia'].'">podgląd ogłoszenia</a><a onclick="message('.$id_ogl.','.$id_uzytkownika.');" href="#message">napisz wiadomosc</a><a onclick="delpost(this.parentElement, '.$id_ogl.');">usuń</a></div></div>';
}




echo '</main>
<main style="flex-wrap:nowrap; align-items:baseline;">';
if(isset($pages)) {

	//Pętla po stronach
	if($pages==0) {
		echo "nie polubiłeś jeszcze żadnych ogłoszeń";
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

echo '</main>';
	}
}
if(isset($_GET['delete'])) {
	if($_GET['delete']=="true") {
		$id1 = htmlentities($_GET['id_ogloszenia'], ENT_QUOTES, "UTF-8");
		$id2 = filter_var($id1, FILTER_SANITIZE_NUMBER_INT);
		if($id1 == $id2) {$id_ogloszenia = $id2;} else exit;
		$id_uzytkownika = $_SESSION['zalogowany'];
		$sql = "UPDATE `alreadyseen` SET `dislike` = 1,`like` = 0 WHERE `id_uzytkownika` = $id_uzytkownika AND `id_ogloszenia` = $id_ogloszenia;";
		$connect->query($sql);
	}
	
}
$connect->close();