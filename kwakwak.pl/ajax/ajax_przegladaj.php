<?php 

require_once('../php/connect.php');
include_once('../php/functions.php');
$connect=connection_start();
if(isset($_GET['game']) && isset($_SESSION['zalogowany'])) {
	$game = htmlentities($_GET['game'], ENT_QUOTES, "UTF-8");
	if($game == "0" || $game == "1") {
		$id_ogloszenia = $_SESSION['id_ogloszenia'];
		$id_uzytkownika = $_SESSION['zalogowany'];
		$sql = "SELECT id_seen FROM alreadyseen WHERE id_ogloszenia = $id_ogloszenia AND id_uzytkownika = $id_uzytkownika";
		
		if($result = $connect->query($sql)) {
			$rows = $result->num_rows;

			if($rows == 0) {
				

				if($game=="0") {$sql = "INSERT INTO `alreadyseen`(`id_seen`, `id_uzytkownika`, `dislike`, `like`, `id_ogloszenia`) VALUES (NULL, $id_uzytkownika, 1, 0, $id_ogloszenia);"; echo $game;}
				else if($game=="1") {$sql = "INSERT INTO `alreadyseen`(`id_seen`, `id_uzytkownika`, `dislike`, `like`, `id_ogloszenia`) VALUES (NULL, $id_uzytkownika, 0, 1, $id_ogloszenia);";}
				if($result = $connect->query($sql)) {
					header('Location:../przegladaj.php?game=true');
				} else statement("ajax", "przegladaj.php", "przepraszamy, wystąpił problem z połączeniem");
			} else statement("php", "przegladaj.php", "juz decydowałeś o tym ogłoszeniu");
		}
	} else statement("ajax", "przegladaj.php", "coś poszło nie tak");

}
else if(isset($_GET['view'])) {
	
	$count = 5;
	$offset= 0;
	$id_ogloszenia = $_SESSION['id_ogloszenia'];
	$sql = "SELECT * FROM comment WHERE id_ogloszenia = $id_ogloszenia";
	$result = $connect->query($sql);
	$result = $result->num_rows;
	if($result > $count) {
		$load = '<output id="showme" onclick="morecomm();"><i title="zobacz wczesniejsze komentarze" class="icon-angle-double-down"></i></output>';
	} else { $load = 'to już wszystkie komentarze'; }
$sql = "SELECT * FROM comment
		WHERE id_ogloszenia = $id_ogloszenia
		ORDER BY data DESC Limit $count OFFSET $offset";
		
	if($result = $connect->query($sql)) {
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$id_uz = $row['id_uzytkownika'];
				$sql2 = "SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id_uz";
				$result2 = $connect->query($sql2);
				$id_uz = $result2->fetch_assoc();
				echo '<main class="xyzrow"><div class="left">Kwakowicz:<a href="profil.php?profil='.$id_uz['login'].'">'.$id_uz['login'].'</a></div><div class="right">'.$row['data'].'</div></main><div class="comline">'.$row['comment'].'</div><hr><i style="display:block;width:100%;text-align:right;padding-right:1rem;" title="Uważasz, że komentarz jest niestosowny? Zgłoś użytkownika" class="icon-warning">&nbsp;Reportuj</i>';
			}
			echo $load;
		} else echo "nikt jeszcze nie skomentował tego ogłoszenia";
	} else {echo "brak polaczenia";}
	


}
else if(isset($_GET['more'])) {
	
	$offset = $_GET['offset'];
	$count = 5;

	$id_ogloszenia = $_SESSION['id_ogloszenia'];
$sql = "SELECT * FROM comment
		WHERE id_ogloszenia = $id_ogloszenia
		ORDER BY data Limit 6 OFFSET $offset";
	$result = $connect->query($sql);
	$check = $result->num_rows;
	if($check == 6) {
		$load = '<output id="showme" onclick="morecomm();"><i title="zobacz wczesniejsze komentarze" class="icon-angle-double-down"></i></output>';
	} else $load = 'to już wszystkie komentarze';
$sql = "SELECT * FROM comment
		WHERE id_ogloszenia = $id_ogloszenia
		ORDER BY data DESC Limit $count OFFSET $offset";
		
	if($result = $connect->query($sql)) {
		if($result->num_rows) {
			while($row = $result->fetch_assoc()) {
				$id_uz = $row['id_uzytkownika'];
				$sql2 = "SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id_uz";
				$result2 = $connect->query($sql2);
				$id_uz = $result2->fetch_assoc();
				echo '<main class="xyzrow"><div class="left">Kwakowicz:<a href="profil.php?profil='.$id_uz['login'].'">'.$id_uz['login'].'</a></div><div class="right">'.$row['data'].'</div></main><div class="comline">'.$row['comment'].'</div><hr>';
			}
			echo $load;
		}
	} else {echo "brak polaczenia";}
	
	

}






else if(isset($_POST['addcomment'])) {

	$id_ogloszenia = $_SESSION['id_ogloszenia'];
	$id_komentujacego = $_SESSION['zalogowany'];	
	$tresc = $_POST['tresc'];

	$sql ="INSERT INTO comment(`id_comment`, `id_uzytkownika`, `id_ogloszenia`, `comment`, `data`) VALUES(NULL, $id_komentujacego, $id_ogloszenia, '$tresc', now());";
	if($result = $connect->query($sql)) {
		echo 'pomyślnie dodano komentarz';
	}
}
	
	
	
$connect->close();
?>