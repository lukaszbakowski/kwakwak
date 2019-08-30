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
if(isset($_GET['fav'])) {
	$fav1 = htmlentities($_GET['fav'], ENT_QUOTES, "UTF-8");
	$fav = filter_var($fav1, FILTER_SANITIZE_NUMBER_INT);
	if($fav1 == $fav) {
		$id_obserwujacego = $_SESSION['zalogowany'];
		$id1 = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
		$id = filter_var($id1, FILTER_SANITIZE_NUMBER_INT);
		if($id1 != $id) {exit;}
		else if($fav == 0) {
			$sql = "INSERT INTO ulubione(id_ulubione, id_obserwujacego, id_obserwowanego) VALUES (NULL, $id_obserwujacego, $id);";
		} else if($fav == 1) {
			$sql = "DELETE FROM `ulubione` WHERE id_obserwujacego = $id_obserwujacego AND id_obserwowanego = $id;";
		} else {exit;}
		$result = $connect->query($sql);
	}
}
if(isset($_POST['rek'])) {
	if($_POST['rek']=="true") {
		$tresc = htmlentities($_POST['tresc'], ENT_QUOTES, "UTF-8");
		$ocena = filter_var($_POST['ocena'], FILTER_SANITIZE_NUMBER_INT);
		if(preg_match('/^[0-9]{1}$/', $ocena)) { $ocena += 1; } else {echo 'error'; exit;}
		$id_ocenianego = filter_var($_POST['id_uz'], FILTER_SANITIZE_NUMBER_INT);
		$id_oceniajacego = $_SESSION['zalogowany'];
		$sql = "SELECT * FROM opinia WHERE id_ocenianego = $id_ocenianego AND id_oceniajacego = $id_oceniajacego";
		$result = $connect->query($sql);
		if($result->num_rows == 0) {
			$sql = "INSERT INTO `opinia`(`id_opinia`, `id_ocenianego`, `id_oceniajacego`, `tresc`, `ocena`, `data`) VALUES (NULL, $id_ocenianego, $id_oceniajacego, '$tresc', $ocena, now());";
			if($result = $connect->query($sql)) {
				echo "Ocena pomyślnie dodana";
			}
		} else {
			echo 'Nie możesz ponownie wystawić oceny';
		}
	}
	
}
if(isset($_GET['viewrek'])) {
	if($_GET['viewrek'] == "true") {
		$id_uzytkownika = filter_var($_GET['id_uzytkownika'], FILTER_SANITIZE_NUMBER_INT);
		$sql = 		"SELECT * FROM `opinia`
					WHERE `id_ocenianego` = $id_uzytkownika ORDER BY data DESC LIMIT 30";
		if($result = $connect->query($sql)) {
			if($result->num_rows == 0) {
				echo 'Nikt jeszcze nie oceniał tego użytkownika';
			} else {
				while($row = $result->fetch_assoc()) {
					$id_oceniajacego = $row['id_oceniajacego']; 
					$res = $connect->query("SELECT login FROM uzytkownicy WHERE id_uzytkownika = $id_oceniajacego");
					$r = $res->fetch_array(MYSQLI_NUM);
					$login_oceniajacego = $r[0];
					$tresc = $row['tresc'];
					$ocena = $row['ocena'] + 1;

					echo '<main class="xyzrow"><div class="left">Kwakowicz:<a href="profil.php?id="'.$id_oceniajacego.'">'.$login_oceniajacego.'</a></div><div class="right">'.$row['data'].'</div></main><div class="comline">'.$tresc.'</div><p style="width:100%; text-align:right;">Ocenił: '.$ocena.'/10</p><hr><i style="display:block;width:100%;text-align:right;padding-right:1rem; margin-bottom:2rem;" title="Uważasz, że komentarz jest niestosowny? Zgłoś użytkownika" class="icon-warning">&nbsp;Reportuj</i>';
				}
			}
		}
	}
}
$connect->close();
?>